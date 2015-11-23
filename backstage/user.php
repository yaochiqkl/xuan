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
	$query = "SELECT * FROM user ORDER BY user_ID";
	$data = mysqli_query($dbc,$query);
	echo '<table>';
	while ($row = mysqli_fetch_array($data)){
		echo '<tr class=""><td><strong>'.$row['username'].'</strong><td>';
		echo '<td>'.$row['user_email'].'</td>';
		echo '<td><a href="removeuser.php?id='
			.$row['user_ID']
			.'" onClick="if(confirm('
			.'\'确定要删除吗？\''
			.'))return true;return false;">删除</a></td></tr>';
	}
	echo '</table>';
?>
	SECRET
	<a href="admin.php">返回</a>

</body>
</html>