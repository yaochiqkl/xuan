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
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		$register = false;
		$dbc = mysqli_connect('localhost','root','','xuan')
			or die('Error connecting to MySQL server!');
		$query = "INSERT INTO user (username,password,user_email)".
			"VALUES('$username',SHA('$password'),'$email')";
		/*$query = "SELECT * FROM user";*/
		$result = mysqli_query($dbc,$query)
			or die('Error quering database!');
		/*$row = mysqli_fetch_array($result);
		echo $row['username'];*/
		mysqli_close($dbc);
		echo "注册成功，请登录！";
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
				<input type="submit" name="submit" value="提交" id="submit">
			</div>
		</form>
<?php
	}
?>
	</div>
	<footer>
		<hr>
		CopyRight 2015 lsz
	</footer>
</body>
</html>
