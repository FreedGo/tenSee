<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<?php
ini_set("display_errors", "Off");
//error_reporting(E_ALL | E_STRICT);
//将出错信息输出到一个文本文件
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
require '../autoload.php';
include_once '../aliyun-php-sdk-core/Config.php';
use OSS\OssClient;

use Mts\Request\V20140618 as Mts;

$filepath = $_GET['filepath'];
$filename = $_GET['filename'];

$mts_region = 'cn-hangzhou';
$oss_region = 'oss-cn-hangzhou';

$mts_endpoint = 'mts.cn-hangzhou.aliyuncs.com';
$oss_endpoint = 'oss-cn-hangzhou.aliyuncs.com';


$test_video_file_name = 'videos/636.flv';
$test_watermark_file_name = '';
//$test_watermark_file_name = 'watermarks/32x32-中文.png';

$access_key_id = 'sKSFulcGCs7s4U0D';
$access_key_secret = 'JKC0GiJRzHtcAmPH3uCkWnQAIzQUqw';
$pipeline_id = 'a2b74a36dd2e445aaa6771b268873b4d'; //管道ID
//$transcode_template_id = '9a8dfcba34b67e9d6a213b7caf91b3b0'; //模版ID
$transcode_template_id = 'b6e4ed58d25cfc3a9dd793fd534b28b6';
$watermark_template_id = '7d0e1579a0904b6c82a10c3f1e38d4a1'; //水印ID

$input_bucket = 'mevideo';
$output_bucket = 'mevideo';

$profile = DefaultProfile::getProfile($mts_region, $access_key_id,$access_key_secret);
$client = new DefaultAcsClient($profile);


function upload_file($filename, $bucket, $obj)
{
    global $access_key_id;
    global $access_key_secret;
    global $oss_endpoint;
    global $oss_region;

    $ossClient = new OssClient($access_key_id,
                               $access_key_secret,
                               $oss_endpoint,
                               false);
    $ossClient->uploadFile($bucket, $obj, $filename);

    return array(
        'Location' => $oss_region,
        'Bucket' => $bucket,
        'Object' => urlencode($obj)
    );
}

//视频截图
function snapshot_job_flow($input_file,$filename)
{
    $snapshot_job = submit_snapshot_job($input_file,$filename);

   // print 'Snapshot success, the target file url is http://' .
//          $snapshot_job->{'SnapshotConfig'}->{'OutputFile'}->{'Bucket'} . '.' .
//          $snapshot_job->{'SnapshotConfig'}->{'OutputFile'}->{'Location'} . '.aliyuncs.com/' .
//          urldecode($snapshot_job->{'SnapshotConfig'}->{'OutputFile'}->{'Object'}) . "\n";
   $image_url = "";
   if($snapshot_job->{'SnapshotConfig'}->{'OutputFile'}->{'Object'})
   {
     $image_url = $snapshot_job->{'SnapshotConfig'}->{'OutputFile'}->{'Bucket'} . '.' .
          $snapshot_job->{'SnapshotConfig'}->{'OutputFile'}->{'Location'} . '.aliyuncs.com/' .
          urldecode($snapshot_job->{'SnapshotConfig'}->{'OutputFile'}->{'Object'});
   }
	
	return 	 $image_url; 
}

function submit_snapshot_job($input_file,$filename)
{
    global $oss_region;
    global $input_bucket;
    global $client;
    $obj = 'snapshots/' . $filename.'.jpg';
    $snapshot_output = array(
        'Location' => $oss_region,
        'Bucket' => $input_bucket,
        'Object' => urlencode($obj)
    );
    $snapshot_config = array(
        'OutputFile' => $snapshot_output,
        'Time' => 10000
    );

    $request = new Mts\SubmitSnapshotJobRequest();
    $request->setAcceptFormat('JSON');
    $request->setInput(json_encode($input_file));
    $request->setSnapshotConfig(json_encode($snapshot_config));

    $response = $client->getAcsResponse($request);

    return $response->{'SnapshotJob'};
}

function transcode_job_flow($input_file, $watermark_file,$filename)
{
    return system_template_job_flow($input_file, $watermark_file,$filename);
    //user_custom_template_job_flow($input_file, $watermark_file);
}

