<?php
// front page
include 'internal/includes.php';

$forum_posts = $db->query('SELECT * FROM forum_posts WHERE reply=0 ORDER BY id DESC')->fetch_all();
echo $templater->render('forum_posts', ['forum_posts' => $forum_posts]);

?>