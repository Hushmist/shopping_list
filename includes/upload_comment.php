<?php 
require_once("db.php");
require_once("check_stranger.php");
$text = $_POST['text'];
$sql = "INSERT INTO articles (title, image) VALUE ('$text','$image_name')";
if (mysqli_query($connection, $sql)) {
		move_uploaded_file($_FILES['image']['$image_tmp'] , '../assets/' . $image_name); 
		echo "Post created";
	} else {
		echo "Error";
	}
	header('Location: ../index.php');
	exit();
?>