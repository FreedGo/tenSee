<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人中心</title>
<link href="/css/style.css" type="text/css" rel="stylesheet">
<link href="/css/ment.css" type="text/css" rel="stylesheet">
<script src="/js/jquery.js"></script>

</head>

<body>
<?php
require(ECMS_PATH.'e/template/public/header.php');
?>

<div class="my_bg">
	<div class="main clearfix">
    	<?php
		require(ECMS_PATH.'e/template/public/ment.php');
		?>

        
        <div class="rt"><img src="/images/linshi/5.png" /></div>
    </div>
</div>

<?php
require(ECMS_PATH.'e/template/public/footer.php');
?>
</body>
</html>


