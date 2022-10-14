<?php 
	$table = mysqli_query($connection, "
		SELECT *
		FROM `list`
		ORDER BY `id` DESC"
	);

	$last_update_table = mysqli_query($connection, "
		SELECT created_at
		FROM `list`
		ORDER BY `id` DESC
		LIMIT 1"
	);
	$last_update_array = mysqli_fetch_assoc($last_update_table);

	$last_update = $last_update_array['created_at'];  
?>
