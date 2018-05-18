<h2>Update post</h2>
<form method="POST" action="?action=do-update">
    <input type="hidden" name="id" value="<?= $post['id'] ?>"/>
    <input type="text" name="title" placeholder="Title" value="<?= $post['title'] ?>"/>
    <input type="text" name="author" placeholder="Author" value="<?= $post['author'] ?>"/>
    <input type="text" name="category" placeholder="Category" value="<?= $post['category'] ?>"/>
    <textarea name="content"><?= $post['content'] ?></textarea>
    <input type="submit"/>
</form>