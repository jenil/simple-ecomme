<?php
	//Start session
	session_start();
	//Include database connection details
	require_once(__DIR__.'/../config.php');

	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if (!$link) {
		die("Cannot access db.");
	}

	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

	$user_id = $_SESSION['SESS_USER_ID'];
	$od_date = date('Y-m-d');
	$od_name = $_POST['name'];
	$od_address = $_POST['address'];
	$od_city = $_POST['city'];
	$od_postal_code = $_POST['postal_code'];
	$od_cost = $_SESSION['total'];

	$qry = "INSERT INTO `tbl_order` ( `user_id`, `od_date`, `od_status`, `od_name`, `od_address`, `od_city`, `od_postal_code`, `od_cost`)
			VALUES
				( ".$user_id.", '".$od_date."', 'New', '".$od_name."', '".$od_address."', '".$od_city."', '".$od_postal_code."', '".$od_cost."');
			";
	$result = mysql_query($qry);

	$od_id = mysql_insert_id();

	foreach($_SESSION['CART'] as $cart_item_ID => $cart_item)
	{
		$qry = "INSERT INTO `tbl_order_item` (`od_id`, `pd_id`, `od_qty`) VALUES (".$od_id.", ".$cart_item['pd_id'].", 1);";
		$result = mysql_query($qry);

		$qry = "UPDATE `tbl_product` SET `tbl_product`.`pd_qty` = `tbl_product`.`pd_qty` - 1 WHERE pd_id=".$cart_item['pd_id'];
		$result = mysql_query($qry);
	}

	//Check whether the query was successful or not
	if($result) {
		unset($_SESSION['CART']);
		$_SESSION['MSGS'] = array('<strong>Wohu!</strong> Your order has been placed.');
		session_write_close();
		header("location: ../profile.php");
		exit();
	} else {
		die("Query failed: ".mysql_error());
	}
?>