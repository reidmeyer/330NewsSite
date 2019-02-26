<?php
session_start();
if ($_SESSION['loggedin']==false)
{
    header ("Location: youcantdothat.php");
    die();
}


$storyidreferenced = $_SESSION["storyidreferenced"];
$newcomment = $_POST["newcontent"];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

require 'config.php';

$stmt = $mysqli->prepare("update stories set story_content = ? where story_id like ?");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('ss', $newcomment, $storyidreferenced);
$stmt->execute();
$stmt->close();
header('Location: inside.php');
?>
