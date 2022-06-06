<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $config['title'] ?></title>
	<link href="../<?php echo $config['css'] ?>" rel="stylesheet" type="text/css">
</head>
<body>

<?php 
if(!mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `articles` WHERE `author_id` = '".$_SESSION['user']['id']."'")) && $_SESSION['user']['id'] > 17) {
	header("Location: ../index.php");
	exit();
}
$comment_q = mysqli_query($connection, "SELECT * FROM `comments` WHERE `id` = ".$_GET['id']." ");
$comment = mysqli_fetch_assoc($comment_q);
include("../includes/header.php");
?>
<div class="background">
	<div class="container-xl">
		<div class="row justify-content-center">
			<div class="col-9 main">
				<h1 class="blog_header block">Обновить статью</h1>
				<div class="login">
					<form action="../includes/update_comment.php?id=<?= $comment['id'] ?>" method="post">
						<h5 class="upload_post_text">Обновить комментарий</h5>
						<input  type="text" name="text" value="<?= $comment['text'] ?>">
						<input type="submit" value="Отправить">
					</form>
				</div>
				<div style="height: 5vh"></div>
			</div>
		</div>
		
	</div>
</div>

</body>
</html>