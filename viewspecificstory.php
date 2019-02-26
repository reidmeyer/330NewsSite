<?php
session_start();
require 'config.php';

$story_id = $_GET["storyid"];


echo "here is the story";

$story_content = 'story_content';
$madebyuser = 'madebyuser';
$thelink = 'thelink';

$stmt = $mysqli->prepare("select story_id, madebyuser, story_content, thelink from stories where story_id like ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s', $story_id);

$stmt->execute();

$stmt->bind_result($story_id, $madebyuser, $story_content, $thelink);

echo "<style>
ul{
align: center;
text-align: center;
}
li {

  list-style: none;

}
div{
text-align: left;
font-size: .7em;
color: grey;
}

hr{
box-shadow: 0 0 10px 1px black;
}

img{
width: 200px;
height: auto;
}

body{
background-color: cyan;
}
</style>
<ul>\n";
while($stmt->fetch()){

    printf("\t<div><li>Story id: %s </li>\n",
           (htmlentities($story_id)));
    printf("\t<li>Made by user:<b> %s</b> </li>\n",
           (htmlentities($madebyuser)));
    printf('</div><li>Image: <img src="%s"></li>', htmlentities($thelink));
    printf("\t<li>Content: %s </li>\n",
           (htmlentities($story_content)));
    
    echo "<br><hr><br>";
}
echo "</ul>\n";

$stmt->close();


?>


<html lang="en">
    <form action="logout.php">
        <input type="submit" value="Log out">
    </form>
</html>

