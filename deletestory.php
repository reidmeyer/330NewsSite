<?php
session_start();
require 'config.php';

if ($_SESSION['loggedin']==false)
{
    header ("Location: youcantdothat.php");
    die();
}


$storytodelete = $_SESSION['storyidreferenced'];



$stmt = $mysqli->prepare("delete from comments where storyidreferenced like ?");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('s', $storytodelete);
$stmt->execute();
$stmt->close();



$stmt = $mysqli->prepare("delete from stories where story_id like ?");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('s', $storytodelete);
$stmt->execute();
$stmt->close();
header('Location: inside.php');
?>

<html lang="en">
    <form action="logout.php">
        <input type="submit" value="Log out">
    </form>
</html>