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
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
<?php
	$dbc = mysqli_connect('localhost','root','','xuan');
    //删除
	if (isset($_POST['submit'])){
		foreach ( $_POST['todelete'] as $delete_ID){
			$query = "DELETE FROM user WHERE user_ID = $delete_ID";
			mysqli_query($dbc,$query);
			echo '批量删除成功';
		}
	}
	//显示列表
	$query = "SELECT * FROM user ORDER BY user_ID";
	$data = mysqli_query($dbc,$query);
	echo '<table>';
	while ($row = mysqli_fetch_array($data)){
		echo '<tr class=""><td><input type="checkbox" value="'.$row['user_ID'].'" name="todelete[]" ></td>';
		echo '<td><strong>'.$row['username'].'</strong></td>';
		echo '<td>'.$row['user_email'].'</td></tr>';
	}
	echo '</table>';

	mysqli_close($dbc);
?>
	<input type="submit" name="submit" value="删除">
	</form>
	<a href="admin.php">返回</a>

</body>
</html>