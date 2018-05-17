<?php
    $db = new mysqli(
        "192.168.57.10",
        "crystal",
        "crystal",
        "blog"
    );

    function connectUser($db, $username, $password) {
        $query = $db->prepare("SELECT `id`, `username`, `email`, password FROM `users` WHERE `username` = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $user = $query->get_result();
        $user = $user->fetch_assoc();
        if($user == NULL) {
            return 'usernameError';
        } elseif($user['password'] != md5($password)) {
            return 'passwordError';
        } else {
            $_SESSION['user'] = array(
                "id"       => $user['id'],
                "username" => $user['username'],
                "email"    => $user['email']
            );
            return true;
        }
    }

    function getAllPosts($db) {
        $query = "SELECT * FROM posts";
        $posts = $db->query($query);
        $posts = $posts->fetch_all(MYSQLI_ASSOC);
        return $posts;
    }

    function deletePost($db, $id) {
        $query = $db->prepare("DELETE FROM posts WHERE id=?");
        $query->bind_param("s", $id);
        $query->execute();
    }

    function getPost($db, $id) {
        $query = $db->prepare("SELECT * FROM posts WHERE id=?");
        $query->bind_param("s", $id);
        $query->execute();
        $post = $query->get_result();
        $post = $post->fetch_assoc();
        return $post;
    }

    function updatePost($db, $id) {
        $query = $db->prepare("UPDATE posts SET title=?, author=?, category=?, content=? WHERE id=?");
        $query->bind_param("sssss", $_POST['title'], $_POST['author'], $_POST['category'], $_POST['content'], $id);
        $query->execute();
    }

    function createPost($db) {
        $query = $db->prepare("INSERT INTO posts (id, title, content, author, category, created_at) VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $query->bind_param("ssss", $_POST['title'], $_POST['author'], $_POST['category'], $_POST['content']);
        $query->execute();
    }

    function createUser($db) {
        $query = $db->prepare("INSERT INTO users (id, username, email, password) VALUES (NULL, ?, ?, ?)");
        var_dump($query);
        $query->bind_param("sss", $_POST['username'], $_POST['email'], $_POST['password']);
        $query->execute();
    }
