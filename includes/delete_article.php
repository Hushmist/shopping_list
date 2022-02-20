<?php
include("db.php");
require_once("check_stranger.php");
require_once("check_access.php");
$id = $_GET['id'];
$sql = "DELETE FROM `articles` WHERE `id` = '$id'";
if(mysqli_query($connection, $sql)) {
	echo "article deleted";
	header("Location: ../index.php");
	exit();
} else {
	echo "Error";
	exit();
}
?>