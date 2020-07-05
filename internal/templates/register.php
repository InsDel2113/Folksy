<?php
// template
 $this->layout('template', ['title' => 'Register']) 
 ?>
<?php if ( strlen($msg) > 0 ) { $this->insert('error_msg', ['msg' => $msg]); }?>
<center><h1>Register</h1></center>
<center>
<form action="register.php" method="post">
Username: <input type="text" name="username"><br><br>
Password: <input type="text" name="password"><br><br>
<input type="submit">
</form>
</center>