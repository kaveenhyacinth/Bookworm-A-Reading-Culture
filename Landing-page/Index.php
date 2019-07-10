<?php
    include("initial.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Worm</title>
    <link href="https://fonts.googleapis.com/css?family=Arimo|Raleway&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="IndexStyleSheet.css">
    <link rel="stylesheet" type="text/css" href="LoginStyleSheet.css">
    <link rel="stylesheet" type="text/css" href="RegistrationStyleSheet.css">
    <script src="landing.js"></script>
</head>
<body>
    <!-- <div class="header">
        <a href="#"><img src="logo1.png" alt="logo"></a>
    </!-->
    <p id="error"><b><?php echo $log_error; ?></b></p>
    <div id="login">
        <div id="about">
            <h1>We are BookWorm</h1>
            <h3>Everything you’re into</h3>
            <p>Among the pages, so much to see, so much to do. Why are you still here? Let's get started!</p>
        </div>
        <div id="getstartbtn" onclick="signin()" type="button">
            <h2 class="start"><span>Get Started</span></h2>
        </div>
    </div>
    <div id="signin_container" >
        <form method="post" action="" class="usepass" enctype="multipart/form-data">
            <label><?php echo $log_error; ?></label><br>
            <label for="uname">Username</label>
            <br>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <br>

            <label for="password">Password</label>
            <br>
            <input type="password" placeholder="Enter Password" name="password" required>
            <br>
            <div class="btngrp">
                <input name="signin" type="submit" value="Login">
                <input name="l_cancel" type="reset" value="Cancel" onclick="l_reset()">
            </div>
        </form>
    </div>
    <div id="signup_container" >
        <form method="post" class="usepass" action="" enctype="multipart/form_data">
            <label><?php echo $reg_error; ?></label><br>
            <label for="uname">First Name</label>
            <br>
            <input type="text" placeholder="Enter Firstname" name="fname" required>
            <br>    

            <label for="uname">Last Name</label>
            <br>
            <input type="text" placeholder="Enter Lastname" name="lname" required>
            <br>

            <label for="uname">Username</label>
            <br>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <br>
        
            <label for="emailu">Email</label>
            <br>
            <input type="text" placeholder="Enter Email" name="emailu" required>
            <br>

            <label for="password">Password</label>
            <br>
            <input type="password" placeholder="Enter Password" name="password" required>
            <br><br>
            <div class="btngrp">
                <input type="submit" value="Register" name="signup">
                <input type="reset" value="Cancel" name="cancel" onclick="r_reset()">
            </div>
        </form>
    </div>  
</body>
</html>