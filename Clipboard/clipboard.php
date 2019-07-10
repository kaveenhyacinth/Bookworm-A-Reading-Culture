<?php
    session_start();
    $_SESSION['c_error'] = "";

    if(isset($_POST['publish'])){
        
        $c_conn = mysqli_connect('localhost', 'root', '', 'db_bookworm');
        
        if(!$c_conn){
            $_SESSION['c_error'] = "Connection failed!";
        }
        
        $_SESSION['content'] = $_POST['story'];

        $target = $_SESSION['file'];
        $c_img = $_SESSION['image'];

        $c_username = $_SESSION['login_user'];
        $c_heading = $_SESSION['heading'];
        $c_description = $_SESSION['description'];
        $c_type = $_SESSION['type'];
        $c_content = $_SESSION['content'];

        if(empty($c_content)){
            $_SESSION['c_error'] = "Don't leave this blank...";
        }
        else{
            $c_query = "INSERT INTO tbl_archive (book_name, book_img, book_type, book_description, book_content, author_name) VALUES ('$c_heading', '$c_img', '$c_type', '$c_description', '$c_content', '$c_username')";
            $c_result = mysqli_query($c_conn, $c_query);

            if(move_uploaded_file($_SESSION['t_image'], $target)){
                $_SESSION['c_error'] = "Your publication has been added to the queue";
            }
            else{
                $_SESSION['c_error'] = "You didn't add a cover image but your publication has been added to the queue";
            }
    
            if($c_result){
                header("refresh:3; url=../Home-page/home.php");
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
    <title>BOOKWORM</title>
    <link rel="stylesheet" href="clipboard.css">
</head>
<body>
    <header>
        
    </header>

    <main>
        <section id="write-book">
        <div class="h2tags">
        <p id="title"><?php echo $_SESSION['heading']."<br><span id=author>by ".$_SESSION['login_user']."</span><br>"; ?></p>
        </div>
        <P id=error><b><?php echo $_SESSION['c_error']; ?></b></P>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="story">
                <textarea name='story' id="story" cols="120" rows="40" placeholder="Write your story here....." required></textarea>
            </div>
            <div class="buttons"> 
                <input type="submit" id="publish" name="publish" value="Publish">
                <!-- <a href="preview.php"><button type="submit" id="publish">Pu</button></a> -->
            </div>
            
        </form>
    </section>
    </main>

    <footer></footer>
</body>
</html>