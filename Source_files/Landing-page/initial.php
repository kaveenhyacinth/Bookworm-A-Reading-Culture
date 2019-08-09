<?php

    session_start();

    $log_error = "";

    if(isset($_POST['signin'])){
        
        $log_conn = mysqli_connect('localhost', 'root', '', 'db_bookworm');

        if(!$log_conn){
            $log_error = "Connection failed!";
        }
    
        $log_username = $_POST['uname'];
        $log_password = $_POST['password'];

        if(empty($log_username) || empty($log_password)){
            $log_error = "Please fill required";
        }
        else{
        
            $log_query = "SELECT username FROM tbl_user WHERE username='".$log_username."' AND passwrd='".$log_password."' LIMIT 1";
          
            $log_result = mysqli_query($log_conn, $log_query);
    
            if($log_result->num_rows > 0){
                $log_row = $log_result->fetch_assoc();
                $_SESSION['login_user'] = $log_row['username'];
                header("refresh:0.1; ../My-list/mylist-select.php");
            }
            else{
                $log_error = "Username or Password Invalid!";
            }
        }
    }

    
    if(isset($_POST['signup'])){

        $conn = mysqli_connect('localhost', 'root', '', 'db_bookworm');

        if(!$conn){
            $log_error = "Connection failed!";
        }

        $first = $_POST['fname'];
        $last = $_POST['lname'];
        $email = $_POST['emailu'];
        $username = $_POST['uname'];
        $password = $_POST['password'];
    
        $log_invalid = empty($first) || empty($last) || empty($email) || empty($username) || empty($password);

        if($log_invalid){
            $log_error = "Please fill required";
        }
        else if(!$log_invalid){
            $get_sql = "SELECT * FROM tbl_user WHERE username='$username' OR email='$email'";
            $get_result = mysqli_query($conn, $get_sql);

            if($get_result->num_rows>0){
                $log_error = "You already have an account!";
            }
            else{
                $sql = "INSERT INTO tbl_user (f_name, l_name, username, email, passwrd) VALUES ('$first', '$last', '$username', '$email', '$password')";
                $result = mysqli_query($conn, $sql);
            
                if($result){
                    $_SESSION['login_user'] = $username;
                    header("refresh:0.1; url=../Home-page/home.php");
                }
                else{
                    $log_error = "Ooopz!Something Went Wrong...";  
                } 
            }
        
            
        }
    }

?>