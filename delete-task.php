<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "DB_connection.php";
	include "app/Model/Task.php";

	if (!isset($_GET['id'])) {
		header("Location: tasks.php");
		exit();
	}
	$id = $_GET['id'];

	$task = get_task_by_id($conn,$id);

	if ($task == 0) {
		header("Location: tasks.php");
		exit();
	}
  
	$data = array($id);
	delete_task($conn, $data);
	$em = "Deleted Successfully";
	header("Location: tasks.php?success=$em");
  exit();


 }else{ 
   $em = "First login";
   header("Location: login.php?error=$em");
   exit();
}
 ?>