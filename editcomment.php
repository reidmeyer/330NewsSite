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


$storyidreferenced = $_SESSION['storyidreferenced'];
$comment_id = $_POST["commentid"];
$_SESSION['commentidreferenced']=$comment_id;

echo "here is the comment";

$comment_content = 'comment_content';
$comment_createdbyuser = 'comment_createdbyuser';


$stmt = $mysqli->prepare("select comment_id, storyidreferenced, comment_content, comment_createdbyuser from comments where comment_id like ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s', $comment_id);

$stmt->execute();

$stmt->bind_result($comment_id, $storyidreferenced, $comment_content, $comment_createdbyuser);

echo "<ul>\n";
while($stmt->fetch()){

    printf("\t<li>comment id: %s </li>\n", (htmlentities($comment_id)));
    printf("\t<li>story idr: %s </li>\n", (htmlentities($storyidreferenced)));
    printf("\t<li>Content: %s </li>\n", (htmlentities($comment_content)));
    printf('<li>Created by: <a href="%1$s">%1$s</a></li>', htmlentities($comment_createdbyuser));
    echo "<br>";
}
echo "</ul>\n";

$stmt->close();

if ($_SESSION['user']!=$comment_createdbyuser)
{
    header ("Location: youcantdothat.php");
    die();
}






?>

<html lang="en">
    <p>Below, click delete to delete the comment</p>
    <form action="deletecomment.php">
        <input type="submit" value="Delete">
    </form>
</html>

<html lang="en">
    <p>below, enter the the new content you want to change the comment content to: </p>
    <form action="updatecomment.php" method = "post">
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

