<?php
// template
 $this->layout('template', ['title' => 'Forums']) 
 ?>

<?php foreach($forum_cats as $forum_cat): ?>
    <center><p><a href="forums_cat.php?id=<?= $this->e($forum_cat['id'])?>"><?= $this->e($forum_cat['name']) ?></a></p></center> 
 <?php endforeach ?>
 