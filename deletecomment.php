<?php
session_start();
if ($_SESSION['loggedin']==false)
{
    header ("Location: youcantdothat.php");
    die();
}


$commenttodelete = $_SESSION["commentidreferenced"];

require 'config.php';

$stmt = $mysqli->prepare("delete from comments where comment_id like ?");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('s', $commenttodelete);
$stmt->execute();
$stmt->close();
header('Location: inside.php');
?>
