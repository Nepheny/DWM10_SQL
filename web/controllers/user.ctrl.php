<?php
    include_once('controllers/database.ctrl.php');

    function redirectLogin() {
        if(! isset($_SESSION['user'])) {
            header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
            exit();
        }
    }

    if(isset($_GET['action']) && $_GET['action'] == 'new-user') {
        include('user-create.php');
    }

    if(isset($_GET['action']) && $_GET['action'] == 'do-new-user') {
        createUser($db);
    }

    if(isset($_GET['action']) && $_GET['action'] == 'connect') {
        include('user-login.php');
    }