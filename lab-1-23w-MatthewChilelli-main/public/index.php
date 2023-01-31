<?php
    require_once('../src/session.php');
    require_once('../src/data.php');



if ( $_POST ) {
    addPost($_POST['title'], $_POST['content'], 1);
    header('Location: /index.php');
    exit;
}

$results = getPosts();

?><!doctype html>
<html lang="en">
<?php $page_title = "Home"; require('../src/partials/head.php'); ?>
<body>
    <?php if ( isUserLoggedIn() ): ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
    <h1>Posts</h1>
    <?php foreach ($results as $row): ?>
        <article>
            <h2><?php echo htmlspecialchars($row['title']) ?></h2>
            <p><?php echo htmlspecialchars($row['content']) ?></p>
        </article>
        <br>
        <hr>
    <?php endforeach; ?>

    <?php if ( isUserLoggedIn() ) { ?>
        <hr>
        <h2>Make a Post</h2>
        <form method="post">
            <p>
                <label for="title">Title</label>
                <input type="text" name="title" id="title">
            </p>
            <p>
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </p>
            <input type="submit" value="Create">
        </form>
    <?php } ?>
</body>
</html>
