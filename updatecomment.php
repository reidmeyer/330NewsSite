<?php
session_start();
if ($_SESSION['loggedin']==false)
{
    header ("Location: youcantdothat.php");
    die();
}


$commenttoupdate = $_SESSION["commentidreferenced"];
$newcomment = $_POST["newcontent"];

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

require 'config.php';

$stmt = $mysqli->prepare("update comments set comment_content = ? where comment_id like ?");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('ss', $newcomment, $commenttoupdate);
$stmt->execute();
$stmt->close();
header('Location: inside.php');
?>
