<?php 
include("../includes/db.php");
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
	<div class="row justify-content-center text-break">
		<div class="col-11 main">
			<div class="row justify-content-between">
				<div class="col-9">
					<div class="last_news">
						<h1 class="blog_header">Последние новости</h1>
						<div class="last_news_contents">
							
							<?php 
							$table_sql = "SELECT * FROM `articles`";
							$table_count_sql = "SELECT COUNT(`id`) AS total_count FROM `articles`";
							if (isset($_GET['categorie_id'])) {
								$table_sql = $table_sql . " WHERE `categorie_id` =".$_GET['categorie_id'];
								$table_count_sql = $table_count_sql . " WHERE `categorie_id` =".$_GET['categorie_id'];
							} 
							$table_count_q = mysqli_query($connection, $table_count_sql	);
							$table_count = mysqli_fetch_assoc($table_count_q);
							$count = $table_count['total_count'];

							$per_page = 4;
							$page = 1;

							if ( isset($_GET['page'])) {
								$page = $_GET['page'];
							} else if($page <= 0 || $page > $count) {
								$page = 1;
							}

							$offset = ($page * $per_page) - $per_page;
							$table_sql = $table_sql . " LIMIT $offset,$per_page"; 
							$table = mysqli_query($connection, $table_sql);
							?>
							<h1 class="blog_header">
								<?php
									if(isset($_GET['categorie_id'])) {
										echo $categories['title'][$_GET['categorie_id']-1];
									} else {
										echo "Все статьи";
									}
								?>
							</h1>
							<div class="last_news_contents">
								<?php 
									$isArticle = false;
									if (!(mysqli_num_rows($table))) {
										echo "Статьи не найдены" . "<br>";
										echo 'Вернуться на <a href="../index.php">главную страницу</a>';
										header("Location: ../index.php");
										exit();
									} else {
										$isArticle = true;
									}

									include("../includes/show_articles.php");
									show_articles($table);
									unset($table); 
									?>

							</div>
							<?php
							// Paginator
							if($isArticle) {
								?>
								<div class="read_create_article_btn">
									<div class="row justify-content-evenly">
										<?php 
											if ($page > 1) {
										?>
												<div class="col-3">
													<?php
														if (isset($_GET['categorie_id'])) {
															echo '<a href="articles.php?page='.($page-1).'&categorie_id='.$_GET['categorie_id'].'">';
													?>
																<div class="btn-group" role="group" aria-label="Basic outlined example">
																	<button type="button" class="btn btn-outline-dark">
																		&laquo; На предведущую страницу  
																	</button>
																</div>
														<?php	
															echo '</a>';
														} else {
															echo '<a href="articles.php?page='.($page-1).'">';
																	?>
																		<div class="btn-group" role="group" aria-label="Basic outlined example">
																			<button type="button" class="btn btn-outline-dark">
																				&laquo; На предведущую страницу  
																			</button>
																		</div>
																	<?php	
															echo '</a>';
														}
													?>
												</div>
										<?php 
											}
											if ($page < ceil($count/$per_page)) {
										?>
												<div class="col-3">
													<?php
														if (isset($_GET['categorie_id'])) {
															echo '<a href="articles.php?page='.($page+1).'&categorie_id='.$_GET['categorie_id'].'">';
													?>
																<div class="btn-group" role="group" aria-label="Basic outlined example">
																	<button type="button" class="btn btn-outline-dark">
																		На следующую страницу &raquo
																	</button>
																</div>
														<?php	
															echo '</a>';
														} else {
															echo '<a href="articles.php?page='.($page+1).'">';
														?>
																	<div class="btn-group" role="group" aria-label="Basic outlined example">
																		<button type="button" class="btn btn-outline-dark">
																			На следующую страницу &raquo
																		</button>
																	</div>
														<?php	
															echo '</a>';
														}
											?>
												</div>
											<?php
											}
														?>
									</div>
								</div>
							<?php
							} else {
								echo "Статьи не найдены" . "<br>";
								echo "Вернуться на <a>главную страницу</a>";
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
