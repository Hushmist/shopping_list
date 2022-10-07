<?php  
include("includes/db.php");

$table = mysqli_query($connection, "
	SELECT *
	FROM `list`
	ORDER BY `id` DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config['title'] ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/<?php echo $config['bootstrap.css'] ?>">
	<link href="<?php echo $config['css'] ?>" rel="stylesheet" type="text/css">
	<script src="https://kit.fontawesome.com/97658cfd90.js" crossorigin="anonymous"></script>
</head>
<body>
<section class="vh-100 background" style="background-color: #e2d5de;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">

        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-5">

            <h6 class="mb-3">Shopping list</h6>

            <form action="pages/add_new_item.php" class="d-flex justify-content-center align-items-center mb-4">
              <div class="form-outline flex-fill">
                <input type="text" name="item" id="form3" class="form-control form-control-lg" />
                <label class="form-label" for="form3">Что купим сегодня?</label>
              </div>
              <button type="submit" class="btn btn-primary btn-lg ms-2">Add</button>
            </form>

            <ul class="list-group mb-0">
            	<?php 
								while($list = mysqli_fetch_assoc($table)) {
							?>
									<li
									  class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">
									  <div class="d-flex align-items-center">
									    <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." />
									    <?php echo $list['text']?>
									  </div>
									  <a href="pages/delete_item.php?id=<?php echo $list['id'] ?>" data-mdb-toggle="tooltip" title="Remove item">
									    <i class="fas fa-times text-primary"></i>
									  </a>
									</li>
            	<?php 
								}
            	?>
              
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<script type="text/javascript" src="assets/js/<?php echo $config['bootstrap.js'] ?>"></script>
</body>
</html>