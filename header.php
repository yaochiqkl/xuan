<?php
	if (isset ($_COOKIE['user_ID'])){
		echo '<div>Welcome&nbsp;,&nbsp;'.$_COOKIE['username'];
		echo '<a href="logout.php">注销</a></div>';
	} else {
?>
		<div>
		<a href="index.php">首页</a>
		<a href="register.php">注册</a>
		<a href="login.php">登陆</a>
		</div>
<?php
	}
?>