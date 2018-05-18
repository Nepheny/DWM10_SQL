<?php
    include_once('controllers/database.ctrl.php');
    include_once('controllers/user.ctrl.php');
    redirectLogin();

    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        deletePost($db, $_GET['id']);
    }

    if(isset($_GET['action']) && $_GET['action'] == 'update') {
        $post = getPost($db, $_GET['id']);
        include('views/templates/post-update.tmpl.php');
    }

    if(isset($_GET['action']) && $_GET['action'] == 'do-update' && isset($_POST['id'])) {
        updatePost($db, $_POST['title'], $_POST['author'], $_POST['category'], $_POST['content'], $_POST['id']);
    }

    if(isset($_GET['action']) && $_GET['action'] == 'new-post') {
        include('views/templates/post-create.tmpl.php');
    }

    if(isset($_GET['action']) && $_GET['action'] == 'do-new-post') {
        createPost($db, $_POST['title'], $_POST['author'], $_POST['category'], $_POST['content']);
    }
?>