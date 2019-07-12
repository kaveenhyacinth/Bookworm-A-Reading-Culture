<?php
  session_start();

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
    <title>Read / Write</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
  <div class="container">
    
    <header class="topnav" id="topnav">           
      <img src="..\Resources\logo.png" alt="Logo" class="logo">
      <nav id="navbar">
          <a href="..\Book-select\book-select.php">Home</a>
          <a href="..\My-list\mylist-select.php">my library</a>
          <a href="..\My-publications\my-pub.php">My Publications</a>
          <form action="" method="post">
            <input type="submit" value="Logout" name="logout" id="logout">
          </form>
      </nav>  
    </header>
      <div class="split left" >
        <a href="..\Book-details\book-details.php"> 
          <div class="box">
            <h1> BECOME <br> A  <br> WRITER </h1>
          </div>
        </a>
      </div>

      <div class="split right" >
        <a href="..\Book-select\book-select.php"> 
          <div class="box">
            <h1> BECOME <br> A  <br> READER </h1>
          </div>            
        </a>
      </div>
  </div>

  <script src="home.js"></script>
</body>
</html>



