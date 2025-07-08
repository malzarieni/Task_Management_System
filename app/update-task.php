<?php
session_start(); 
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description'])  && isset($_POST['assigned_to']) && isset($_SESSION['role']) == 'admin') {
	include "../DB_connection.php";
	function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$title = validate_input($_POST['title']);
	$description = validate_input($_POST['description']);
	$assigned_to = validate_input($_POST['assigned_to']);
	$id = validate_input($_POST['id']);

	if (empty($title)) {
		$em = "Title is required";
		header("Location: ../edit-task.php?error=$em&id=$id");
		exit();
	}
	else if (empty($description)) {
		$em = "Description is required";
		header("Location: ../edit-task.php?error=$em&id=$id");
		exit();
	}
	else if (empty($assigned_to)) {
		$em = "Employee is required";
		header("Location: ../edit-task.php?error=$em&id=$id");
		exit();
	}else{
		include "Model/Task.php";
		$data = array($title,$description,$assigned_to, $id);
		update_task($conn, $data);

		$em = "Task Updated Succesfully";
		header("Location: ../edit-task.php?success=$em&id=$id");
		exit();

	}



} else {
	$em = "unkown error occured";
	header("Location: ../edit-task.php?error=$em");
	exit();
}
}else{
	$em = "First login";
	header("Location: ../login.php?error=$em");
	exit();
} ?>
