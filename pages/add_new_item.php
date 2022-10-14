<?php  
include("../includes/db.php");

if(empty($_GET['item'])) {

	header("Location: /index.php");
	exit();
}

$table = mysqli_query($connection, "
	INSERT INTO `list`(`text`, `created_at`) 
	VALUES ('" . $_GET['item'] . "', now())"
);

	header("Location: /index.php");
	exit();

?>