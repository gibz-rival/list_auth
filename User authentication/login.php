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

        //read from database
        

        $query = "select * from users where user_name = '$user_name' limit 1";

        $result =  mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result)>0)
            {
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;


                }
            }
        }

        echo "wrong username or password! ";
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
    <title>LOGIN</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="body">
    
    <section class="text-box">
    <div id="box"  class="header">
        <form method="POST" id="log-form">
            <div style="font-size: 20px; margin: 10px;color:white;">Login</div>
            
            <input id="text" type="text" name="user_name" placeholder="username"><br><br>
            <input id="text" type="password" name="password" placeholder="password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>
            <a id="ac" href="signup.php"> <i>Don't have an account?</i> Signup</a><br><br>
        </form>
    </div>

    </section>

    
    
</body>
</html>