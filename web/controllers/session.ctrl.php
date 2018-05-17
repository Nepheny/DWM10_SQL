<?php
    session_start();
    include_once('controllers/database.ctrl.php');
    if(isset($_GET['action']) && $_GET['action'] == 'restart') {
        session_destroy();
        header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
        exit();
    }
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $result = connectUser($db, $_POST['username'], $_POST['password']);
    }