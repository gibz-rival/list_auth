<?php
include("connection.php");
include("functions.php");

// Get the logged-in user's ID (you need to implement the user authentication logic)
$id = $_SESSION['user_id'];

// Retrieve task name from the frontend
$taskName = $_POST['task_name'];

// Update the task as completed for the user in the database
$sql = "UPDATE tasks SET is_completed = 1 WHERE user_id = $id AND task_name = '$taskName'";
$con->query($sql);

// Close the database connection
$con->close();
?>
