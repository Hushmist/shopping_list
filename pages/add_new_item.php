<?php  
include("../includes/db.php");

if(empty($_GET['item'])) {

	header("Location: /index.php");
	exit();
}

$table = mysqli_query($connection, "
	INSERT INTO `list`(`text`) 
	VALUES ('" . $_GET['item'] . "')"
);

	header("Location: /index.php");
	exit();

?>