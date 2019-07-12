<?php
    session_start();

    $dbHost = "localhost";
    $dbuser = "root";
    $dbPassword = "";
    $dbName = "db_bookworm";
    $user = $_SESSION['login_user'];

    $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
    if($conn->connect_error){
        die("Connection Failed" . $conn->connect_error);
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
    <title>My Library</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
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
            <nav id="navbar">
                <form action="" method="post">
                    <input type="submit" value="Logout" name="logout" id="logout">
                </form>
            </nav>  
        </section>
        <span id="cat">My Library</span><br><span id="cat1">Let's nurture your bookworm...</span><hr>
        <section id="grid">
            <?php
                $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
                if($conn->connect_error){
                    die("Connection Failed" . $conn->connect_error);
                }

                $user = $_SESSION['login_user'];

                $m_sql = "SELECT tbl_archive.book_id, tbl_archive.book_name, tbl_archive.author_name, tbl_archive.book_description, tbl_archive.book_img FROM tbl_mylist INNER JOIN tbl_archive ON tbl_mylist.book_id = tbl_archive.book_id WHERE username='$user'";
                $m_result = mysqli_query($conn, $m_sql);

                if($m_result->num_rows > 0){
                    while($m_data = $m_result->fetch_assoc()){
                        echo 
                        "<section class='container'>
                            <img src='data:image/jpeg; base64,".base64_encode($m_data['book_img'])."' class='card'></img>
                            <h2>" . $m_data["book_name"] . "</h2>
                            <h4>by " . $m_data["author_name"] . "</h4>
                            <p>" . $m_data["book_description"] . "</p>
                            <form action='../Book-read/book.php' method='post'>
                                <input class='txt' type='text' name='bookId' value='" . $m_data['book_id'] . "'>
                                <div class='btn'>
                                    <input class='button' type='submit' value='Read' name='read'>
                                    <input class='button' type='submit' value='Drop' name='drop'>
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

 <!-- <section class="container">
                <div class="card"></div> 
                <h2>BOOK NAME</h2>
                <p>Book Description</p>
                <div class="btn">
                <button class="button">READ BOOK!</button>
                </div>   
            </section>
            <section class="container">
                <div class="card"></div> 
                <h2>BOOK NAME</h2>
                <p>Book Description</p>
                <div class="btn">
                <button class="button">READ BOOK!</button>
                </div>   
            </section>
        </section> -->