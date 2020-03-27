<?php
// template
 $this->layout('template', ['title' => 'Register']) 
 ?>
 <center><h1 color="red"><?=$this->e($msg)?></h1></center>
<center><h1>Register</h1></center>
<center>
<form action="Register.php" method="post">
Username: <input type="text" name="username"><br>
Password: <input type="text" name="password"><br>
<input type="submit">
</form>
</center>