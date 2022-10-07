<?php  
include("../includes/db.php");

if(empty($_GET['id'])) {

	header("Location: /index.php");
	exit();
}

$table = mysqli_query($connection, "
	DELETE FROM `list` 
	WHERE id = " . $_GET['id']
);

	header("Location: /index.php");
	exit();

?>