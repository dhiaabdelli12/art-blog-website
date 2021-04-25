<?php

require_once '../controller/postsC.php';
require_once '../model/posts.php';

$postC = new postsC();


$post = $postC->getPostbyId($_GET['id']);
$id=$_GET['id'];


if (isset($_POST['title']) && isset($_POST['text'])) {


    $image = $_FILES['picture']['name'];
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $newname = rand() . time() . '.' . $ext;

    move_uploaded_file($_FILES['picture']['tmp_name'], '../assets/img/' . $newname);

    $post = new Posts($_POST['title'], $_POST['text'], $newname);
    $postC->updatePost($post, $id);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/mainstyle.css">
    <title>Document</title>
</head>

<body>
    <header><?php include 'header.php' ?></header>


    <form action=""method="POST" autocomplete="off" enctype="multipart/form-data">
        <div class="txt_field">
            <input type="text" name="title" value=<?php if ($_GET['id']){echo $post['title'];} ?> required>
            <span></span>
            <label>Title</label>
        </div>
        <textarea  ><?php if ($_GET['id']){echo $post['text'];} ?></textarea>
        <br>
        <div class="img_insert">
            <label>Image: </label>
            <input type="file" name="picture" value=<?php if ($_GET['id']){echo $post['img'];} ?>accept="*/image">
            <span></span>

        </div>
        <br>
        <input type="submit" href=<?php echo "updatePost.php?id=" . $_GET['id']; ?> value="Modifier">
    </form>


    <footer><?php include 'footer.php' ?></footer>
</body>

</html>