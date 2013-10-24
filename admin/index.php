<?php
session_start();
if(!isset($_SESSION['SESS_USER_ID']) || (trim($_SESSION['SESS_USER_ID']) == '')) {
	header("location: ../access-denied.php");
	exit();
}
if(intval($_SESSION['SESS_IS_ADMIN']) !== 1)
{
	header("location: ../access-denied.php");
	exit();
}
?>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/styles.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="main">
	<div class="container">
	<h2>iDukan : Administration</h2><a href="../" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-left"></span> Back to site</a>
	<hr>
	<?php
      if( isset($_SESSION['MSGS']) && is_array($_SESSION['MSGS']) && count($_SESSION['MSGS']) >0 ) {
          ?>
          <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul class="list-unstyled">
              <?php 
              foreach ($_SESSION['MSGS'] as $msg) {
                echo '<li>'.$msg.'</li>';
              }
              ?>
            </ul>
          </div>
        <?php
        unset($_SESSION['MSGS']);
      }
    ?>
    <?php
      if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
          ?>
          <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Oh no!</strong> Please fix the following errors and try again.
            <ul class="list-unstyled">
              <?php 
              foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                echo '<li>'.$msg.'</li>';
              }
              ?>
            </ul>
          </div>
        <?php
        unset($_SESSION['ERRMSG_ARR']);
      }
    ?>
	<ul class="nav nav-tabs" id="tabs">
	  <li class="active"><a data-toggle="tab" href="#category">Categories</a></li>
	  <li><a data-toggle="tab" href="#products">Products</a></li>
	  <li><a data-toggle="tab" href="#orders">Orders</a></li>
	</ul>

	<div class="tab-content" style="padding-top: 20px;">
	  <div class="row tab-pane fade in active" id="category">
	  	<?php include_once 'category.php'; ?>
	  </div>
	  <div class="row tab-pane fade" id="products">
	  	<?php include_once 'products.php'; ?>
	  </div>
	  <div class="tab-pane fade" id="orders">
	  	<?php include_once 'orders.php'; ?>
	  </div>
	</div>
	<script>
	  $(function () {
	    //$('#tabs a:last').tab('show')
	  })
	</script>
	</div>
</div>
</body>
</html>