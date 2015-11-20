<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="./css/register.css">
</head>
<body>
	<header>
<?php
	require_once('header.php');
	$home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
?>
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
				header('Refresh: 3; url = '.$home_url.'');
				echo '登陆成功，3秒后将跳转首页。';
				exit();
			} else {
				$error_msg = '请输入正确的用户名和密码';
			}
		}
	} else {
		#header('Location:'.$home_url);
		header('Refresh: 5; url = $home_url');
		echo '登陆成功，5秒后将跳转首页。';
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
		<a href="./backstage/admin.php">管理员登陆</a>
<?php
	} else {
		echo '欢迎您，'.$_COOKIE['username'];
	}
?>

	</div>
<?php
 require_once('footer.php');
?>
</body>
</html>
