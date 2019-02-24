<?php
include_once 'aliyun-php-sdk-core/Config.php';
use Mts\Request\V20140618 as Mts;
$access_key_id = 'sKSFulcGCs7s4U0D';
$access_key_secret = 'JKC0GiJRzHtcAmPH3uCkWnQAIzQUqw';


$url = "http://mts.cn-hangzhou.aliyuncs.com/?Format=json";
$url .='&Version=2014-06-18';
$url .='&Signature=vpEEL0zFHfxXYzSFV0n7%2FZiFL9o%3D';
$url .='&SignatureMethod=Hmac-SHA1';
$url .='&SignatureNonce=9166ab59-f445-4005-911d-664c1570df0f';
$url .='&SignatureVersion=1.0';
$url .='&Action=SubmitJobs';
$url .='&AccessKeyId=sKSFulcGCs7s4U0D';
$url .='&Timestamp='.date('YYYY-MM-DDThh:mm:ssZ',time());
// http://mts.cn-hangzhou.aliyuncs.com/?Format=json &Version=2014-06-18&Signature=vpEEL0zFHfxXYzSFV0n7%2FZiFL9o%3D&SignatureMethod=Hmac-SHA1&SignatureNonce=9166ab59-f445-4005-911d-664c1570df0f&SignatureVersion=1.0&Action=SubmitJobs&AccessKeyId=tkHh5O7431CgWayx&Timestamp=2014-07-29T09%3A22%3A32Z
	
function search_media_workflow($client, $regionId)
{
  $request = new Mts\SearWchMediaorkflowRequest();
  $request->setAcceptFormat('JSON');
  $request->setRegionId($regionId); //重要
  $response = $client->getAcsResponse($request);
  return $response;
}
$profile = DefaultProfile::getProfile('cn-shenzhen',
							   $access_key_id,
							   $access_key_secret);
$client = new DefaultAcsClient($profile);
$request = new Mts\SearWchMediaorkflowRequest();
$request->setAcceptFormat('JSON');
$request->setRegionId($regionId); //重要
$response = $client->getAcsResponse($request);
print_r($response);
?>