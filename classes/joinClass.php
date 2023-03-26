<?php
//include auth_session.php file on all user panel pages
include("../allow_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Join a Class</title>
    <link rel="stylesheet" href="../post.css"/>
</head>
<body>
<?php
  
    require('../connection_db.php');
    // When form submitted, check and create user session.
    if (isset($_POST['classcode'])) {
        $classcode = stripslashes($_REQUEST['classcode']);
        $classcode = mysqli_real_escape_string($con, $classcode);
        $classQuery  = "SELECT * FROM `classdata` WHERE classcode='$classcode'";
        $classResult = mysqli_query($con, $classQuery);
        if($classResult){
            //add students to that class list    
            $userQuery  = "SELECT * FROM `userdata` WHERE username='" . $_SESSION['username'] . "'";
            $userResult = mysqli_query($con, $userQuery);
            if($userResult){   
                $userdata = mysqli_fetch_array($userResult);
                $classdata = mysqli_fetch_array($classResult);
                $username = $userdata['firstname']. " ". $userdata['lastname'];
                $usertype = $userdata['grade'];
                $classname = $classdata['classname'];
                if(empty($userdata['enrolled'])){
                    $enroll_query= "UPDATE userdata SET enrolled = CONCAT('$classname', enrolled ) WHERE username = '$username'";
                }else{
                    $enroll_query= "UPDATE userdata SET enrolled = CONCAT('$classname',',', enrolled ) WHERE username = '$username'";
                }
                if(empty($classdata['students'])){
                    $addStudentQuery= "UPDATE classdata SET students = CONCAT('$username', students ) WHERE classcode = '$classcode'";
                }else{
                    $addStudentQuery= "UPDATE classdata SET students = CONCAT('$username',',', students ) WHERE classcode = '$classcode'";
                }
                if($usertype != "Teacher" and str_contains($classdata['students'], $username) == false){
                    $enrollResult = mysqli_query($con, $enroll_query);
                    $addStudentResult = mysqli_query($con, $addStudentQuery);
                
                    if($enrollResult and $addStudentResult){
                        echo "<div class='form'>
                        <h3>You have successfully joined the class! </h3>";                  
                        echo "<p class='link'>Click here to return to <a href='../dashboard.php'>Dashboard</a></p>
                        </div>";
                    }else{
                        echo "enrollment went wrong.";
                    }
                }else{
                    echo "<div class='form'>
                    <h3>You are not a student, or you are already enrolled in this class!</h3><br/>
                    <p class='link'>Return to <a href='../dashboard.php'>Dashboard</a></p>
                    </div>";
                }
            }  else {echo "userdata not found";}        
        } else{ echo "class code not found.";}
    }    
     else {
?>
    <form class="form" method="post" name="joinClass">
        <h1 class="post-title">Create a Class</h1>
        <input type="text" class="post-input" name="classcode" placeholder="Class Code" autofocus="true"/>
        <input type="submit" value="Join" name="submit" class="login-button"/>
        <p class="link"><a href="../joinCreateClass.php">Return Back</a></p>
  </form>
<?php
    }
?>
</body>
</html>