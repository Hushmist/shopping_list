<?php  
include("db.php");
require_once("check_stranger.php");
require_once("check_access.php");
session_start();
$title = $_POST['title'];
$text = $_POST['text'];
$categorie = $_POST['categorie'];
$user_id = $_SESSION['user']['id'];
if($_FILES['image']['size'] != 0) {
	$isImage = true;
	$image_name =  "uploads/" . time() . $_FILES['image']['name'];
	$image_tmp = $_FILES['image']['tmp_name'];
	echo "there is file";
	$sql = "INSERT INTO articles (title, author_id, text, categorie_id, image) VALUE ('$title','$user_id', '$text', '$categorie', '$image_name')";
} else {
	$isImage = false;
	$sql = "INSERT INTO articles (title, author_id, text, categorie_id) VALUE ('$title','$user_id', '$text', '$categorie')";
	unset($_FILES);
	echo "no file";
}

if (mysqli_query($connection, $sql)) {
		if(move_uploaded_file($image_tmp , '../assets/' . $image_name) || !isImage) {
			echo "Post created";
		} else {
			$_SESSION['message'] = "Ошибка при загрузки изоброжения";
			header("Location: ../pages/update_post.php");
		}
	} else {
		$_SESSION['message'] = "Ошибка запроса к базе данных";
		header("Location: ../pages/update_post.php");
	}
	$article_q = mysqli_query($connection, "SELECT * FROM `articles` WHERE `author_id` = '$user_id' ORDER BY id DESC LIMIT 1");
	$article = mysqli_fetch_assoc($article_q);
	header("Location: ../pages/article.php?id=".$article['id']);
	exit();
?>