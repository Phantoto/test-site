<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="margin: -8px;">
<?php
		$connect = mysqli_connect('127.0.0.1','root','','test');
		$query = mysqli_query($connect, "SELECT * FROM announcments WHERE id='".$_GET['id']."'");
		$num_rows = mysqli_num_rows($query);
?>
<header style=" height: 100px; background-color: red;">
		<div style="margin-left: 200px;padding-top: 20px">
			<a href="list.php">back</a>
			<a href="create.php">create</a>
			<a href="index.php">main</a>
		</div>
</header>
<div style="margin-left: 400px;margin-right: 400px">
	<?php for ($i=0; $i < $num_rows ; $i=$i+1) { ?>
		<?php  $result1 = $query->fetch_assoc()?>
		<p><?php echo $result1["name"] ?></p>
		<p><?php echo $result1["description"] ?></p>
		<img src="<?php echo $result1["image"];?>" style="width: 720px;">
		<p><?php echo $result1["date"] ?></p>
	<?php }?>
</div>
</body>
</html>