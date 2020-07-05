<?php
// front page
include 'internal/includes.php';

$forum_cats = $db->query('SELECT * FROM forum_categories')->fetch_all();
echo $templater->render('forum_categories', ['forum_cats' => $forum_cats]);

?>