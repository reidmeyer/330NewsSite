<?php
session_start();
if ($_SESSION['loggedin']==false)
{
    header ("Location: youcantdothat.php");
    die();
}

$user = $_SESSION["user"];
$comment_content = $_POST["comment"];
$comment_createdbyid = $_SESSION["userid"];
$storyidreferenced = $_SESSION["storyidreferenced"];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}


require 'config.php';

$stmt = $mysqli->prepare("insert into comments (storyidreferenced, comment_content, comment_createdbyid, comment_createdbyuser) values (?, ?, ?, ?)");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('ssss', $storyidreferenced, $comment_content, $comment_createdbyid, $user);
$stmt->execute();
$stmt->close();
header('Location: inside.php');
?>

<html lang="en">
    <form action="logout.php">
        <input type="submit" value="Log out">
    </form>
</html>