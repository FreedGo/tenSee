<?php
$access_id = 'sKSFulcGCs7s4U0D';
$access_key = 'JKC0GiJRzHtcAmPH3uCkWnQAIzQUqw';
$url='https://fxchen.oss-cn-shenzhen.aliyuncs.com';//更改成你自己的地址
$policy = '{"expiration": "2120-01-01T12:00:00.000Z","conditions":[{"bucket": "ioutsider" },["content-length-range", 0, 104857600]]}';
$policy = base64_encode($policy);
$signature = base64_encode(hash_hmac('sha1', $policy, $access_key, true));//生成认证签名
function uploadFile($ossClient, $bucket)
{
    $object = "oss-php-sdk-test/upload-test-object-name.txt";
    $filePath = __FILE__;
    $options = array();

    echo "sdsds";
	echo "222";
}
echo __FILE__;
?>
