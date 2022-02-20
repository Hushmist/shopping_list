<div> 
	<div class="most_views">
		<h2 class="blog_header">Топ просмотры</h2>
		<div class="most_views_contents">
			<table>
				<?php
				$table = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `views` DESC LIMIT 4");
				for ($i = 0; $i <4; $i++) {
					if($article = mysqli_fetch_assoc($table)) {
						if($i%2 == 0) {
							?>
							<tr>	
							<?php
						}
						?>
						<td class="most_views_content">
							<a class="blog" href="../pages/article.php?id=<?php echo($article['id']) ?>">
								<img class="most_views_img" src="../assets/<?php echo $article['image'] ?>">
								<div class="most_views_text">
									<?php echo mb_substr($article['title'], 0, 90, 'utf-8') ?>
									</div>
							</a>
						</td>
						<?php
					}
				}
				?>
			</table>
			
		</div>
	</div>
	
	<div class="most_views">
		<h2 class="blog_header">Топ обсуждаемых</h2>
		<div class="most_views_contents">
			<table>
				<?php
				$table = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `comments` DESC LIMIT 4");
				for ($i = 0; $i <4; $i++) {
					if($article = mysqli_fetch_assoc($table)) {
						if($i%2 == 0) {
							?>
							<tr>
							<?php
						}
						?>
							<td class="most_views_content">
								<a class="blog" href="../pages/article.php?id=<?php echo($article['id']) ?>">
									<img class="most_views_img" src="../assets/<?php echo $article['image'] ?>">
									<div class="most_views_text">
										<?php echo mb_substr($article['title'], 0, 90, 'utf-8') ?>
										</div>
								</a>
							</td>
						<?php
					}
				}
				?>
			</table>
			
		</div>
	</div>

	<div class="comments">
		<h2 class="blog_header">Последние комментарий</h2>
		<div class="comments_contents">
			<?php
			$table = mysqli_query($connection, "SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 5");
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
			?>
			
		</div>
	</div>
</div>