<?php
// front page
include 'internal/includes.php';

if ( !isset($_GET['id']) || empty($_GET['id']) ) {
    echo $templater->render('error_msg', ['msg' => "Invalid post id"]);
    die();
}
if ( $misc->has_posted_nonvar() && $misc->has_posted($_POST['reply']) && strlen($_POST['reply']) > 2 && strlen($_POST['reply']) < 128 ) {
    $forum_post_query = $db->query('INSERT INTO forum_posts (title,content,poster_id,replier_uname,reply,threadid) VALUES (?,?,?,?,?, ?)', $_POST['reply'], $_POST['reply'], $user->userid, $user->username, 1, $_GET['id']);
}

$forum_post = $db->query('SELECT * FROM forum_posts WHERE id=? AND reply=0', $_GET['id'])->fetch_array();
$forum_replies = $db->query('SELECT * FROM forum_posts WHERE threadid=? AND reply=1', $_GET['id'])->fetch_all();
echo $templater->render("forum_view", ["forum_post" => $forum_post, "forum_creator_username" => $user->id_to_username($forum_post['poster_id']), "forum_replies" => $forum_replies]);