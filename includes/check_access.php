<?php
if(!mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `articles` WHERE `author_id` = '".$_SESSION['user']['id']."'")) && $_SESSION['user']['id'] > 17) {
		header("Location: ../index.php");
		exit();
	}
?>