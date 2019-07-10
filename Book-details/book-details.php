<?php
    session_start();

    $c_username = $_SESSION['login_user'];
    $w_error = "";
    
    if(isset($_POST['go'])){
        $_SESSION['heading'] = $_POST['txtHeading'];
        $_SESSION['description'] = $_POST['txtDescription'];
        $_SESSION['type'] = $_POST['cmbBookType'];
        $_SESSION['image'] = $_FILES['image']['name'];
        $_SESSION['t_image'] = $_FILES['image']['tmp_name'];
        $_SESSION['file'] = "Resources/".basename($_SESSION['image']);

        if(empty($_SESSION['heading']) || empty($_SESSION['description']) || empty($_SESSION['type'])){
            $w_error = "Please fill required";
        }
        else{
            header("refresh:1; url=../Clipboard/clipboard.php");
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="book-details.css">
    <script src="book-details.js"></script>
    <title>BOOKWORM</title>
</head>
<body>
    <header>
        <a href="#"><img src="..\Resources\logo.png" alt="logo" id="img"></a>
        <!-- <nav id="navbar">
            <a href="">Home</a>
            <a href="">Contacts</a>
            <a href="">About us</a>
        </nav> -->
    </header>
    <main>
        <div id="jon">
            <h2>Begin Journal </h2>
        </div>
        <div class="quote">
            "If you really want to<br>
            know yourself , start by <br>
            writing a book."<br><br>
            -Shareen El Feki-
        </div>

        <!-- this division element below consists of labels to guide what requiremnts should
        be entered in the input elements , a buton to receive a image and another button to preceed to 
        next page -->
       <div class="Enter-data">
            <div >
                <form method="POST" action="" id="book-detForm" enctype="multipart/form-data"> 
                    <!-- this form Collects basic book details from the writer-->
                    <input type="hidden" name="bookID" id="book_id">
                    <input type="hidden" name="author" id="author_id">
                    <label for='title' >Title : </label>
                    <input type="text" name="txtHeading" placeholder="Untitled Book" id="book_name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Untitled Book'" required>

                    
                    <label for="description">Description : </label>
                    <textarea name="txtDescription" id="Description" placeholder="Describe the book in few words...." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Untitled Book'"cols="36" rows="4" required></textarea>
                    
                        <!--below div is used to combine two sub-divs to avoid line break between select and input image-->
                    <div class="info-input">
                        <div>
                            <label for="pick">Pick : </label>
                            <select name="cmbBookType" id="type" required>
                            <option value="Select...">Select...</option>
                            <option value="Story">Story</option>
                            <option value="Pouch">Pouch</option>
                            <option value="Article">Article</option>
                            </select>
                        </div>

                        <div class="upload-cover">
                            <!--below elements are used to get a cover image from the user-->
                            <label for="add imge">Add cover image</label>
                            <input type="file" accept="image/*" name="image" id="add-img" value="add-img" size="600px">
                            
                        </div> 
                    </div> 
                    <!--Button below is placed to visit to book writing page-->
                    <div id="submit">
                        <input type="submit" value="Go to Writepad" name="go">
                    </div>
                </form>
            </div>
        </div> 
    </main>

    <footer></footer>
</body>
</html>