<?php 
session_start();
require_once("../includes/db.php");
if(isset($_SESSION['user'])) {
	header('Location: profile.php');
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
	<?php include("../includes/header.php"); ?>
	<div class="background">
		<div style="height: 23vh;"></div>
			<div class="login">
				<form action="signup.php" method="post" enctype="multipart/form-data">
					<label>ФИО</label>
					<input type="text" name="full_name" placeholder="Введите Ваше полное имя" >
					<label>Логин</label>
					<input type="text" name="login" placeholder="Введите Ваш логин" >
					<label>Почта</label>
					<input type="email" name="email" placeholder="Введите Вашу эл. почту" >
					<label>Изоброжение</label>
					<input type="file" name="avatar" placeholder="Загрузите Ваш аватар">
					<label>Пароль</label>
					<input type="password" name="password" placeholder="Введите Ваш пароль">
					<label>Подтвердите пароль</label>
					<input type="password" name="password_confirm" placeholder="Введите Ваш пароль заново">
					<button type="submit">Отправить</button>
					<a href="login.php">Логин</a>
					<?php
					if(isset($_SESSION["message"])) {
						echo '<p class="msg">'.$_SESSION["message"] .'</p>';
					}
					unset($_SESSION['message']);
					?>
				</form>
			</div>
			
	</div>
	
	

</body>
</html>