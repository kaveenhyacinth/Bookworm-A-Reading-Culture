<?php
    session_start();

    $dbHost = "localhost";
    $dbuser = "root";
    $dbPassword = "";
    $dbName = "db_bookworm";
    $us = $_SESSION['login_user'];
            
    $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
    if($conn->connect_error){
        die("Connection Failed" . $conn->connect_error);
    }

    $user_sql = "SELECT f_name, l_name, gender FROM tbl_user WHERE username='$us'";
    $user_result = mysqli_query($conn, $user_sql);

    if($user_result->num_rows > 0){
        while($user_data = $user_result->fetch_assoc()){
            $_SESSION['fname'] = $user_data["f_name"];
            $_SESSION['lname'] = $user_data["l_name"];
            $_SESSION['gender'] = $user_data["gender"];
        }
    } 

    if(isset($_POST['logout'])){
        session_destroy();

        header("refresh:0.2; url=../Landing-page/Index.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="..\Book-select\stylesheet.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script type="text/javascript">
        $(window).on('scroll', function(){
            if($(window).scrollTop()){
                $('.topnav').addClass('black');
            }
            else
            {
                $('.topnav').removeClass('black');
            }
        })
    </script>    
    
    <script>
        function openNav() {
            document.getElementById("Sidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.getElementById("topnav").style.paddingLeft = "260px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }
        function closeNav() {
            document.getElementById("Sidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.getElementById("topnav").style.paddingLeft = "30px";
            document.body.style.backgroundColor = "white";
        }
    </script>
</head>

<body>
    <div id="sidebar" onclick="togglemenu()">
        <div id="Sidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="..\Book-select\book-select.php">Home</a>
            <a href="..\Home-page\home.php">Read / Write</a>
            <a href="..\My-list\mylist-select.php">My Library</a>
            <a href="..\My-publications\my-pub.php">My Publications</a>
        </div>
    </div>
    <section id="main">
        <section class="topnav" id="topnav">
            <span style="cursor: pointer; color:white" onclick="openNav()">&#9776;</span>           
            <img src="..\Resources\logo.png" alt="Logo" class="logo">
            <form id="search" action="..\Search\search.php" method="post">
                <input type="text" placeholder="What's Up?" name="searchtxt" id="search">
                <input type="submit" value="Search" name="search" id="sr">
            </form>
            <nav id="navbar">
                <?php
                    if($_SESSION['gender'] == "Male"){
                        echo "<img src='..\Resources\mprof.png' alt='Logo' class='prof'>";
                    } 
                    else if($_SESSION['gender'] == "Female"){
                        echo "<img src='..\Resources\wprof.png' alt='Logo' class='prof'>";
                    }
                ?>
                <span id="user"><?php echo $_SESSION['fname']." ".$_SESSION['lname'] ?></span>
                <form action="" method="post">
                    <input type="submit" value="Logout" name="logout" id="logout">
                </form>
            </nav>  
        </section>
        <span id="cat1"><?php echo $_SESSION['fname']."'s "?> Publications</span><br><span id="cat4">Where the bookworms are being spread...</span><hr>
        <section id="grid">
            <?php
                $us = $_SESSION['login_user'];

                $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
                if($conn->connect_error){
                    die("Connection Failed" . $conn->connect_error);
                }
                
                $story_sql = "SELECT book_id, book_name, author_name, book_description, book_img FROM tbl_archive WHERE author_name='$us'";
                $story_result = mysqli_query($conn, $story_sql);

                if($story_result->num_rows > 0){
                    while($story_data = $story_result->fetch_assoc()){
                        echo 
                        "<section class='container'>
                            <img src='data:image/jpeg; base64,".base64_encode($story_data['book_img'])."' class='card'></img>
                            <h2>" . $story_data["book_name"] . "</h2>
                            <h4>by " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "</h4>
                            <p>" . $story_data["book_description"] . "</p>
                            <form action='../Book-read/book.php' method='post'>
                                <input class='txt' type='text' name='bookId' value='" . $story_data['book_id'] . "'>
                                <div class='btn'>
                                    <input class='button' type='submit' value='Read' name='read'>
                                    <input class='button' type='submit' value='Delete' name='delete'>
                                </div>
                            </form>
                        </section>";
                    }
                } 
                $conn->close();
            ?> 
        </section>  
</section> 
    
    
     
</body>
</html>
