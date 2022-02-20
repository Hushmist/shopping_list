<?php   
require_once("db.php");
require_once("check_stranger.php");
require_once("check_access.php");
session_start();
$article_q = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = ".$_GET['id']." ");
$article = mysqli_fetch_assoc($article_q);
$id = $_GET['id'];
$title = $_POST['title'];
$text = $_POST['text'];
$categorie = $_POST['categorie'];
$sql = "UPDATE `articles` SET `title` = '$title', `text` = '$text', `categorie_id` = '$categorie' WHERE `articles`.`id` = $id";
if(isset($_FILES)) {
	$image_name =  "uploads/" . time() . $_FILES['image']['name'];
	$image_tmp = $_FILES['image']['tmp_name'];
	$sql_img = "UPDATE `articles` SET `image` = '$image_name' WHERE `articles`.`id` = '$id'";
	if(move_uploaded_file($_FILES['image']['tmp_name'] , '../assets/' . $image_name)) {
		if(mysqli_query($connection, $sql_img)) {
			echo "Post updated";
		}
	} else {
		$_SESSION['message'] = "Ошибка при загрузки изоброжения";
		header("Location: ../pages/create_post.php");
	}

}
if (!mysqli_query($connection, $sql)) {
		$_SESSION['message'] = "Ошибка запроса к базе данных";
		header("Location: ../pages/update_post.php");
		exit();
	}
	header("Location: ../pages/article.php?id=".$article['id']);
	exit();
?>