<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('connection_db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $firstname = stripslashes($_REQUEST['firstname']);
        $firstname = mysqli_real_escape_string($con, $firstname);
        $lastname = stripslashes($_REQUEST['lastname']);
        $lastname = mysqli_real_escape_string($con, $lastname);
        $grade = stripslashes($_REQUEST['grade']);

        $query    = "INSERT into `userdata` (username, password,firstname, lastname, grade)
                     VALUES ('$username', '" . md5($password) . "', '$firstname', '$lastname', '$grade')";
        $duplicate = mysqli_query($con, "SELECT * from userdata WHERE username = '$username'");
        if (mysqli_num_rows($duplicate)>0){
            echo "<div class='form'>
                  <h3>Username is already taken.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>try again</a></p>
                  </div>"; 
        } else{
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } 
        else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
            }
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="password" class="login-input" name="password" placeholder="Password" >
        <input type="text" class="login-input" name="firstname" placeholder="First Name"  />
        <input type="text" class="login-input" name="lastname" placeholder="Last Name" />
        <input type="checkbox" name="grade" onclick="onlyOne(this)" value="Freshmen"checked>
        <label for="grade">Freshmen</label><br>
        <input type="checkbox" name="grade" onclick="onlyOne(this)" value="Sophomore">
        <label for="grade">Sophomore</label><br>
        <input type="checkbox" name="grade" onclick="onlyOne(this)" value="Junior">
        <label for="grade">Junior</label><br>
        <input type="checkbox" name="grade" onclick="onlyOne(this)" value="Senior">
        <label for="grade">Senior</label><br>
        <input type="checkbox" name="grade" onclick="onlyOne(this)" value="Teacher">
        <label for="grade">Teacher</label>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
<script src = "filter.js"></script>
</body>
</html>