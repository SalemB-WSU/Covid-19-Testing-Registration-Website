<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['patientSession'];

$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>

<?php
if (isset($_POST['submit'])) {
//variables
$patientFirstName = $_POST['patientFirstName'];
$patientLastName = $_POST['patientLastName'];
$patientDOB = $_POST['patientDOB'];
$patientGender = $_POST['patientGender'];
$patientPhone = $_POST['patientPhone'];
$patientEmail = $_POST['patientEmail'];
// mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
$res=mysqli_query($con,"UPDATE patient SET patientFirstName='$patientFirstName', patientLastName='$patientLastName', patientDOB='$patientDOB', patientGender='$patientGender', patientPhone=$patientPhone, patientEmail='$patientEmail' WHERE icPatient = '$usersession'");
// $userRow=mysqli_fetch_array($res);
header( 'Location: profile.php' ) ;
}
?>

<?php
$male="";
$female="";
if ($userRow['patientGender']=='male') {
$male = "checked";
}elseif ($userRow['patientGender']=='female') {
$female = "checked";
}
?>

<!DOCTYPE html>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

<head>
    <link rel="stylesheet" href="main.css" />  
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/account.css">
</head>
<title>Account</title>
       

<header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
</header>

<body>
  
  <div class="wrapper">
    <div class="bf">
	<section>
						
		<!-- form start -->
		<form action="<?php $_PHP_SELF ?>" method="post" >
			<table>
				<tbody>
					<tr>
						<td>First Name:</td>
						<td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow['patientFirstName']; ?>"  /></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow['patientLastName']; ?>"  /></td>
					</tr>

					<tr>
						<td>Date of Birth</td>
						<td><input type="text" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?>"  /></td>
					</tr>
					<!-- radio button -->
					<tr>
						<td>Gender</td>
						<td>
							<div class="radio">
								<label><input type="radio" name="patientGender" value="male" <?php echo $male; ?>>Male</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="patientGender" value="female" <?php echo $female; ?>>Female</label>
							</div>
						</td>
					</tr>
					<!-- radio button end -->
					
					<tr>
						<td>Phone number</td>
						<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
					</tr>
					</tbody>
					
				</table>
				
				
				
			</form>
    </section>
	</div>
</div>
</body>
</html>