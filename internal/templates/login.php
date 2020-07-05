<?php
// template
 $this->layout('template', ['title' => 'Login']) 
 ?>
<?php if ( strlen($msg) > 0 ) { $this->insert('error_msg', ['msg' => $msg]); }?>
<center><h1>Login</h1></center>
<center>
<form action="login.php" method="post">
Username: <input type="text" name="username"><br><br>
Password: <input type="text" name="password"><br><br>
<input type="submit">
</form>
</center>