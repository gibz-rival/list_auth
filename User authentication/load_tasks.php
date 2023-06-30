<?php
include("connection.php");
include("functions.php");

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Handle the case where the user is not logged in
    // Redirect the user to the login page or display an error message
    exit("User not logged in.");
}

// Retrieve the user ID from the session
$userID = $_SESSION['user_id'];

// Retrieve tasks for the user from the database
$sql = "SELECT task_name, is_completed FROM tasks WHERE user_id = $userID";
$result = $con->query($sql);

$tasksData = array();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $tasksData[] = $row;
    }
} else {
    // Handle the case where there is an error with the database query
    exit("Failed to retrieve tasks from the database.");
}

// Close the database connection
$con->close();

// Return tasks data as JSON response
echo json_encode($tasksData);
?>
