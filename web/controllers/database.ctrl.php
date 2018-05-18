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

    function updatePost($db, $title, $author, $category, $content, $id) {
        $query = $db->prepare("UPDATE posts SET title=?, author=?, category=?, content=? WHERE id=?");
        $query->bind_param("sssss", $title, $author, $category, $content, $id);
        $query->execute();
    }

    function createPost($db, $title, $author, $category, $content) {
        $query = $db->prepare("INSERT INTO posts (id, title, author, category, content, created_at) VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $query->bind_param("ssss", $title, $author, $category, $content);
        $query->execute();
    }

    function createUser($db, $username, $email, $password1, $password2) {
        if($password1 != $password2) {
            return 'invalidPassword';
        }
        $pwd = md5($password1);
        $query = $db->prepare("INSERT INTO users (id, username, email, password) VALUES (NULL, ?, ?, ?)");
        $query->bind_param("sss", $username, $email, $pwd);
        $result = $query->execute();
        return $result;
    }
