<?php

require_once '../controller/postsC.php';
require_once '../model/posts.php';
require_once '../model/comments.php';
require_once '../controller/commentsC.php';


$postC = new postsC();
$post = $postC->getPostbyId($_GET['id']);


$commentC = new CommentsC();

if (isset($_POST['comment_txt']) && isset($_POST['submit_comment'])) {
    $comment = new Comments($_POST['comment_txt'], $post['id']);
    $commentC->addComment($comment);
    $postC->updateNbComments($_GET['id'],$postC->getNbComments($_GET['id']));
}

$comments = $commentC->getCommentsbyPostId($post['id']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/mainstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <title>Show More</title>
</head>

<body>
    <header><?php include_once 'header.php' ?></header>

    <div class="post-more">
        <div class="title-more">
            <h1><?= $post['title'] ?></h1>
        </div>
        <div class="img-more"><img src=<?php echo "../assets/img/" . $post['img'] ?> width="800" height="auto"></img></div>
        <div class="text-more">
            <p><?= $post['text'] ?></p>
        </div>
    </div>

    <hr style="width:60%;margin:auto;margin-top: 10px; margin-bottom: 60px;">

    <div class="comment-box">
        <h2>Laisser Un Commentaire</h2>
        <form action="" method="POST">
            <textarea name="comment_txt" placeholder="Ajouter commentaire ..."></textarea>

            <input type="submit" class="commenter" name="submit_comment" value="Commenter">

        </form>
    </div>

    <div class="comment-section">

        <?php
        foreach ($comments as $comment) {
        ?>
            <div class="comment">

                <div class="comment-info">
                    <div class="comment-userId"><?= $comment['user_id'] ?></div>
                    <div class="comment-date">
                        <span><?= date('F', strtotime($comment['date'])) . " " . date('t', strtotime($comment['date'])) . " " . date('Y', strtotime($comment['date'])) ?></span>
                    </div>
                    <p class="comment-text"><?= $comment['text'] ?></p>
                </div>
                <div class="comment-cta">
                    <div class="comment-points"><?= $comment['points'] ?></div>
                    <a href="#" class="comment-like">J'aime</a>
                </div>
            </div>

        <?php } ?>

    </div>



    <footer><?php include_once 'footer.php' ?></footer>
</body>

</html>