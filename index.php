<?php  
include("includes/db.php");
include("includes/check_access.php")
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config['title'] ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/<?php echo $config['bootstrap.css'] ?>">
	<link href="<?php echo $config['css'] ?>" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
include("includes/header.php");
?>

<div class="container-fluid background">
	<div class="row justify-content-center">
		<div class="col-11 main text-break">
			<div class="row justify-content-between">
				<div class="col-9">
					<h1 class="blog_header">Последние новости</h1>
					<div class="last_news_contents">
						<div class="read_create_article_btn">
							<div class="row justify-content-evenly">
								<div class="col-3">
									<a href="pages/articles.php">
										<div class="btn-group" role="group" aria-label="Basic outlined example">
											<button type="button" class="btn btn-outline-dark">
												Все статьи
											</button>
										</div>
									</a>
								</div>
								<?php
									if($_SESSION['user']) {
								?>
								<div class="col-3">
									<a href="pages\create_post.php">
										<div href="pages\create_post.php" class="btn-group" role="group" aria-label="Basic outlined example">
											<button type="button" class="btn btn-outline-dark">
														Создать статью
											</button>
										</div>
									</a>
								</div>
								<?php
									}
								?>
							</div>
						</div>
						<?php 	
							$table = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 5"); 
							include("includes/show_articles.php");
							show_articles($table);
							unset($table);
						?>
					</div>
				</div>

				<div class="col-3">
					<?php include("includes/second_col.php") ?>
				</div>
				
			</div><!-- row-2nd  -->
		</div><!-- col-10  -->
	</div><!-- row-1st  -->
</div><!-- container  -->
	
<script type="text/javascript" src="assets/js/<?php echo $config['bootstrap.js'] ?>"></script>
</body>
</html>