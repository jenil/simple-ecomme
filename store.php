<?php
session_start();
include 'includes/header.php';
include 'includes/nav.php';
?>
<?php
require_once('config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
  die("Cannot access db.");
}

$db = mysql_select_db(DB_DATABASE);
if(!$db) {
  die("Unable to select database");
}
$products = array();

if ( isset($_GET['search']) ) 
{
  $keyword = trim($_GET['search']);
  $res = mysql_query("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
          FROM `tbl_product`
          INNER JOIN `tbl_category`
          ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
          WHERE `pd_name` LIKE '%".$keyword."%'
          ORDER BY `pd_id` DESC");
  while ($row = mysql_fetch_object($res)) {
    $products[] = $row;
  }
}
elseif ( isset($_GET['category']) ) 
{
  $category = trim($_GET['category']);
  $res = mysql_query("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
          FROM `tbl_product`
          INNER JOIN `tbl_category`
          ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
          WHERE `tbl_product`.`cat_id`=".$category."
          ORDER BY `pd_id` DESC");
  while ($row = mysql_fetch_object($res)) {
    $products[] = $row;
  }
}
else
{
  $res = mysql_query("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
          FROM `tbl_product`
          INNER JOIN `tbl_category`
          ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
          ORDER BY `pd_id` DESC");
  while ($row = mysql_fetch_object($res)) {
    $products[] = $row;
  }
}
?>
<div id="main">
    <header class="container">
      <h3 class="page-header">Store</h3>
    </header>
    <div class="container">
      <div class="row">
        <?php if (count($products) > 0) { ?>
          <?php
            foreach ($products as $product) {
          ?>
          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
              <img src="img/uploads/<?php echo $product->pd_image ?>" alt="<?php echo $product->pd_name ?>">
              <div class="caption">
                <h4 class="text-center"><?php echo $product->pd_name ?></h4>
                <!-- <p><?php echo $product->pd_description ?  $product->pd_description : '<span class="text-muted">No description</span>'; ?></p>
                 --><p><a href="product.php?id=<?php echo $product->pd_id; ?>" class="btn btn-default">View</a> <a href="cart.php?add=<?php echo $product->pd_id; ?>" class="btn btn-primary">Add to cart</a></p>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        <?php 
        }
        else
        {
        ?>
        <div class="alert alert-info"><strong>Oh no!</strong> No products found!</div>
        <?php
        } 
        ?>
      </div>
    </div>
  </div>
<?php
include 'includes/footer.php';
?>