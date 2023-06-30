<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1 id="h1">NIXOR SOFTWARES <br>Hello, <?php echo $user_data['user_name'];?><a  href="logout.php"> Log out</a></h1>
    
    
    <div class="container">
        <div class="todo-app">
            <h2>To-Do List <img src="../images/icon.png" alt=""> </h2>
            <div class="row">
                <input type="text" id="inputbox" placeholder="Add notes">
                <button onclick="addTask()">Add</button>
            </div>
            <ul id="list-container">
            <!--
                <li class="checked">Task 1</li>
                <li>Task 2</li>
                <li>Task 3</li>
            -->   
            </ul>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>