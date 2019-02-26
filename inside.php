<?php
session_start();


require 'config.php';

if($_SESSION['loggedin']==true)
{
    echo htmlentities($_SESSION['user']);
    echo " is logged in";
}
else
{
    echo "guest is logged in";
}


//here, print out all stories
$story_id='story_id';
$story_content = 'story_content';
$madebyuser = 'madebyuser';
$thelink = 'thelink';

$stmt = $mysqli->prepare("select story_id, madebyuser, story_content, thelink from stories order by story_id");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}






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
           (htmlentities(htmlentities($story_id))));
    printf("\t<li>Made by user:<b> %s</b> </li>\n",
           (htmlentities(htmlentities($madebyuser))));
    printf('</div><li>Image: <img src="%s"></li>', htmlentities($thelink));
    printf("\t<li>Content: %s </li>\n",
           (htmlentities($story_content)));
    
    echo "<br><hr><br>";
}
echo "</ul>\n";

$stmt->close();

?>




<html lang="en">
    <body>
        <form action="comments.php">
            <br><br>
            <p>Please type in the story id of the story to view its comments</p>
            <input type="text" name="storyid">
            <input type="submit" value="View comments">
        </form>
    </body>

</html>

<html lang="en">
    <body>
        <form action="editstory.php" method = "post">
            <br><br>
            <p>If you are the creator of a story, enter the story id here to edit the story</p>
            <input type="text" name="storyid">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

            <input type="submit" value="Edit story">
        </form>
    </body>

</html>

<html lang="en">
    <body>
        <form action="viewspecificstory.php" method = "get">
            <br><br>
            <p>To go to the story page. enter the story id here</p>
            <input type="text" name="storyid">
            <input type="submit" value="View Story">
        </form>
    </body>

</html>

<html lang="en">
    <br>
    <p>if you are a registered user, click this button to be brought to the story creation page</p>
    <form action="createstory.php">
        <input type="submit" value="Create Story">
    </form>
</html>

<html lang="en">
    <body>
        <form action="searchcontent.php" method = "get">
            <br><br>
            <p>Display stories that contain </p>
            <input type="text" name="contain">
            <input type="submit" value="Search">
        </form>
    </body>

</html>


<html lang="en">
<form action="index1.html">
            <input type="submit" value="go to login page">
        </form>
</html>
<html lang="en">
    <form action="logout.php">
        <input type="submit" value="Log out">
    </form>
</html>

<?

?>