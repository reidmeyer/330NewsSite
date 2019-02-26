<?php
session_start();
session_destroy();
header("inside.html");
session_start();
$_SESSION['loggedin']=false;
header('Location: inside.php');
?>