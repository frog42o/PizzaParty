<?php
//include auth_session.php file on all user panel pages
include("allow_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Join or Create a Class</title>
    <link rel="stylesheet" href="post.css" />
</head>
<body>
<div class="form" >
    <h1 class="post-title">Select An Option:</h1>
    <a href= "classes/createClass.php"><button class = "login-button">Create a Class</button></a>
    <a href = "classes/joinClass.php"> <button class = "login-button">Join a Class</button></a>
    <p class='link'>Return to <a href='dashboard.php'>Dashboard</a></p>
</div>
</body>
</html>