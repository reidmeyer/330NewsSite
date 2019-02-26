<?php
session_start();
require 'config.php';

$storyidreferenced = stripslashes($_GET["storyid"]);
$_SESSION['storyidreferenced']=$storyidreferenced;
$comment_id = 'comment_id';
$comment_content = 'comment_content';
$comment_createdbyuser = 'comment_createdbyuser';

$stmt = $mysqli->prepare("select storyidreferenced, comment_id, comment_content, comment_createdbyuser from comments where storyidreferenced like ?");
$stmt->bind_param('s', $storyidreferenced);

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();

$stmt->bind_result($storyidreferenced, $comment_id, $comment_content, $comment_createdbyuser);

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
body{
background-color: cyan;
}
</style><ul>\n";
printf("\t<li>Story id: %s </li>\n",
       ($storyidreferenced));
while($stmt->fetch()){


    printf("\t<li>Comment id: %s </li>\n",
           ($comment_id));
    printf("\t<li>Content: %s </li>\n",
           ($comment_content));
    printf("\t<li>Created by user: %s </li>\n",
           ($comment_createdbyuser));
    echo "<br><hr><br>";
}
echo "</ul>\n";

$stmt->close();

?>

<html lang="en">
    <body>
        <form action="commentonstory.php" method="post">
            <br><br>
            <p>If you are a registered user, you can make a comment on this story here:</p>
            <input type="text" name="comment">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

            <input type="submit" value="Comment">
        </form>

        <form action="editcomment.php" method="post">
            <br><br>
            <p>If you are the owner of a comment, enter the comment id to edit it:</p>
            <input type="text" name="commentid">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

            <input type="submit" value="Edit">
        </form>

    </body>

</html>

<html lang="en">
    <form action="logout.php">
        <input type="submit" value="Log out">
    </form>
</html>

<?

?>