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
    <a href= "classes/createClass.php"><button>Create a Class</button></a>
    <a href = "classes/joinClass.php"> <button>Join a Class</button></a>
</div>
</body>
</html>