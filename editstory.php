<?php
session_start();
require 'config.php';

if ($_SESSION['loggedin']==false)
{
    header ("Location: youcantdothat.php");
    die();
}

if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$story_id = $_POST["storyid"];
$_SESSION['storyidreferenced']=$story_id;


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

if ($_SESSION['user']!=$madebyuser)
{
    header ("Location: youcantdothat.php");
    die();
}






?>

<html lang="en">
    <p>Click delete to delete story and all comments within story</p>
    <form action="deletestory.php">
        <input type="submit" value="Delete">
    </form>
</html>

<html lang="en">
    <p>Below, enter the the new content you want to change the comment content to: </p>
    <form action="updatestory.php" method = "post">
        <input type="text" name="newcontent">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

        <input type="submit" value="Edit">
    </form>
</html>


<html lang="en">
    <form action="logout.php">
        <input type="submit" value="Log out">
    </form>
</html>

