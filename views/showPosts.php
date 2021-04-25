<?php

require_once '../controller/postsC.php';

$postC = new PostsC();

if (isset($_POST['search'])) {
    $posts = $postC->searchByTitle($_POST['search']);
} else {
    $posts = $postC->showPosts();
}

if (isset($_GET['id'])) {
    $postC->deletePost($_GET['id']);
    $posts = $postC->showPosts();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/mainstyle.css" />
    <title>Casart - Show Posts</title>
</head>

<body>
    <header><?php include 'header.php' ?></header>
    <main>
        <br>
        <br>
        <form action="" method="POST" autocomplete="off">
            <div class="txt_field">
                <input type="text" name="search">
                <span></span>
                <label>Rechercher</label>
            </div>
            <input type="submit" class="submit" value="Rechercher">
        </form>

        <br>
        <br>
        <div class="post-cards">
            <?php
            foreach ($posts as $post) {
            ?>
                <div class="post">
                    <div class="post-img">
                        <img src=<?php
                                    if ($post['img'] != '') {
                                        echo "../assets/img/" . $post['img'];
                                    } else {
                                        echo "../assets/img/casart_logo.png";
                                    }
                                    ?>>
                        <div class="post-img-overlay"></div>
                    </div>
                    <div class="post-info">
                        <div class="post-date">
                            <span><?= date('l', strtotime($post['date'])) ?></span>
                            <span><?= date('F', strtotime($post['date'])) . " " . date('t', strtotime($post['date'])) . " " . date('Y', strtotime($post['date'])) ?></span>


                        </div>
                        <a class="title-link" href=<?php echo "showMore.php?id=" . $post['id']; ?>>
                            <h1 class="post-title">
                                <?php if (strlen($post['title']) > 40) {
                                    echo substr($post['title'], 0, 40) . "...";
                                } else {
                                    echo $post['title'];
                                    
                                } ?></h1>
                        </a>

                        <p class="post-text">
                            <?php echo substr($post['text'], 0, 300) . "..." ?>
                        </p>
                        <a type="button" href=<?php echo "updatePost.php?id=" . $post['id']; ?> class="post-cta">Modifier</a>
                        <a type="button" href=<?php echo "showPosts.php?id=" . $post['id']; ?> class="post-cta">Supprimer</a>
                        <div class="post-nbComments" style="padding-top:20px;"><strong><?php echo "Commentaires: " . $post['comments_nb'] ?></strong></div>
                    </div>

                </div>
                <br>
            <?php
            }
            ?>
        </div>

    </main>
    <footer><?php include 'footer.php' ?></footer>



</body>

</html>