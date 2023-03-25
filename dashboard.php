<?php
//include auth_session.php file on all user panel pages
include("allow_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="60">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" />
</head>
<body>
    <div id="parent">    
    <p id = "child">Hey, <?php echo ucfirst($_SESSION['username']); ?>!</p>
    <a id="child" href = "logout.php"><button>Logout</button></a> 
      
</body>
</html>