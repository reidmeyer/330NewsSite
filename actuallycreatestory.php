<?php
session_start();
if ($_SESSION['loggedin']==false)
{
    die();
    exit("you can't do that");
}

$user = $_SESSION["user"];
$story_content = $_POST["storycontent"];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$story_createdbyuserid = $_SESSION["userid"];
$thelink = $_POST["thelink"];


require 'config.php';

$stmt = $mysqli->prepare("insert into stories (madebyuser, story_content, story_createdbyuserid, thelink) values (?, ?, ?, ?)");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('ssss', $user, $story_content, $story_createdbyuserid, $thelink);
$stmt->execute();
$stmt->close();
header('Location: inside.php');
?>

<html lang="en">
    <form action="logout.php">
        <input type="submit" value="Log out">
    </form>
</html>
