<?php
//include auth_session.php file on all user panel pages
include("allow_session.php");
require('connection_db.php');
$userQuery  = "SELECT * FROM `userdata` WHERE username='" . $_SESSION['username'] . "'";
$userResult = mysqli_query($con, $userQuery);
$userData = mysqli_fetch_array($userResult);
$grade = $userData['grade'];
$data = $_GET["data"];//contains which classroom we are in
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="bootstrap-4.3.1/dist/css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Su Jin Shin, Jason Dong, Zackary Sikkink, Sam Gaussman, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Dashboard</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/product/">
    
    <!-- Custom styles for this template -->
    <link href="product.css" rel="stylesheet">
    <link href="classroom.css" rel="stylesheet">
  </head>
  <body>
  <section> <!-- top navigation bar-->
    <header class="site-header sticky-top py-1">
    <nav class="container d-flex flex-column flex-md-row justify-content-between">
        <?php 
        if($grade == "Teacher"){
          $classroom_query = "SELECT * FROM `classdata` where classname = '$data'";
          $classroom_result = mysqli_query($con, $classroom_query);
          $classroom_data = mysqli_fetch_array($classroom_result);
          $classname = $classroom_data['classname'];
          echo "<a class='py-2 d-none d-md-inline-block' href='dashboard.php'>Dashboard</a>
            <a class='py-2 d-none d-md-inline-block' href='tasks/task.php?data=$grade&data2=$classname'>Assign Task</a>
            <a class='py-2 d-none d-md-inline-block' href='logout.php'>Logout</a>";
          ?>
        <?php }else{
        ?>
        <a class="py-2 d-none d-md-inline-block" href="dashboard.php">Dashboard</a>
        <a class="py-2 d-none d-md-inline-block" href="logout.php">Logout</a>
        <?php }?>
    </nav>
    </header>
</section>

 
<section> <!-- main section with the slogan and components of website-->
<main>
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
<div id = "classroom">
  <?php
    if(isset($_GET["data"]))
    {
      $classroom_query = "SELECT * FROM `classdata` where classname = '$data'";
      $classroom_result = mysqli_query($con, $classroom_query);
      $data = $_GET["data"];//contains which classroom we are in
      if($classroom_result){
        $classroom_data = mysqli_fetch_array($classroom_result);
        $classname = ucfirst($classroom_data['classname']);
        $currentprogress = $classroom_data['currentprogress'];
        $progressgoal = $classroom_data['progressgoal'];
        $classcode = $classroom_data['classcode'];
        echo "<p >$classname (Class Code: <b>$classcode</b>)</p>
        <label for='progress'>Progress Bar: ($currentprogress/$progressgoal PTS)</label><br>
        <progress id='progress' value='$currentprogress' max='$progressgoal'> $currentprogress % </progress><br> ";

        $teacher = $classroom_data['teacher'];
        $students = $classroom_data['students'];
        $studentsArr = explode(",", $students);
        echo " <p><u><b>Classroom List:</b></u></p>
        <p><span style='color:red;'><b>Teacher</b></span> $teacher</p>";
        for($x =0 ; $x < sizeof($studentsArr); $x++){
            echo "<p><span><b>Student</b></span> $studentsArr[$x]</p>";
        }
        $taskq= "SELECT * FROM classdata where classname ='$data'";
        $taskResult = mysqli_query($con, $taskq);
        $taskdata = mysqli_fetch_array($taskResult);
        $tasks = $taskdata['tasks'];
        $taskArr = explode(";", $tasks);
        echo " <p><u><b>Task List:</b></u></p>";
        for($x =0 ; $x < sizeof($taskArr); $x++){
            echo "<p>$taskArr[$x]</p>";
        }
      }
    }

  ?> 
    
</div>
</div>
</main>
</footer>
</section>
<script src="bootstrap-4.3.1/dist/css/bootstrap.min.css"></script>   
<script src ="loadClass.js"></script>  
</body>
</html>