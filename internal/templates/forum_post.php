<?php
// template
 $this->layout('template', ['title' => 'Forum Post']);
 ?>
<center><h1>Forum Post</h1></center>
<center>
<form action="forum_post.php?catid=<?php echo $_GET['catid']; ?>" method="post">
Title: <input type="text" name="title"><br><br>
Content: <input type="text" name="content"><br><br>
<input type="submit">
</form>
</center>