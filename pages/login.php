<?php include("../includes/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $config['title'] ?></title>
	<link rel="stylesheet" type="text/css" href="../<?php echo $config['css'] ?>">
	
</head>
<body>
<?php 
include("../includes/header.php");
if(isset($_SESSION['user'])) {
	header('Location: profile.php');
	exit();
}
?>
<div class="background">
	<div class="container">
		<div class="main" style="margin: 0; padding: 6vh;">
			<h1 class="blog_header">Авторизация</h1>
			<div class="login">
				<form action="signin.php" method="post">
					<label>Логин</label>
					<input type="text" name="login" placeholder="Введите ваш логин">
					<label>Пароль</label>
					<input type="password" name="password" placeholder="Введите ваш пароль">
					<button type="submit">Отправить</button>
					<a href="register.php">Регистрация</a>
					<?php
					if(isset($_SESSION["message"])) {
						echo '<p class="msg">'.$_SESSION["message"] .'</p>';
						unset($_SESSION['message']);
					}
					unset($_SESSION['user_temp']);
					?>
				</form>
			</div>
		</div>
	</div>
</div>


</body>
</html>