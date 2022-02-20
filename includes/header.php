<?php 
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../assets/css/<?php echo $config['bootstrap.css'] ?>">
	<link href="../<?php echo $config['css'] ?>" rel="stylesheet" type="text/css">
</head>
<body>
		<div class="container-xxl bg-dark d-flex" style="padding: 1vh 0;" > 
			<div class="d-block m-auto">
				<a class="header_logo" href="../index.php">
					<img class="header_logo_img" src="../assets/gamepad.png">
					<div class="header_logo_text">
						<h2>
							<?php echo $config['title'] ?>	
						</h2>
					</div>
				</a>
			</div>

			<div class="d-block m-auto">
				<div class="header_navigation">
						<?php
						$categories = array( 
							'id' => array(), 
							'title' => array(),
						);
						$table = mysqli_query($connection, "SELECT * FROM `categories`");
						while ($cat = mysqli_fetch_assoc($table)) {
							$categories['id'][] = $cat['id'];
							$categories['title'][] = $cat['title'];
						?>
							<a href="../pages/articles.php?categorie_id=<?php echo($cat['id']) ?>" class="header_navigation_text">
								<h2>
									<?php echo $cat['title'] ?>
								</h2>
							</a>
						<?php
						}
						?>
				</div>
			</div>
			<div class="d-block m-auto">
				<div class="header_login">
					<h3>
						<?php
							if(isset($_SESSION['user'])) {
								?>
								<a href="../pages/profile.php" class="header_login_text"><?php echo $_SESSION['user']['login'] ?></a>
								<a href="../pages/logout.php" class="header_login_text">| Log out</a>
								<?php
							} else {
								?>
								<a href="../pages/login.php" class="header_login_text">Log in</a>
								<?php
							}
						?>
					</h3>
				</div>
			</div>
			
		</div>
	<script type="text/javascript" src="../assets/js/<?php echo $config['bootstrap.js'] ?>"></script>
</body>
</html>