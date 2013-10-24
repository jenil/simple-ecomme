<?php
session_start();
if(!isset($_GET['id']))
{
	header("location: store.php");
	exit();
}
else {
	//Include database connection details
	require_once('config.php');
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if (!$link) {
		die("Cannot access db.");
	}

	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	$products;
	//get all the categories
	$res = mysql_query("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
						FROM `tbl_product`
						INNER JOIN `tbl_category`
						ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
						WHERE `pd_id`=".$_GET['id']);
	while ($row = mysql_fetch_object($res)) {
		$product = $row;
	}
}
?>
<?php
include 'includes/header.php';
include 'includes/nav.php';
?>
<div id="main">
	<header class="container">
      <ol class="breadcrumb">
        <li>
          <a href="store.php">Store</a>
        </li>
        <li>
          <a href="store.php?category=<?php echo $product->cat_id ?>"><?php echo $product->cat_name ?></a>
        </li>
        <li class="active"><?php echo $product->pd_name ?></li>
      </ol>
    </header>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <img src="img/uploads/<?php echo $product->pd_image; ?>" class="img-responsive">
        </div>
        <div class="col-md-8">
          <h3><?php echo $product->pd_name ?></h3>
          <hr>
          <?php setlocale(LC_MONETARY,'en_US'); ?>
          <h4><strong>Price:</strong> &#8377; <?php echo money_format('%!i', floatval($product->pd_price)) ?></h4>
          <p><?php echo $product->pd_description ?  $product->pd_description : '<span class="text-muted">No description</span>'; ?></p>
          <p>Available Quantity: <span class="badge"><?php echo $product->pd_qty ?></span></p>
          <a href="cart.php?add=<?php echo $product->pd_id; ?>" class="btn btn-primary">Add to Cart<br></a>
        </div>
      </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>