<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="./css/register.css">
</head>
<body>
	<header>
		<div>
		<a href="index.php">首页</a>
		<a href="register.php">注册</a>
		<a href="login.php">登陆</a>
		</div>
	</header>
	<div class="container">
<?php
	if (!isset ($_COOKIE['user_ID'])){
		if (isset($_POST['submit'])){
			$dbc = mysqli_connect('localhost','root','','xuan')
				or die('Error connecting to MySQL server!');
			$username = $_POST['username'];
			$password = $_POST['password'];
			$query = "SELECT user_ID, username FROM user WHERE username = '$username' AND password = '$password'";
			$data = mysqli_query($dbc,$query)
				or die('Error quering database!');
			if (mysqli_num_rows($data) == 1){
				$row = mysqli_fetch_array($data);
				setcookie('user_ID',$row['user_ID'],time()+3600*24);
				setcookie('username',$row['username'],time()+3600*24);
				$home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
				header('Location:'.$home_url);
			} else {
				$error_msg = '请输入正确的用户名和密码';
			}
		}
	} else {
		$home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
		header('Location:'.$home_url);
	}
	if (empty($_COOKIE['user_ID'])){
		if (!empty($error_msg)) {
			echo '<p>'.$error_msg.'</p>';
		} 
?>
		<h1>登陆</h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<div>
				<label for="username">用户名</label>
				<input type="text" name="username" id="username" required>
			</div>
			<div>
				<label for="password">密码</label>
				<input type="password" name="password" id="password" required>
			</div>
			<div>
				<input type="submit" name="submit" value="提交" id="submit">
			</div>
		</form>
<?php
	} else {
		echo '欢迎您，'.$_COOKIE['username'];
	}
?>

	</div>
	<footer>
		<hr>
		CopyRight 2015 lsz
	</footer>
</body>
</html>
