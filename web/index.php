<?php
    session_start();

    if(isset($_GET['action']) && $_GET['action'] == 'restart') {
        session_destroy();
        header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
    }

    $db = new mysqli(
        "192.168.57.10",
        "crystal",
        "crystal",
        "blog"
    );
    $error = NULL;

    if(isset($_POST['username'])) {
        $query = $db->prepare("SELECT username, password FROM users WHERE username = ?");
        $query->bind_param("s", $_POST['username']);
        $query->execute();
        $user = $query->get_result();
        $user = $user->fetch_assoc();
        if($user == NULL) {
            $error = 'usernameError';
        } elseif($user['password'] != $_POST['password']) {
            $error = 'passwordError';
        } else {
            $_SESSION['user'] = $_POST;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SQL</title>
    </head>
    <body>
        <h1>Blog</h1>
        <?php if($error == 'usernameError'): ?>
            <div>User <?= $_POST['username'] ?> doesn't exists.</div>
        <?php elseif($error == 'passwordError'): ?>
            <div>Invalid password.</div>
        <?php endif; ?>
        <?php if($_SESSION): ?>
            <div>Welcome <?= $_SESSION['user']['username'] ?> !</div>
            <a href="?action=restart">Logoff</a>
        <?php else: ?>
            <form method='POST' action=''>
                <input type="text" name="username"/>
                <input type="text" name="password"/>
                <input type="submit"/>
            </form>
        <?php endif; ?>
    </body>
</html>