//媒体转码
function system_template_job_flow($input_file, $watermark_file,$filename)
{
    global $pipeline_id;

    $analysis_id = submit_analysis_job($input_file, $pipeline_id);
    $analysis_job = wait_analysis_job_complete($analysis_id);

    $template_ids = get_support_template_ids($analysis_job);


    # 可能会有多个系统模板，这里采用推荐的第一个系统模板进行转码
//	$transcode_job_id = submit_transcode_job($input_file, $watermark_file, $template_ids[0],$filename);
	$transcode_job_id = submit_transcode_job($input_file, $watermark_file, $template_ids[10],$filename);
    $transcode_job = wait_transcode_job_complete($transcode_job_id);
    
	$video_url = "";
	if($transcode_job->{'Output'}->{'OutputFile'}->{'Object'})
	{
		$video_url = $transcode_job->{'Output'}->{'OutputFile'}->{'Bucket'} . '.' .
        $transcode_job->{'Output'}->{'OutputFile'}->{'Location'} . '.aliyuncs.com/' .
        urldecode($transcode_job->{'Output'}->{'OutputFile'}->{'Object'});
	}

	
   // print 'Transcode success, the target file url is http://' .
//        $transcode_job->{'Output'}->{'OutputFile'}->{'Bucket'} . '.' .
//        $transcode_job->{'Output'}->{'OutputFile'}->{'Location'} . '.aliyuncs.com/' .
//        urldecode($transcode_job->{'Output'}->{'OutputFile'}->{'Object'}) . "\n";
	return	$video_url;
}

function submit_analysis_job($input_file, $pipeline_id)
{
    global $client;

	$request = new Mts\SubmitAnalysisJobRequest();
    $request->setAcceptFormat('JSON');
    $request->setInput(json_encode($input_file));
    $request->setPriority(5);
    //$request->setUserData('SubmitAnalysisJob userData');
    $request->setPipelineId($pipeline_id);

    $response = $client->getAcsResponse($request);
    return $response->{'AnalysisJob'}->{'Id'};
}

function wait_analysis_job_complete($analysis_id)
{
    global $client;

    while (true)
    {
        $request = new Mts\QueryAnalysisJobListRequest();
        $request->setAcceptFormat('JSON');
        $request->setAnalysisJobIds($analysis_id);

        $response = $client->getAcsResponse($request);
        $state = $response->{'AnalysisJobList'}->{'AnalysisJob'}[0]->{'State'};
        if ($state != 'Success')
        {
            if ($state == 'Submitted' or $state == 'Analyzing')
            {
                sleep(5);
            } elseif ($state == 'Fail') {
                print 'AnalysisJob is failed!';
                return null;
            }
        } else {
            return $response->{'AnalysisJobList'}->{'AnalysisJob'}[0];
        }
    }
    return null;
}

function get_support_template_ids($analysis_job)
{
    $result = array();

    foreach ($analysis_job->{'TemplateList'}->{'Template'} as $template)
    {
        $result[] = $template->{'Id'};
    }

    return $result;
}

function submit_transcode_job($input_file, $watermark_file, $template_id,$filename)
{
    global $client;
    global $watermark_template_id;
    global $output_bucket;
    global $oss_region;
    global $pipeline_id;

    $watermark_config = array();
    $watermark_config[] = array(
        'InputFile' => json_encode($watermark_file),
        'WaterMarkTemplateId' => $watermark_template_id
    );

    $obj = 'transcode/' . $filename.'.mp4';
    $outputs = array();
    $outputs[] = array(
        'OutputObject'=> urlencode($obj),
        'TemplateId' => $template_id,
        'WaterMarks' => $watermark_config
    );

    $request = new Mts\SubmitJobsRequest();
    $request->setAcceptFormat('JSON');
    $request->setInput(json_encode($input_file));
    $request->setOutputBucket($output_bucket);
    $request->setOutputLocation($oss_region);
    $request->setOUtputs(json_encode($outputs));
    $request->setPipelineId($pipeline_id);

    $response = $client->getAcsResponse($request);

    return $response->{'JobResultList'}->{'JobResult'}[0]->{'Job'}->{'JobId'};
}

function wait_transcode_job_complete($transcode_job_id)
{
    global $client;

    while (true)
    {
        $request = new Mts\QueryJobListRequest();
        $request->setAcceptFormat('JSON');
        $request->setJobIds($transcode_job_id);

        $response = $client->getAcsResponse($request);
        $state = $response->{'JobList'}->{'Job'}[0]->{'State'};
        if ($state != 'TranscodeSuccess')
        {
            if ($state == 'Submitted' or $state == 'Transcoding')
            {
                sleep(5);
            } elseif ($state == 'TranscodeFail') {
                print 'Transcode is failed!';
                return null;
            }
        } else {
            return $response->{'JobList'}->{'Job'}[0];
        }
    }
    return null;
}


$input_file = array('Location'=>$oss_region,
                        'Bucket'=>$input_bucket,
						'Object'=>$filepath
                       );
$watermark_file = array('Location'=>$oss_region,
                        'Bucket'=>$input_bucket,
						'Object'=>'watermarks%2F5866125b17bac_1230.png'
                       );

$video_url = transcode_job_flow($input_file, $watermark_file,$filename);
$images_url = snapshot_job_flow($input_file,$filename);
$data['video_url'] = $video_url;
$data['images_url'] = $images_url;

//echo "转码后的视频网址：".$data['video_url'];
//echo "<br />截图：".$data['images_url'];
echo "转码完成";
?>