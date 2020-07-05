<?php
// template
 $this->layout('template', ['title' => 'Forum View Post']);
 ?>
<center>
<fieldset>
<legend><?= $this->e($forum_post['title']) ?> - by <?= $this->e($forum_creator_username) ?></legend>
<p><?= $this->e($forum_post['content']) ?>
<hr>
<p> replies: </p>
<hr>
<?php foreach($forum_replies as $forum_reply): ?>
    <center><p><?= $this->e($forum_reply['title']) ?> - by <?= $this->e($forum_reply['replier_uname']) ?></p></center> 
    <hr>
 <?php endforeach ?>
 <form action="forums_view.php?id=<?php echo $_GET['id']?>" method="post">
 <label for="reply">reply: </label><input type="text" id="reply" name="reply"><br><br>
 <label for="submit">submit</label><input type="submit" id="submit">
</form>
</fieldset>
</center>