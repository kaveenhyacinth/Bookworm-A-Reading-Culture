<?php
    session_start();

    $dbHost = "localhost";
    $dbuser = "root";
    $dbPassword = "";
    $dbName = "db_bookworm";

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
            <hr><a href="">Category</a><hr>
            <a href="#cat1">Story</a>
            <a href="#cat2">Article</a>
            <a href="#cat3">Pouch</a>
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
        <span id="cat1">BookWorms</span><br><span id="cat4">Unleash your inner bookworm...</span><hr>
        <section id="grid">
            <?php
                $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
                if($conn->connect_error){
                    die("Connection Failed" . $conn->connect_error);
                }
                $story_sql = "SELECT book_id, book_name, author_name, book_description, book_img FROM tbl_archive WHERE book_type='Story'";
                $story_result = mysqli_query($conn, $story_sql);

                if($story_result->num_rows > 0){
                    while($story_data = $story_result->fetch_assoc()){
                        echo 
                        "<section class='container'>
                            <img src='data:image/jpeg; base64,".base64_encode($story_data['book_img'])."' class='card'></img>
                            <h2>" . $story_data["book_name"] . "</h2>
                            <h4>by " . $story_data["author_name"] . "</h4>
                            <p>" . $story_data["book_description"] . "</p>
                            <form action='../Book-read/book.php' method='post'>
                                <input class='txt' type='text' name='bookId' value='" . $story_data['book_id'] . "'>
                                <div class='btn'>
                                    <input class='button' type='submit' value='Read' name='read'>
                                    <input class='button' type='submit' value='Add to Library' name='add'>
                                </div>
                            </form>
                        </section>";
                    }
                } 
                $conn->close();
            ?> 
        </section>
        <br><br><br>
        <span id="cat2">Articles</span><br><span id="cat5">To read on the go...</span><hr>
        <section id="grid">
            <?php
                $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
                if($conn->connect_error){
                    die("Connection Failed" . $conn->connect_error);
                }
                $pouch_sql = "SELECT book_id, book_name, author_name, book_description, book_img FROM tbl_archive WHERE book_type='Article'";
                $article_result = mysqli_query($conn, $pouch_sql);
                
                if($article_result->num_rows > 0){
                    while($article_data = $article_result->fetch_assoc()){
                        echo 
                        "<section class='container'>
                            <img src='data:image/jpeg; base64,".base64_encode($article_data['book_img'])."' class='card'></img>
                            <h2>" . $article_data["book_name"] . "</h2>
                            <h4>by " . $article_data["author_name"] . "</h4>
                            <p>" . $article_data["book_description"] . "</p>
                            <form action='../Book-read/book.php' method='post'>
                                <input class='txt' type='text' name='bookId' value='" . $article_data['book_id'] . "'>
                                <div class='btn'>
                                    <input class='button' type='submit' value='Read' name='read'>
                                    <input class='button' type='submit' value='Add to Library' name='add'>
                                </div>
                            </form>
                        </section>";
                    }
                } 
                $conn->close();
            ?> 
        </section>
        <br><br><br>
        <span id="cat3">Pouch</span><br><span id="cat6">Learn it, try it, master it...</span><hr>
        <section id="grid">
            <?php
                $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
                if($conn->connect_error){
                    die("Connection Failed" . $conn->connect_error);
                }
                $pouch_sql = "SELECT book_id, book_name, author_name, book_description, book_img FROM tbl_archive WHERE book_type='Pouch'";
                $pouch_result = mysqli_query($conn, $pouch_sql);
                
                if($pouch_result->num_rows > 0){
                    while($pouch_data = $pouch_result->fetch_assoc()){
                        echo 
                        "<section class='container'>
                            <img src='data:image/jpeg; base64,".base64_encode($pouch_data['book_img'])."' class='card'></img>
                            <h2>" . $pouch_data["book_name"] . "</h2>
                            <h4>by " . $pouch_data["author_name"] . "</h4>
                            <p>" . $pouch_data["book_description"] . "</p>
                            <form action='../Book-read/book.php' method='post'>
                                <input class='txt' type='text' name='bookId' value='" . $pouch_data['book_id'] . "'>
                                <div class='btn'>
                                    <input class='button' type='submit' value='Read' name='read'>
                                    <input class='button' type='submit' value='Add to Library' name='add'>
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