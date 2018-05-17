<?php
    include('controllers/user.ctrl.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SQL</title>
    </head>
    <body>
        <header>
            <h1>Blog</h1>
        </header>
        <main>
            <?php if(isset($result) && $result !== true): ?>
                <?php if($result == 'usernameError'): ?>
                    <div>User <?= $_POST['username'] ?> doesn't exists.</div>
                <?php else: ?>
                    <div>Invalid password.</div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(!isset($_SESSION['user'])): ?>
                <a href="?action=new-user">New user</a>
                <a href="?action=connect">Connect</a>
            <?php else: ?>
                <div>Welcome <?= $_SESSION['user']['username'] ?> !</div>
                <a href="?action=restart">Logoff</a>
                <?php include_once('posts.php'); ?>
            <?php endif; ?>
        </main>
    </body>
</html>