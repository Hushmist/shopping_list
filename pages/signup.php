<?php  
	session_start();
	require_once('../includes/db.php');

	$full_name = $_POST['full_name'];
	$login = $_POST['login'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$avatar = time() . $_FILES['avatar']['name'];

	function save_user_data() {
		$_SESSION['user_temp']['full_name'] = $_POST['full_name'];
		$_SESSION['user_temp']['login'] = $_POST['login'];
		$_SESSION['user_temp']['email'] = $_POST['email'];
		$_SESSION['user_temp']['password'] = $_POST['password'];
	}

	if($password == $password_confirm) {
		if(!move_uploaded_file($_FILES['avatar']['tmp_name'], '../assets/uploads/' .  $avatar)) {
			$_SESSION['message'] = "Ошибка при загрузки изоброжения";
			save_user_data();
		} else if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '". $login ."'"))) {
			$_SESSION['message'] = "Данный логин занять";
			save_user_data();
		} else {
			$password = md5($password); //шифровка пароля
			$avatar = time() . $_FILES['avatar']['name'];
			mysqli_query($connection, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email', '$password', '$avatar')");
			$_SESSION['message'] = "Регистрация прошла успешна";
			unset($_SESSION['user_temp']);
			header('Location: login.php');
			exit();
		}
	} else {
		$_SESSION['message'] = "Ошибка, пароли не совпадають";
		save_user_data();
	}
	header('Location: register.php');
	exit();

?>