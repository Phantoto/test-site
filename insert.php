<?php 
date_default_timezone_set( 'Asia/Tokyo' );
 $data = date("YmdHis");

	$connect = mysqli_connect('127.0.0.1','root','','test');
	mysqli_query($connect,"INSERT INTO announcments(name,description,image,date) VALUES('".$_GET['name']."','".$_GET['description']."','".$_GET['image']."','$data')");
	header('Location: index.php');
	
 ?>