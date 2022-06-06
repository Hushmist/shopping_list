<?php   
require_once("db.php");
require_once("check_stranger.php");
require_once("check_access.php");
session_start();
$comment_q = mysqli_query($connection, "SELECT * FROM `comments` WHERE `id` = ".$_GET['id']." ");
$comment = mysqli_fetch_assoc($comment_q);
$id = $_GET['id'];
$text = $_POST['text'];
$sql = "UPDATE `comments` SET `text` = '$text' WHERE `comments`.`id` = $id";

mysqli_query($connection, $sql);

header("Location: ../pages/article.php?id=".$comment['article_id']);
exit();
?>