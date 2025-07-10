<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	if (!isset($_GET['id'])) {
		header("Location: tasks.php");
		exit();
	}

	$id = $_GET['id'];
	$task = get_task_by_id($conn,$id);
	$users = get_all_users($conn);

	if ($task == 0) {
		header("Location: tasks.php");
		exit();
	}
  
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Task</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<h4 class="title">Edit Tasks <a href="my_task.php">Tasks</a></h4>
			<form class="form-1"
			      method="POST"
			      action="app/update-task-employee.php">
			      <?php if (isset($_GET['error'])) {?>
      	  	<div class="danger" role="alert">
			  <?php echo stripcslashes($_GET['error']); ?>
			</div>
      	  <?php } ?>

      	  <?php if (isset($_GET['success'])) {?>
      	  	<div class="success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
      	  <?php } ?>
				<div class="input-holder">
					<br>
					<p><b>Title: </b><?=$task['title']?></p>
					<br>
				</div>
				<div class="input-holder">
					<p><b>Description: </b><?=$task['description']?></p>
					<br>
				</div>
				<div class="input-holder">
					<label>Status</label>
					<select name="status" class="input-1">
						<option 
							<?php if($task['status'] == "pending") echo"selected"; ?>
							>Pending</option>
						<option
						<?php if($task['status'] == "in_progress") echo"selected"; ?>
						>In_Progress</option>
						<option
						<?php if($task['status'] == "completed") echo"selected"; ?>
						>Completed</option>
					</select><br>
				</div>
				<input type="text" name="id" value="<?=$task['id']?>" hidden>

				<button class="edit-btn">Update</button>
			</form>
			
		</section>
	</div>

<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(2)");
	active.classList.add("active");
</script>
</body>
</html>
<?php }else{ 
   $em = "First login";
   header("Location: login.php?error=$em");
   exit();
}

 ?>