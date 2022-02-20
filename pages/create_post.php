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
	if(!$_SESSION['user']) {
		$_SESSION['message'] = "Перед тем как написать комментарий войдите в аккаунт";
		header("Location: login.php");
		exit();
	}
	include("../includes/header.php");
	?>
<div class="background">
	<div class="container-xl">
		<div class="row justify-content-center">
			<div class="col-9 main">
				<h1 class="blog_header block">Создать статью</h1>
				<div class="login">
					<form action="../includes/upload_post.php" method="post" enctype="multipart/form-data">
						<input  type="text" name="title" placeholder="Заголовок">
						<textarea class="creat_post_text" type="" name="text" placeholder="Напишите здесь текст"></textarea>
						<h5 style="margin: 2vh 0 0 0 " >Выберите категорию</h5>
						<select name="categorie">
							<?php
								for($i = 0; $i < count($categories['id']); $i++) {
									echo '<option value="'.$categories['id'][$i].'">'.$categories['title'][$i].'</option>';
								}
							?>
							
						</select>
						<h4 style="margin: 2vh 0 0 0 " >Загрузите изображение</h4>
						<input type="file" name="image">
						
						<input type="submit" value="Отправить">
					</form>
				</div>
				<div style="height: 17vh"></div>
			</div>
		</div>
		
	</div>
</div>

</body>
</html>