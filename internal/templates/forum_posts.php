<?php
// template
 $this->layout('template', ['title' => 'Forum Posts']) 
 ?>

<?php foreach($forum_posts as $forum_post): ?>
    <center><p><a href="forums_view.php?id=<?= $this->e($forum_post['id'])?>"><?= $this->e($forum_post['title']) ?></a></p></center> 
 <?php endforeach ?>
 