<?php
session_start(); 
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

if (isset($_POST['user_name']) && isset($_POST['password'])  && isset($_POST['full_name']) && isset($_SESSION['role']) == 'admin') {
	include "../DB_connection.php";
	function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$user_name = validate_input($_POST['user_name']);
	$password = validate_input($_POST['password']);
	$full_name = validate_input($_POST['full_name']);

	if (empty($user_name)) {
		$em = "User Name is required";
		header("Location: ../add-user.php?error=$em");
		exit();
	}
	else if (empty($password)) {
		$em = "Password is required";
		header("Location: ../add-user.php?error=$em");
		exit();
	}
	else if (empty($full_name)) {
		$em = "Name is required";
		header("Location: ../add-user.php?error=$em");
		exit();
	}
	else{
		include "Model/User.php";
		$password = password_hash($password, PASSWORD_DEFAULT);
		$data = array($full_name,$user_name,$password,"employee");
		insert_user($conn, $data);

		$em = "User Created Succesfully";
		header("Location: ../add-user.php?success=$em");
		exit();

	}



} else {
	$em = "unkown error occured";
	header("Location: ../add-user.php?error=$em");
	exit();
}
}else{
	$em = "First login";
	header("Location: ../add-user.php?error=$em");
	exit();
} ?>
