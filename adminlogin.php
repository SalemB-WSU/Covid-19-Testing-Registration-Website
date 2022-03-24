<?php
//database connection
include_once 'assets/conn/dbconnect.php';

//starting clinic sessios
//Only allowing the  correct user to see the information
session_start();
if (isset($_SESSION['doctorSession']) != "") {
header("Location: clinic/doctordashboard.php");
}

//Checking the username and password of the admin to make sure it's correct
if (isset($_POST['login']))
{
$doctorId = mysqli_real_escape_string($con,$_POST['doctorId']);
$password  = mysqli_real_escape_string($con,$_POST['password']);
$res = mysqli_query($con,"SELECT * FROM doctor WHERE doctorId = '$doctorId'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
// echo $row['password'];


//Correct input confirmation
//incorrect input confirmation
//errorhandeling
if ($row['password'] == $password)
{
$_SESSION['doctorSession'] = $row['doctorId'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: clinic/doctordashboard.php");
} else {
?>
<script type="text/javascript">
    alert("Wrong input");
</script>
<?php
}
}
?>







<!DOCTYPE HTML>

<html>
<head>
<!-- Code for stlyle -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!-- linking the style sheets -->
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="assets/css/submit.css">
    <link rel="stylesheet" href="assets/css/account.css">
</head>
      
<header>
    <div class="hero-image">
        <!-- Link is the picture -->
        <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
</header>
      
<body>
    <div class="bf">
        <form class="form" role="form" method="POST" accept-charset="UTF-8">
            <label>username</label><br>
            <!-- Using the php input that was defined earlier in the code -->
            <input name="doctorId" type="text" placeholder="Doctor ID" required><br>
            <label>password</label><br>
            <!-- Using the php input that was defined earlier in the code -->
            <input name="password" type="password" placeholder="Password" required><br><br>
            <!-- Generic php input -->
            <button class="button3" type="submit" name="login">Login</button>
        </form>
    </div>

</body>
</html>