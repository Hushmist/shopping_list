<?php 
include("../includes/db.php");
include("../includes/check_admission.php");
 
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config['title'] ?></title>
	<link href="../<?php echo $config['css'] ?>" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
include("../includes/header.php");
?>

<div class="container-fluid background">
	<div class="row justify-content-center">
		<div class="col-11 main text-break">
			<div class="row justify-content-between">
				<div class="col-9">
					<div class="article">
						<?php 
							$table = mysqli_query($connection, "SELECT a.*, c.title as categorie_title FROM `articles` a INNER JOIN `categories` c ON a.categorie_id = c.id WHERE a.`id` = " . (int) $_GET['id'] );
							if(!($article = mysqli_fetch_assoc($table))) {
						?>
								<h1 class="article_caption">Cтатья не найдена</h1>
								<img class="article_img" src="../assets/wrong_article.png">
								<p class="article_text">Запрашиваемая статья не найдена. Пожалуйсита обратитесь к тех. поддержке</p>
								<?php
							} else {
								mysqli_query($connection, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = " . (int) $article['id']);
								?>
								<h1 class="article_caption"><?php echo $article['title'] ?></h1>
								<div class="article_contents">
									<img class="article_img" src="../assets/<?php echo $article['image'] ?>">
									<div class="article_additionally_data justify-content-center">
										<p>Категория: 
											<a class="blog_post_text_categorie_link" href="articles.php?categorie=<?php echo($article['categorie_id']) ?>">
												<?php echo $article['categorie_title'];?>
											</a> 
										</p>
										<p>
											Автор: 
											<?php
												$article_author = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = '".$article['author_id'] ."'"));
												echo $article_author['login'];
											?>
										</p>
										<p class="article_views">Просмотров: <?php echo $article['views'] ?></p>
									</div>
									<?php if(isset($_SESSION['user'])) { ?>
										<form method="post">
											<?php
												
												$isLike = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `likes` WHERE `user_id` = '". $_SESSION['user']['id'] ."' AND `article_id` = '". $article['id'] ."'"));
												if(isset($_POST['like'])) {
													if(!$isLike) {
														mysqli_query($connection, "INSERT INTO `likes` (`user_id`, `article_id`) VALUES ('". $_SESSION['user']['id'] ."', '". $article['id'] ."')");
														$isLike = 1;
													} else {
														mysqli_query($connection, "DELETE FROM `likes` WHERE `user_id` = '". $_SESSION['user']['id'] ."' AND `article_id` = '". $article['id'] ."'");
														$isLike = 0;
													}

													unset($_POST['like']);
												}

											?>
											<img class="article_like_img" src="../assets/<?php  
													if($isLike) {
														echo "like_.png";
													} else {
														echo "like_empty_.png";
													}
												?>">
											

											<button name="like" value="1">Понравилось</button>
											
										</form>
									<?php } ?>
									
									<p class="article_text"><?php echo $article['text'] ?></p>
								</div>
								<?php
									if(($_SESSION['user']['id'] <= 17 || mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `articles` WHERE `author_id` = '".$_SESSION['user']['id']."'"))) && isset($_SESSION['user'])) {
									?>
										<div class="read_create_article_btn">
											<div class="row justify-content-evenly">
												<div class="col-3 text-center">
													<a href="update_post.php?id=<?= $article['id'] ?>">
														<div class="btn-group" role="group" aria-label="Basic outlined example">
															<button type="button" class="btn btn-outline-dark">
																Редактировать
															</button>
														</div>
													</a>
												</div>
											</div>
										</div>
								<?php
									}	
								?>

								<div class="article_comments">
									<h1 class="blog_header">Комментарий</h1>
									<?php
										//deleting comment
										if(check_admission($connection)) {
											if(isset($_POST['delete_comment'])) {
												mysqli_query($connection, "DELETE FROM `comments` WHERE `author_id` = '" . $_SESSION['user']['id'] . "'");
												mysqli_query($connection, "UPDATE `articles` SET `comments` = comments-1 WHERE `id` = '".$article['id']."'");
												unset($_POST['delete_comment']);
											}
										}
										//creating comment
										if(isset($_SESSION['user'])) 
											if (isset($_POST['text']) && $_POST['text'] != $_SESSION['user']['last_text']) {
												mysqli_query($connection, "INSERT INTO `comments` (`id`, `author_id`, `article_id`, `text`) VALUES (NULL, '". $_SESSION['user']['id'] . "','".$article['id']."', '" .$_POST['text']."')");
												$_SESSION['user']['last_text'] = $_POST['text']; //anti-spam sistem
												mysqli_query($connection, "UPDATE `articles` SET `comments` = comments+1 WHERE `id` = '".$article['id']."'");
												unset($_POST['text']);
											}

										//show comments
										$table = mysqli_query($connection, "SELECT * FROM `comments` WHERE `article_id` = ".$article['id']." ORDER BY `id` DESC");
										if(!mysqli_num_rows($table)) {
											echo '<h3>Комментарий отсутствуют. Вы можете быть первым</h3>' . '<br>';
										} else
											while($comment = mysqli_fetch_assoc($table)) {
												$comment_user_q = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = '".$comment['author_id']."'");
												$comment_user = mysqli_fetch_assoc($comment_user_q);
									?>
												<div class="article_comment comment ">
													<img src="../assets/uploads/<?= $comment_user['avatar'] ?>">
														<?php 
															echo $comment_user['login'] .":" . "<br>";
															echo mb_substr($comment['text'] , 0, 80, 'utf-8') 
														?>
												</div>
												<?php
												if(($_SESSION['user']['id'] <= 17 || mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `comments` WHERE `author_id` = '".$_SESSION['user']['id']."'"))) && isset($_SESSION['user'])) {
													if(isset($_POST['delete_comment'])) {
														mysqli_query($connection, "DELETE FROM `comments` WHERE `author_id` = '" . $_SESSION['user']['id'] . "'");
														unset($_POST['delete_comment']);
													}
													?>
													<div class="read_create_article_btn">
														<div class="row justify-content-evenly">
															<div class="col-4">
																<form action="../pages/update_comment.php" method="get">
																	<div class="btn-group" role="group" aria-label="Basic outlined example">
																		<button name="id" value="<?php echo $comment['id'] ?>" class="btn btn-outline-dark">
																			Редактировать
																		</button>
																	</div>
																</form>
															</div>

															<div class="col-4">
																<form method="POST">
																	<div class="btn-group" role="group" aria-label="Basic outlined example">
																		<button name="delete_comment" value="1" class="btn btn-outline-dark">
																			Удалить комментарий
																		</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												<?php } ?>
											<?php 
											}
											
											if(isset($_SESSION['user'])) {
												?>
												<div class="create_comment">
													<h3 class="text-center">Создать комментарий</h3>
													<form method="post">
														<textarea type="text" name="text" placeholder="Текст"></textarea>
														<button type="submit" class="btn btn-secondary btn-lg" width="10">Отправить</button>
													</form>
												</div>
										<?php
											} else {
												?>
													<div class="article_comment_login">
														<a style="text-decoration: underline" href="login.php">Войдите</a> для того что бы создать комментарий
													</div>
												<?php
											}
										?>
								</div>
							<?php } ?>
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