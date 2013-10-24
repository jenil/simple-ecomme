<?php
if(!isset($_SESSION)) session_start();
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
$products;
//get all the categories
$res = mysql_query("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
					FROM `tbl_product`
					INNER JOIN `tbl_category`
					ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`");
while ($row = mysql_fetch_object($res)) {
	$products[] = $row;
}

//handle new category request
if(is_array($_POST) && count($_POST) > 0) {
	$proname = $_POST['proname'];
	$prodesc = htmlspecialchars($_POST['prodesc']);
	$category = intval($_POST['category']);
	$price = $_POST['price'];
	$quantity = intval($_POST['quantity']);
	$proimage = $_FILES["proimage"];

	$errflag = false;
	// Check to see if the type of file uploaded is a valid image type
	function valid($ptype)
	{
		// This is an array that holds all the valid image MIME types
		$valid_types = array("image/jpg", "image/jpeg", "image/png", "image/gif");
		
		//echo $file['type'];
		if (in_array($ptype, $valid_types))
			return 1;
		else
			return 0;
	}

	if($proname == '') {
		$errmsg_arr[] = 'Product name missing';
		$errflag = true;
	}
	if($category == '') {
		$errmsg_arr[] = 'Category missing';
		$errflag = true;
	}
	if($price == '') {
		$errmsg_arr[] = 'Price missing';
		$errflag = true;
	}
	if($quantity == '') {
		$errmsg_arr[] = 'Quantity missing';
		$errflag = true;
	}
	if($proimage["tmp_name"] == '') {
		$errmsg_arr[] = 'Please upload an image';
		$errflag = true;
	}

	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}

	if (!valid($proimage['type']))
	{
		$_SESSION['ERRMSG_ARR'] = array('You must upload a JPEG, JPG or PNG.');
		header("Location: index.php");
		exit();
	}

	// Build our target path full string.  This is where the file will be moved do
	// i.e.  images/picture.jpg
	$TARGET_PATH = __DIR__.'/../'."img/uploads/";
	$TARGET_PATH = $TARGET_PATH . basename( $proimage['name']);

	// Lets attempt to move the file from its temporary directory to its new home
	if(move_uploaded_file($proimage['tmp_name'], $TARGET_PATH))
	{
		//Create INSERT query
		$qry = "INSERT INTO `tbl_product` ( `cat_id`, `pd_name`, `pd_description`, `pd_price`, `pd_qty`, `pd_image`)
				VALUES($category, '$proname', '$prodesc', $price, $quantity, '".$proimage["name"]."')";
		$result = @mysql_query($qry);
		//Check whether the query was successful or not
		if($result) {
			$_SESSION['MSGS'] = array('<strong>Wola!</strong> Changes were successful.');
			session_write_close();
			header("location: index.php");
			exit();
		} else {
			die("Query failed: ".mysql_error());
		}
	}
	else
	{
		// A common cause of file moving failures is because of bad permissions on the directory attempting to be written to
		// Make sure you chmod the directory to be writeable
		print_r($TARGET_PATH);
		$_SESSION['ERRMSG_ARR'] = array('Could not upload file.  Check read/write persmissions on the directory');
		header("Location: index.php");
		exit();
	}
}
//handle delete request
if(is_array($_GET) && count($_GET) > 0 && isset($_GET['delete'])) {
	$pd_id = $_GET['delete'];

	$qry = "DELETE FROM `tbl_product`
			WHERE pd_id=".$pd_id;
	$result = @mysql_query($qry);
	//Check whether the query was successful or not
	if($result) {
		$_SESSION['MSGS'] = array('<strong>Wola!</strong> Changes were successful.');
		session_write_close();
		header("location: index.php");
		exit();
	}else {
		$_SESSION['ERRMSG_ARR'] = array('<strong>Oh no!</strong> Changes didn\'t happen, make sure your database is up.');
		session_write_close();
		header("location: index.php");
		exit();
	}
}
?>