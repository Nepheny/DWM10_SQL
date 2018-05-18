<?php
    include_once('controllers/database.ctrl.php');

    function redirectLogin() {
        if(! isset($_SESSION['user'])) {
            header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
            exit();
        }
    }

    if(isset($_GET['action']) && $_GET['action'] == 'new-user') {
        include('views/templates/user-create.tmpl.php');
    }

    if(isset($_GET['action']) && $_GET['action'] == 'do-new-user') {
        $result = createUser($db, $_POST['username'], $_POST['email'], $_POST['password1'], $_POST['password2']);
        include('views/templates/user-create.tmpl.php');
    }

    if(isset($_GET['action']) && $_GET['action'] == 'connect') {
        include('views/templates/user-login.tmpl.php');
    }