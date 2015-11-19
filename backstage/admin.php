<!-- BASIC认证 -->
<?php
	$username = 'admin';
	$password = 'admin';
	if (!isset($_SERVER['PHP_AUTH_USER']) ||
		!isset($_SERVER['PHP_AUTH_PW']) ||
		($_SERVER['PHP_AUTH_USER'] != $username) ||
		($_SERVER['PHP_AUTH_PW'] != $password)){
		header("Content-type:text/html;charset=utf-8");
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate:Basic realm = ""');
		exit('<h2>请输入正确的管理员账户和密码 :)</h2><br>
		<a href="../register.php">返回</a>');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	后台管理页面
	<a href="user.php">用户管理</a>
	<a href="vidio.php">视频管理</a>
	<a href="../index.php">返回首页</a>
</body>
</html>