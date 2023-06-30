<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //SOMETHING WAS POSTED

    $user_name = $_POST['user_name'];
    $password =  $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

        //save to database
        $user_id = random_num(20);

        $query = "insert into users(user_id, user_name, password) values('$user_id', '$user_name', '$password')";

        mysqli_query($con, $query);

        header("Location: login.php");
        die;

    }else{
        echo "please enter some valid information! ";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="body">
    

    <section class="text-box">
    <div id="box" class="header" >
        <form method="POST">
            <div style="font-size: 20px; margin: 10px;color:white;">Signup</div>
            <input id="text" type="text" name="user_name" placeholder="username"><br><br>
            <input id="text" type="password" name="password" placeholder="password"><br><br>

            <input id="button" type="submit" value="Signup"><br><br>
            <a id="ac" href="login.php" > <i>already have an account?</i> Login</a><br><br>
        </form>
    </div>

    </section>

    
    
</body>
</html>