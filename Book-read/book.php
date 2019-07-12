<!DOCTYPE html>
<html lang="en" id="bd">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookWorm</title>
    <link rel="stylesheet" href="book.css">
    <script src="book.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:700|Barriecito|Nunito&display=swap" rel="stylesheet">   
</head>
<body>
    <header>
        <div class="topnav">
            <img src="..\Resources\logo.png" alt="Logo" class="logo">
            <nav id="navbar">
                <a href="..\Book-select\book-select.php">Home</a>
                <a href="..\My-list\mylist-select.php">my library</a>
                <a href="..\My-publications\my-pub.php">My Publications</a>
            </nav>
            <button class="fontSize" id="sInc" onclick='sizeInc()'>A+</button>
            <button class="fontSize" id="sdec" onclick='sizeDec()'>A-</button>
            <button id="btnDark" onclick='darkMode()'>Go Dark</button>
        </div>
    </header>
    <main id="main">
        <?php
            session_start();

            if(isset($_POST['drop'])){
                $id = $_POST['bookId'];
                $username = $_SESSION['login_user'];
                $dbHost = "localhost";
                $dbuser = "root";
                $dbPassword = "";
                $dbName = "db_bookworm";
    
                $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
                if($conn->connect_error){
                    die("Connection Failed" . $conn->connect_error);
                }
    
                $insert = "DELETE FROM tbl_mylist WHERE book_id = $id AND username='$username'";
                $i_result = mysqli_query($conn, $insert);

                if($i_result){
                    header("refresh:0.1; url=../My-list/mylist-select.php");
                }
                else{
                    header("refresh:0.1; url=../My-list/mylist-select.php");
                }
            }

            if(isset($_POST['add'])){
                $id = $_POST['bookId'];
                $username = $_SESSION['login_user'];
                $dbHost = "localhost";
                $dbuser = "root";
                $dbPassword = "";
                $dbName = "db_bookworm";
    
                $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
                if($conn->connect_error){
                    die("Connection Failed" . $conn->connect_error);
                }
    
                $insert = "INSERT INTO tbl_mylist (username, book_id) VALUES ('$username', $id)";
                $i_result = mysqli_query($conn, $insert);

                if($i_result){
                    header("refresh:0.1; url=../Book-select/book-select.php");
                }
            }

            if(isset($_POST['read'])){

                $id = $_POST['bookId'];
    
                $dbHost = "localhost";
                $dbuser = "root";
                $dbPassword = "";
                $dbName = "db_bookworm";
    
                $conn = mysqli_connect($dbHost, $dbuser, $dbPassword, $dbName);
                if($conn->connect_error){
                    die("Connection Failed" . $conn->connect_error);
                }
    
                $sql = "SELECT book_name, author_name, book_name, book_content FROM tbl_archive WHERE book_id='".$id."'";
                $result = $conn->query($sql);
    
                if($result->num_rows > 0){
                    while($data = $result->fetch_assoc()){
                        echo 
                        "<h1 id='title'>".$data['book_name']."</h1>
                        <h3 id='author'>by ".$data['author_name']."</h3>
                        <br>
                        <div id='para'>".$data['book_content']."</div>";
                    }
                }
            }
        ?>
        
    </main>
</body>
</html> 