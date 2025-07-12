<?php
function insert_task($conn, $data){
	$sql = "INSERT INTO tasks (title, description, assigned_to, due_date) VALUES(?,?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}

function get_all_tasks($conn){
	$sql = "SELECT * FROM tasks ORDER BY assigned_to DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll();
	}else {
	$tasks = 0;

	}
	return $tasks;
}

function get_all_tasks_due_today($conn){
	$sql = "SELECT * FROM tasks WHERE due_date = CURDATE() ORDER BY assigned_to DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll();
	}else {
	$tasks = 0;

	}
	return $tasks;
}
function count_tasks_due_today($conn){
	$sql = "SELECT id FROM tasks WHERE due_date = CURDATE()";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}

function get_all_tasks_overdue($conn){
	$sql = "SELECT * FROM tasks WHERE due_date < CURDATE() ORDER BY assigned_to DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll();
	}else {
	$tasks = 0;

	}
	return $tasks;
}
function count_tasks_overdue($conn){
	$sql = "SELECT id FROM tasks WHERE due_date < CURDATE()";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}

function get_all_tasks_noDeadline($conn){
	$sql = "SELECT * FROM tasks WHERE due_date < due_date IS NULL OR due_date = '0000-00-00' ORDER BY assigned_to DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll();
	}else {
	$tasks = 0;

	}
	return $tasks;
}
function count_tasks_noDeadline($conn){
	$sql = "SELECT id FROM tasks WHERE due_date IS NULL OR due_date = '0000-00-00'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}
function delete_task($conn, $data){
	$sql = "DELETE FROM tasks WHERE id=? ";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}

function get_task_by_id($conn, $id){
	$sql = "SELECT * FROM tasks WHERE id = ? ";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	if($stmt->rowCount() > 0){
		$task = $stmt->fetch();
	}else {
	$task = 0;

	}
	return $task;
}

function count_tasks($conn){
	$sql = "SELECT id FROM tasks";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}

function update_task($conn, $data){
	$sql = "UPDATE tasks SET title=? , description=? , assigned_to=? , due_date =?  WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}
function get_all_tasks_by_id($conn, $id){
	$sql = "SELECT * FROM tasks WHERE assigned_to=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	if($stmt->rowCount() > 0){
		$tasks = $stmt->fetchAll();
	}else {
	$tasks = 0;

	}
	return $tasks;
}
function update_task_status($conn, $data){
	$sql = "UPDATE tasks SET status=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}

?>