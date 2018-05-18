<?php
    include_once('controllers/posts.ctrl.php');
?>
<h2>Posts</h2>
<a href="?action=new-post">New post</a>
<ul>
    <?php foreach (getAllPosts($db) as $post): ?>
        <li>
            <a href="?action=read&id=<?= $post['id'] ?>"><?= $post['title'] ?></a>,  (<?= $post['category'] ?>)
            <a href="?action=update&id=<?= $post['id'] ?>">Update</a>
            <a href="?action=delete&id=<?= $post['id'] ?>">Delete</a>
        </li>
    <?php endforeach ?>
</ul>