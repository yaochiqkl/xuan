<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="./css/index.css">
</head>
<body>
	<header>
<?php
	require_once('header.php');
?>
	</header>
	<div class="container">
		<article class="a1">
			<img src="images/photo-icon.png">
			<div class="headertext">
				<h1 class="head">How-Old.net</h1>
				<div class="description">HOW OLD DO I LOOK?
				<span>#HowOldRobot</span></div>
			</div>
		</article>

		<article class="a2">

<?php
	define('UPLOAD_PATH','vidios/');

	if(isset($_POST['submit'])){
		$file = $_FILES['file']['name'];
		$file = iconv("UTF-8","GB2312",$file); //中文GBK编码乱码问题
		if($_FILES['file']['error'] > 0){
			echo "Error".$_FILES['file']['error']."<br>";
		} else {
			echo "Upload : ".$_FILES['file']['name'];
		}
		$target = UPLOAD_PATH.$file;
		if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){
			$dbc = mysqli_connect('localhost','root','','xuan')
				or die('Error connecting to MySQL server!');
			$query = "INSERT INTO vidio (vidio_name,vidio_upload_time)".
				"VALUES('$file',NOW())";
			$result = mysqli_query($dbc,$query)
				or die('Error quering database!');
			mysqli_close($dbc);
			$upload = false;
			echo '上传成功';
			echo "返回<a href='index.php'>主页</a>";
		}
	} else {
		$upload = true;
	}
	if($upload){
?>
			<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
				<div class="upload_group">
					<input type="hidden" name="MAX_FILE_SIZE" value="3200000">
					<input class="file" type="file" id="file" name="file">
					<input class="submit" type="submit" value="上传" name="submit">
				</div>
				<!--
				<div class="input-group" >
					<input class="input-engine">
					<input id="upfile" type="file">
					<div class="filetext"><span id="filename">请上传文件</span></div>
					 <input type="text" class="submit">
				</div> -->
			</form>
			<div class="vidio">
				<img src="./images/1.jpg">
			</div>
		</article>
<?php
	}
?>
	</div>
<?php
 require_once('footer.php');
?>
<!--	<script type="text/javascript">
	var upfile = document.getElementById("upfile");
	upfile.onchange = function() {
		updateFilename(this.value);
	};
	function extractFilename(path) {
	  var x;
	  x = path.lastIndexOf('\\');
	  if (x >= 0) // 基于Windows的路径
	    return path.substr(x+1);
	  x = path.lastIndexOf('/');
	  if (x >= 0) // 基于Unix的路径
	    return path.substr(x+1);
	  return path; // 仅包含文件名
	}
	function updateFilename(path) {
	   var name = extractFilename(path);
	   document.getElementById('filename').textContent = "您上传的是 "+name;
	 }
	</script>-->
</body>
</html>
