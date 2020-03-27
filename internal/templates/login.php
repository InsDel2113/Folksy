<?php
// template
 $this->layout('template', ['title' => 'Login']) 
 ?>
 <center><h1 color="red"><?=$this->e($msg)?></h1></center>
<center><h1>Login</h1></center>
<center>
<form action="login.php" method="post">
Username: <input type="text" name="username"><br>
Password: <input type="text" name="password"><br>
<input type="submit">
</form>
</center>