<?php
session_start();

if(isset($_GET['action']) && $_GET['action'] == 'restart') {
    session_destroy();
    header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
}

$db = new mysqli(
    "192.168.57.10",    // hostname
    "crystal",          // username
    "crystal",          // password
    "blog"              // db name
);

// Check if GET parameter 'username' exists
if(isset($_POST['username'])): ?>
    <?php
    // Create a new query
    $query = "SELECT username, password FROM users WHERE username = '" . $_POST['username'] . "'";
    $user = $db->query($query);
    // To retrieve several results lines :
    // $user = $user->fetch_all(MYSQLI_ASSOC);
    // To retrieve only first line :
    $user = $user->fetch_assoc();
    if($user == NULL): ?>
       <div style="background:blue;color:#fff">User <?= $_POST['username'] ?> doesn't exists.</div> 
    <?php else: ?>
        <?php if($user['password'] != $_POST['password']): ?>
            <div style="background:blue;color:#fff">Invalid password.</div>
        <?php else: ?>
            <?php $_SESSION['user'] = $_POST; ?>
            <div style="background:blue;color:#fff">Welcome <?= $_SESSION['user']['username'] ?> !</div> 
        <?php endif ?>
    <?php endif ?>
<?php endif ?>

<h1>Does this user exist ?</h1>
<form method='POST' action=''>
	<input type="text" name="username"/>
    <input type="text" name="password"/>
	<input type="submit"/>
</form>
<a href="?action=restart">Logoff</a>