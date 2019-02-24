<?php
require_once __DIR__ . '/Common.php';
use OSS\OssClient;
use OSS\Core\OssException;

$ossClient = Common::getOssClient();
if (is_null($ossClient)) exit(1);
$bucket = Common::getBucketName();
$accessid = Config::OSS_ACCESS_ID;
$accesskey = Config::OSS_ACCESS_KEY;
$endpoint = Config::OSS_ENDPOINT;
$host = 'http://'.$bucket.".".$endpoint;

function randStr($len=6,$format='ALL') { 
 switch($format) { 
 case 'ALL':
 $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; break;
 case 'CHAR':
 $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; break;
 case 'NUMBER':
 $chars='0123456789'; break;
 default :
 $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; 
 break;
 }
 mt_srand((double)microtime()*1000000*getmypid()); 
 $password="";
 while(strlen($password)<$len)
    $password.=substr($chars,(mt_rand()%strlen($chars)),1);
 return $password;
 } 
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title>OSS 视频上传</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
<h1>OSS 视频上传</h1>
<br>
<form name=theform style=" display:none">
<input type="radio" name="myradio" value="local_name" /> 上传文件名字保持本地文件名字
<input type="radio" name="myradio" value="random_name" checked=true /> 上传文件名字是随机文件名
<br/>
上传到指定目录:<input type="text" id='dirname' value="video"size=50>
</form>

<div id="ossfile">你的浏览器不支持flash,Silverlight或者HTML5！</div>

<br/>

<div id="zhuanma"></div>
<br/>
<div id="container">
	<a id="selectfiles" href="javascript:void(0);" class='btn'>选择文件</a>
	<a id="postfiles" href="javascript:void(0);" class='btn'>开始上传</a>
</div>

<pre id="console"></pre>


<p>&nbsp;</p>

</body>
<script type="text/javascript" src="lib/crypto1/crypto/crypto.js"></script>
<script type="text/javascript" src="lib/crypto1/hmac/hmac.js"></script>
<script type="text/javascript" src="lib/crypto1/sha1/sha1.js"></script>
<script type="text/javascript" src="lib/base64.js"></script>
<script type="text/javascript" src="lib/plupload-2.1.2/js/plupload.full.min.js"></script>
<!--<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>-->
<script>
var accessid= "<?=$accessid?>"
var accesskey= "<?=$accesskey?>"
var host = "<?=$host?>"

var videofile = "<?=randStr(32)?>"
</script>
<script type="text/javascript" src="upload.js"></script>

</html>
