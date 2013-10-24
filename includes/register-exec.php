<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once(__DIR__.'/../config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$username = clean($_POST['username']);
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	
	//Input Validations
	if($username == '') {
		$errmsg_arr[] = ' Username missing';
		$errflag = true;
	}
	if($email == '') {
		$errmsg_arr[] = 'Email missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	if( strlen($password) < 6 ) {
		$errmsg_arr[] = 'Password is too short.';
		$errflag = true;
	}
	if( strpos($email, "@") < 0 ) {
		$errmsg_arr[] = 'Enter a valid email ID';
		$errflag = true;
	}
	if( strpos($email, ".") < 0 ) {
		$errmsg_arr[] = 'Enter a valid email ID';
		$errflag = true;
	}

	//Check for duplicate login ID
	if($username != '') {
		$qry = "SELECT * FROM tbl_user WHERE user_name='$username'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Username already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../register.php");
		exit();
	}
	$is_admin = preg_match("/(.*)admin/", $username);
	//Create INSERT query
	$qry = "INSERT INTO tbl_user(user_name, password, user_email, created_at, updated_at, user_is_admin) 
			VALUES('$username','".md5($_POST['password'])."','$email','".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', $is_admin)";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		$_SESSION['MSGS'] = array('<b>Whoa you are awesome!</b> Registration Successful!');;
		session_write_close();
		header("location: ../index.php");
		exit();
	}else {
		die("Query failed: ".mysql_error());
	}
?>