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
$article_q = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = ".$_GET['id']." ");
$article = mysqli_fetch_assoc($article_q);
include("../includes/header.php");
?>
<div class="background">
	<div class="container-xl">
		<div class="row justify-content-center">
			<div class="col-9 main">
				<h1 class="blog_header block">Обновить статью</h1>
				<div class="login">
					<form action="../includes/update_article.php?id=<?= $article['id'] ?>" method="post" enctype="multipart/form-data">
						<h5 class="upload_post_text">Заголовок</h5>
						<input  type="text" name="title" placeholder="Заголовок" value="<?= $article['title'] ?>">
						<h5 class="upload_post_text">Основной текст</h5>
						<textarea class="creat_post_text" type="" name="text" placeholder="Напишите здесь текст"><?= $article['text'] ?></textarea>
						<h5 class="upload_post_text" >Выберите категорию</h5>
						<select name="categorie">
							<?php
								echo '<option value="'.$categories['id'][$article['categorie_id']-1].'">'.$categories['title'][$article['categorie_id']-1].'</option>';
								for($i = 0; $i < count($categories['id']); $i++) {
									if($i != $article['categorie_id']-1)
										echo '<option value="'.$categories['id'][$i].'">'.$categories['title'][$i].'</option>';
								}
							?>
						</select>
						<h4 class="upload_post_text" >Загрузите изображение</h4>
						<input type="file" name="image">
						<input type="submit" value="Отправить">
					</form>
				</div>
				<?php
					if(($_SESSION['user']['id'] <= 17 || mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `articles` WHERE `author_id` = '".$_SESSION['user']['id']."'"))) && isset($_SESSION['user'])) {
					?>
						<div class="read_create_article_btn">
							<div class="row justify-content-evenly">
								<div class="col-3 col-3 text-center">
										<div href="pages\create_post.php" class="btn-group" role="group" aria-label="Basic outlined example">
											<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
												Удалить
											</button>
											<!-- Modal -->
											<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h5 class="modal-title" id="exampleModalLabel">Предупреждение</h5>
											        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											      </div>
											      <div class="modal-body">
											        Вы уверены что хотите удалить статью?
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
											        <button type="button" class="btn btn-primary"><a style="color: white" href="../includes/delete_article.php?id=<?= $article['id'] ?>">Да, удалить статью</a></button>
											      </div>
											    </div>
											  </div>
											</div>
										</div>
								</div>
							</div>
						</div>
				<?php
					}	
				?>
				<div style="height: 5vh"></div>
			</div>
		</div>
		
	</div>
</div>

</body>
</html>