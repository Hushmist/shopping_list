<?php
include('db.php');
$username = $_POST['username'];
$password = $_POST['password'];
if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' "))) {

	echo "Авторизация прошла успешно";
	$config['username'] = $username;
	header('Location: ../index.php');
	exit();
} else {
	echo "Ошибка авторизаций, введены неверный логин или пароль";
};


?>