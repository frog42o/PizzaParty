<?php
include("../allow_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create a Class</title>
    <link rel="stylesheet" href="../post.css"/>
</head>
<body>
<?php
    function random($len){
        $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // ----------------------------------------------
        // Number of possible combinations
        // ----------------------------------------------
        $pos = strlen($char);
        $pos = pow($pos, $len);
        // ----------------------------------------------

        $total = strlen($char)-1;
        $text = "";

        for ($i=0; $i<$len; $i++){
            $text = $text.$char[rand(0, $total)];
        }
        return $text;
    }

    require('../connection_db.php');
    // When form submitted, check and create user session.
    if (isset($_POST['classname'])) {
        $userQuery  = "SELECT * FROM `userdata` WHERE username='" . $_SESSION['username'] . "'";
        $userResult = mysqli_query($con, $userQuery);
        if($userResult){
            $data = mysqli_fetch_array($userResult);
            if($data['grade'] != "Teacher"){
                echo "<div class='form'>
                      <h3>You are not a teacher!</h3><br/>
                      <p class='link'>Return to <a href='../dashboard.php'>Dashboard</a></p>
                      </div>";
                }
                else{
                    $classname = stripslashes($_REQUEST['classname']);
                    $classname = mysqli_real_escape_string($con, $classname);

                    $teacher = $_SESSION['username'];

                    $courseCode = random(9);
                    $progressGoal = 1000;

                    $query    = "INSERT into `classdata` (classname, teacher , classcode, progressgoal)
                     VALUES ('$classname', '$teacher', '$courseCode', '$progressGoal')";
                    $duplicate = mysqli_query($con, "SELECT * from classdata WHERE classname = '$classname'");
                    if (mysqli_num_rows($duplicate)>0){
                        echo "<div class='form'>
                              <h3>Class already exists.</h3><br/>
                              <p class='link'>Click here to <a href='createClass.php'>try again</a></p>
                              </div>"; 
                    } else{
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        echo "<div class='form'>
                              <h3>You have successfully created the class!</h3><br/>
                              <p class='link'>Click here to return to <a href='../dashboard.php'>Dashboard</a></p>
                              </div>";
                    } 
                    else {
                        echo "<div class='form'>
                              <h3>Required fields are missing.</h3><br/>
                              <p class='link'>Click here to <a href='createClass.php'>try again</a>.</p>
                              </div>";
                        }
                    }
                }
            }
        }      
     else {
?>
    <form class="form" method="post" name="createClass">
        <h1 class="post-title">Create a Class</h1>
        <input type="text" class="post-input" name="classname" placeholder="Class Name" autofocus="true"/>
        <input type="submit" value="Create" name="submit" class="login-button"/>
        <p class="link"><a href="../dashboard.php">Return Back</a></p>
  </form>
<?php
    }
?>
</body>
</html>