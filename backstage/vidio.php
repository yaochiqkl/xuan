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
<?php
	$dbc = mysqli_connect('localhost','root','','xuan');
	$query = "SELECT * FROM vidio ORDER BY vidio_ID";
	$data = mysqli_query($dbc,$query);
	echo '<table>';
	while ($row = mysqli_fetch_array($data)){
		echo '<tr class=""><td><strong>'.$row['vidio_ID'].'</strong><td>';
		echo '<td>'.$row['vidio_name'].'</td>';
		echo '<td>'.$row['vidio_upload_time'].'</td>';
		echo '<td><a href="removevidio.php?id='.$row['vidio_ID'].'">删除</a></td></tr>';
	}
	echo '</table>';
?>
	SECRET
	<a href="admin.php">返回</a>
</body>
</html>