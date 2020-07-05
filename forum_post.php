<?php

include 'internal/includes.php';
if ( !isset($_GET['catid']) ) {
    echo $templater->render("error_msg", ["msg" => "Invalid category ID"]);
    die();
}

if ( $misc->has_posted_nonvar() && $misc->has_posted($_POST['title']) && $misc->has_posted($_POST['content']) ) {
    if ( strlen($_POST['title']) < 2 || strlen($_POST['title']) > 48 || strlen($_POST['content']) < 2 || strlen($_POST['content']) > 512 ) {
        echo $templater->render("error_msg", ["msg" => "Your title or content is either too short or too long. Maximum is 48 and 512."]);
        die();
    }
    $forum_post_query = $db->query('INSERT INTO forum_posts (title,content,poster_id, cat_id) VALUES (?,?,?,?)', $_POST['title'], $_POST['content'], $user->userid, $_GET['catid']);
}

echo $templater->render("forum_post", ["catid", $_GET['catid']]);
?>