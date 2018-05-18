<?php
    include_once('controllers/user.ctrl.php');
?>
<?php if(isset($result) && $result === false): ?>
    <div>Error, your username or email already exist.</div>
<?elseif(isset($result) && $result === 'invalidPassword'): ?>
    <div>Error, passwords doesn't match.</div>
<?php elseif(isset($result) && $result === true): ?>
    <div>User created.</div>
<?php endif; ?>

<h2>New user</h2>
<form method="POST" action="?action=do-new-user">
    <input type="text" name="username" placeholder="Username"/>
    <input type="email" name="email" placeholder="Email"/>
    <input type="password" name="password1"/>
    <input type="password" name="password2"/>
    <input type="submit"/>
</form>