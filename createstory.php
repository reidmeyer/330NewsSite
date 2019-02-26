<?php
session_start();
if ($_SESSION['loggedin']==false)
{
    header ("Location: youcantdothat.php");
    die();
}
?>
<style>
body{
    background-color: cyan;
    }</style>

<html lang="en">
    <body>
        <h1>Create Story</h1> 
        <form action="actuallycreatestory.php" method="post">
            <p>Story content: </p>
            <input type="text" name="storycontent">
            <p>Link to Image: </p>
            <input type="text" name="thelink">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

            <input type="submit" value="Create Story">
        </form>
        <br>

     
        
        <form action="logout.php">
            <input type="submit" value="Log out">
        </form>
        

    </body>
</html>

<?
?>