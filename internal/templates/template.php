<!doctype html>
<html lang="en">
<head>
    <title><?=$this->e($title)?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="<?=$this->e($title)?>">
<body>
<center>
<nav>
<fieldset>
<?php if ($user_loggedin): ?>
<legend>navbar</legend>
<a href="forums.php">forums</a>
<a href="logout.php">log out</a>
<?php endif ?>
<?php if (!$user_loggedin): ?>
<legend>navbar</legend>
<a href="login.php">login</a>
<a href="register.php">register</a>
<?php endif ?>
</fieldset>
</nav>
</center>
<?php if ($user_loggedin): ?>
<center> logged in as: <?=$this->e($user_username)?> </center>
<?php endif ?>
<main>
<?=$this->section('content')?>
</main>

</body>
</html>