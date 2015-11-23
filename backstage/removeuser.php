<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php
	if ( isset($_GET['id']) ){
		$delete_ID = $_GET['id'];
		$dbc = mysqli_connect('localhost','root','','xuan')
				or die('Error connecting to MySQL server!');
		$query = "DELETE FROM user WHERE user_ID = $delete_ID";
		$data = mysqli_query($dbc,$query)
				or die('Error quering database!');
		mysqli_close($dbc);
		echo '删除成功';
		header('Refresh: 2; url = user.php');
	} else {
		echo 'something wrong';
	}
?>
</body>
</html>