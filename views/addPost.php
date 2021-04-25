<?php

    require_once '../controller/postsC.php';
    require_once '../model/posts.php';

    $postC= new PostsC();

    if (isset($_POST['title']) && isset($_POST['text'])){


        $image=$_FILES['picture']['name'];
        $ext=pathinfo($image,PATHINFO_EXTENSION);
        $newname=rand().time().'.'.$ext;

        move_uploaded_file($_FILES['picture']['tmp_name'],'../assets/img/'.$newname);


        
        $post = new Posts($_POST['title'],$_POST['text'],$newname);

        $postC->addPost($post);

    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/mainstyle.css">
    <title>Casart - Add Post</title>
</head>

<body>
    <header><?php include 'header.php'?></header>


    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div class="txt_field">
            <input type="text" name="title" required>
            <span></span>
            <label>Title</label>
        </div>
        <textarea name="post_txt" placeholder="Publication ..."></textarea>
        <br>
        <div class="img_insert">
        <label>Image: </label>
            <input type="file" name="picture" accept="*/image">
            <span></span>
            
        </div>
        <br>
        <input type="submit" class="submit" value="Publier">
    </form>

    <footer><?php include 'footer.php'?></footer>

</body>

</html>