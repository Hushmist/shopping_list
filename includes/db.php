<?php
include("config.php");
$connection = mysqli_connect(
	$config['db']['address'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['db_name'],
	);
?>