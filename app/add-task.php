<?php
session_start(); 
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['due_date']) && isset($_POST['assigned_to']) && isset($_SESSION['role']) == 'admin') {
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
	$due_date = validate_input($_POST['due_date']);

	if (empty($title)) {
		$em = "Title is required";
		header("Location: ../create_task.php?error=$em");
		exit();
	}
	else if (empty($description)) {
		$em = "Description is required";
		header("Location: ../create_task.php?error=$em");
		exit();
	}
	else if (empty($due_date)) {
		$em = "Due Date is required";
		header("Location: ../create_task.php?error=$em");
		exit();
	} else if (empty($assigned_to)) {
		$em = "Employee is required";
		header("Location: ../create_task.php?error=$em");
		exit();
	}else{
		include "Model/Task.php";
		include "Model/Notification.php";
		$data = array($title,$description,$assigned_to,$due_date);
		insert_task($conn, $data);
		$notif_data = array("'$title' has been assigned to you. Please review & start working on it.",$assigned_to,'New Task Asssigned');
		insert_notification($conn, $notif_data);

		$em = "Task Created Succesfully";
		header("Location: ../create_task.php?success=$em");
		exit();

	}



} else {
	$em = "unkown error occured";
	header("Location: ../create_task.php?error=$em");
	exit();
}
}else{
	$em = "First login";
	header("Location: ../create_task.php?error=$em");
	exit();
} ?>
