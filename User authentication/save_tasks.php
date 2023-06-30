<?php
include("connection.php");
include("functions.php");

// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle the unauthorized access as needed
    exit("Unauthorized access");
}

// Get the logged-in user's ID
$id = $_SESSION['user_id'];

// Retrieve task data from the frontend
$taskName = $_POST['task_name'];
$isCompleted = $_POST['is_completed'];

// Insert or update the task in the database
$sql = "INSERT INTO tasks (user_id, task_name, is_completed) VALUES ($id, '$taskName', $isCompleted)
    ON DUPLICATE KEY UPDATE is_completed = $isCompleted";
$con->query($sql);

// Close the database connection
$con->close();
?>


