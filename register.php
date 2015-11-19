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
?>
	</header>
	<div class="container">
<?php
	if(isset($_POST['submit'])){
		$user_pass_phrase = $_POST['verify'];
		if( $_SESSION['pass_phrase'] == $user_pass_phrase){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$register = false;
		$dbc = mysqli_connect('localhost','root','','xuan')
			or die('Error connecting to MySQL server!');
		$query = "INSERT INTO user (username,password,user_email)".
			"VALUES('$username','$password','$email')";
		$result = mysqli_query($dbc,$query)
			or die('Error quering database!');
		mysqli_close($dbc);
		echo '注册成功，请<a href="login.php">登录</a>！';
		} else {
			echo '验证码错误';
			$register = true;
		}
	} else {
		$register = true;
	}
	if($register){
?>
		<h1>注册</h1>
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
				<label for="password">请再次输入密码</label>
				<input type="password" name="password2" id="password2" required>
			</div>
			<div>
				<label for="email">邮箱</label>
				<input type="email" name="email" id="email" required>
			</div>
			<div>
				<label for="verify">验证码</label>
				<input type="text" name="verify" id="verify" required>
				<img src="captcha.php" alt="verification pass-phrase">
				<input type="submit" name="submit" value="提交" id="submit">
			</div>
		</form>
<?php
	}
?>
	</div>
<?php
 require_once('footer.php');
?>
</body>
</html>
