<?php
function check_admission($connection) {
	if(($_SESSION['user']['id'] <= 17 || mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `articles` WHERE `author_id` = '".$_SESSION['user']['id']."'"))) && isset($_SESSION['user'])) {
		return 1;
	} else {
		return 0;
	}
}
?>