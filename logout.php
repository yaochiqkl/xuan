<?php
	if (isset($_COOKIE['user_ID'])) {
		setcookie('user_ID','',time()-3600);
		setcookie('username','',time()-3600);
		echo 'Succees!';
	}
	$home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
	header('Location: '.$home_url);
?>