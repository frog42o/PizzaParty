<?php
include("../allow_session.php");
require('../connection_db.php');
$grade = $_GET["data"];//contains Teacher 
$data = $_GET["data2"];//contains which classroom we are in
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Assign A Task</title>
    <link rel="stylesheet" href="../post.css"/>
</head>
<body>
<?php
    // When form submitted, check and create user session.
    if (isset($_POST['taskname'])) {
        $classQuery  = "SELECT * FROM `classdata` WHERE classname='$data'";
        $classResult = mysqli_query($con, $classQuery);
        if($classResult){
            $classData = mysqli_fetch_array($classResult);
            $taskname = stripslashes($_REQUEST['taskname']);
            $taskname = mysqli_real_escape_string($con, $taskname);
            $taskdesc = stripslashes($_REQUEST['taskdesc']);
            $taskdesc = mysqli_real_escape_string($con, $taskdesc);
            $taskType = stripslashes($_REQUEST['taskType']);
            $data_builder = $taskname. ",".$taskdesc.",".$taskType;
            echo $data_builder;
            if(empty($classData['enrolled'])){
                $enroll_query= "UPDATE classdata SET tasks = CONCAT('$data_builder',';', tasks ) WHERE classname = '$data'";
            }else{
                $enroll_query= "UPDATE userdata SET tasks = CONCAT('$data_builder', ';',tasks ) WHERE classname = '$data'";
            }
            $enroll_result = mysqli_query($con, $enroll_query);
            if($enroll_result){
                echo "<div class='form'>
                    <h3>You have successfully created a Task!</h3>";      
                echo "<p class='link'>Click here to return to <a href='../classroom.php?data=$data'>Classroom</a></p>
                    </div>";
            } else{
                echo "enroll error";
            }
        }else{
            echo "<div class='form'>
            <h3>Required fields are missing.</h3><br/>
            <p class='link'>Click here to <a href='task.php'>try again</a>.</p>
            </div>";
        }
        }      
     else {
?>
    <form class="form" method="post" name="createTask">
        <h1 class="post-title">Assign A Task</h1>
        <input type="text" class="post-input" name="taskname" placeholder="Task Name" autofocus="true"/>
        <input type="textarea" class="post-input" name="taskdesc" placeholder="Task Description" autofocus="true"/>
        
        <label>Assign To:</label><br>
        <input type="checkbox" name="taskType" onclick="onlyOne(this)" value="Everyone"checked>
        <label for="taskType">Everyone</label><br>
        <input type="checkbox" name="taskType" onclick="onlyOne(this)" value="Anyone">
        <label for="taskType">At Least One</label><br>
        <input type="submit" value="Create" name="submit" class="login-button"/>
        <?php
            echo " <p class='link'><a href='../classroom.php?data=$data'>Return Back</a></p>";
        ?>
  </form>
<?php
    }
?>
<script src = "taskFilter.js"></script>
</body>
</html>