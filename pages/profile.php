<?php 
require_once("../includes/db.php");
session_start();
if(!isset($_SESSION['user'])) {
	header('Location: ../index.php');
	exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $config['title'] ?></title>
	<link rel="stylesheet" type="text/css" href="../<?php echo $config['css'] ?>">
</head>
<body>
<?php
include("../includes/header.php")
?>

<div class="container-fluid background">
	<div class="row justify-content-center">
		<div class="col-11 main text-break">
			<div class="row justify-content-between">
				<div class="col-9">
					<h1 class="blog_header">Профиль</h1>
					<div class="login">
						<div class="d-block">
							<img class="d-block m-auto" src="../assets/uploads/<?= $_SESSION['user']['avatar'] ?>" width="200">
						</div>
						<div class="block">
							<h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
							<h5>Почта: <?= $_SESSION['user']['email'] ?></h5>
						</div>
					</div>

					<h1 class="blog_header">Ваши статьи</h1>
					<div class="last_news_contents">
						<?php 	
							$table = mysqli_query($connection, "SELECT * FROM `articles` WHERE `author_id` = '".$_SESSION['user']['id'] ."'");
							if(!mysqli_num_rows($table)) {
								echo '<h2 class="text-center">Вы еще не писали статьи</h2>';
							}
							include("../includes/show_articles.php");
							show_articles($table);
							unset($table);
						?>
					</div>
					<h1 class="blog_header">Вам понравилось</h1>
					<div class="last_news_contents">
						<?php 	
							$user_like_article_q = mysqli_query($connection, "SELECT * FROM `likes` WHERE `user_id` = " . $_SESSION['user']['id']);
							if(!mysqli_num_rows($user_like_article_q)) {
									echo '<h2 class="text-center">Вы ещё не выбрали понравившиеся статьи</h2>';
							} else {
								while($user_like_article = mysqli_fetch_assoc($user_like_article_q)) {
									$table = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = '".$user_like_article['article_id'] ."'");
									
									show_articles($table);
								}
								unset($table);
							}
						?>
					</div>
					<h1 class="blog_header">Ваши комментарий</h1>
						<div class="comments">
							<div class="comments_contents">
								<?php
								$table = mysqli_query($connection, "SELECT * FROM `comments` WHERE `author_id` = '". $_SESSION['user']['id'] ."' ORDER BY `id` DESC LIMIT 5");
								if(mysqli_num_rows($table)) {
									while($comment = mysqli_fetch_assoc($table)) {
										$user = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = ".$comment['author_id']));

										?>
											<a class="comment" href="../pages/article.php?id=<?php echo($comment['article_id']) ?>">
												<img src="../assets/uploads/<?=$user['avatar']?>">
												<div class="comments-text most_views_text ">
													<?php echo mb_substr($comment['text'] , 0, 80, 'utf-8') ?>
												</div>
											</a>

										<?php
									}
								} else {
									echo '<h2 class="text-center">Вы ещё не писали комментарий</h2>';
								}
								?>
								
							</div>
						</div>
				</div>
				<div class="col-3">
					<?php include("../includes/second_col.php") ?>
				</div>
				
			</div><!-- row-2nd  -->
		</div><!-- col-10  -->
	</div><!-- row-1st  -->
</div><!-- container  -->

</body>
</html>