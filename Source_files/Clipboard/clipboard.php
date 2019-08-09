<?php
    session_start();
    $_SESSION['c_error'] = "";

    $dbHost = "localhost";
    $dbuser = "root";
    $dbPassword = "";
    $dbName = "db_bookworm";
    $user = $_SESSION['login_user'];

    $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
    if($conn->connect_error){
        die("Connection Failed" . $conn->connect_error);
    }

    $user_sql = "SELECT f_name, l_name FROM tbl_user WHERE username='$user'";
    $user_result = mysqli_query($conn, $user_sql);

    if($user_result->num_rows > 0){
        while($user_data = $user_result->fetch_assoc()){
            $_SESSION['fname'] = $user_data["f_name"];
            $_SESSION['lname'] = $user_data["l_name"];
        }
    } 

    if(isset($_POST['logout'])){
        session_destroy();

        header("refresh:0.2; url=../Landing-page/Index.php");
    }

    if(isset($_POST['publish'])){
        
        $c_conn = mysqli_connect('localhost', 'root', '', 'db_bookworm');
        
        if(!$c_conn){
            $_SESSION['c_error'] = "Connection failed!";
        }
        
        $image = $_SESSION['file'];
        $_SESSION['content'] = $_POST['story'];
        $c_username = $_SESSION['login_user'];
        $c_heading = $_SESSION['heading'];
        $c_description = $_SESSION['description'];
        $c_type = $_SESSION['type'];
        $c_content = $_SESSION['content'];

        if(empty($c_content)){
            $_SESSION['c_error'] = "Don't leave this blank...";
        }
        else{
            $c_query = "INSERT INTO tbl_archive (book_name, book_img, book_type, book_description, book_content, author_name) VALUES ('$c_heading', '$image', '$c_type', '$c_description', '$c_content', '$c_username')";
            $c_result = mysqli_query($c_conn, $c_query);
    
            if($c_result){
                header("refresh:1; url=../My-publications/my-pub.php");
            }
            else{
                $_SESSION['c_error'] = "Something went wrong!";
            }
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Writepad</title>
    <link rel="stylesheet" href="clipboard.css">
</head>
<body>
    <header class="topnav" id="topnav">           
        <img src="..\Resources\logo.png" alt="Logo" class="logo">
        <nav id="navbar">
            <a href="..\Book-select\book-select.php">Home</a>
            <a href="..\My-list\mylist-select.php">my library</a>
            <a href="..\My-publications\my-pub.php">my publications</a>
            <form action="" method="post">
                <input type="submit" value="Logout" name="logout" id="logout">
            </form>
        </nav>  
    </header>
    <main>
        <section id="write-book">
            <div class="h2tags">
                <?php echo "<span id='title'>".$_SESSION['heading']."</span><span id=author>by ".$_SESSION['fname']." ".$_SESSION['lname']."</span><hr>"; ?>
            </div>
            <P id=error><b><?php echo $_SESSION['c_error']; ?></b></P>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="story">
                    <textarea name='story' id="story" cols="120" rows="16" placeholder="Write your story here....." required></textarea>
                </div>
                <div class="buttons"> 
                    <input type="submit" id="publish" name="publish" value="Publish">
                </div>     
            </form>
        </section>
    </main>

    <footer></footer>
</body>
</html>