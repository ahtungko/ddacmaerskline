<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>MaerskLine - Agent Registration</title>
     <link rel="icon" href="images/favicon.ico">
       <script src="js/insight.js"></script>
    
  </head>
<body>
	<!-- Navigation -->
	<section id="navigation" class="dark-nav" style="top: 0px">
		<?php 
			include ('menu.php');
		?>
	</section>
	<!-- End Navigation Section -->
<?php 
    if(isset($_SESSION['isLogin']) == 1 && (($_SESSION['Role']) == 9))
    {
	if(isset($_POST['btnSubmit']))
	{
	
	  $username = mysqli_real_escape_string($conn, trim($_POST['txtUsername']));

	  $checkUsernameQuery = "SELECT COUNT(Username) AS RecNumber FROM tbllogin WHERE Username = '".$username."'";
	  
	  $checkUsernameQueryResult = mysqli_query($conn, $checkUsernameQuery);
	  $Row = mysqli_fetch_array($checkUsernameQueryResult);

	  if($Row['RecNumber'] > 0)
	  {
	   	echo "<script>alert('Username Found! Please Change Username! '); window.history.back();</script>";
	  }
	  else
	  {

	  //avoid special character
	  $firstName = mysqli_real_escape_string($conn, strtoupper(trim($_POST['txtFirstName'])));
	  $lastName = mysqli_real_escape_string($conn, strtoupper(trim($_POST['txtLastName'])));
	  $phoneNum = mysqli_real_escape_string($conn, trim($_POST['txtPhone']));
	  $email = mysqli_real_escape_string($conn, trim($_POST['txtEmail']));
	  $password = mysqli_real_escape_string($conn, trim($_POST['txtPassword']));
	  $newPassword = md5($password);
	 
	  

	  $Register = "INSERT INTO tbllogin(Username, password, role, lastLogin, status) VALUES('".$username."', '".$newPassword."', '1', '".date("Y-m-d G:i:s")."', '1')";
	  $RegistrationResult = mysqli_query($conn, $Register);
	  $RegisterPersonalInfo = "INSERT INTO tblagent(Username, firstname, lastname, email, phonenum, dateregister) VALUES('".$username."', '".$firstName."', '".$lastName."', '".$email."','".$phoneNum."', '".date("Y-m-d G:i:s")."')";
	  $RegistrationResult1 = mysqli_query($conn, $RegisterPersonalInfo);


    if($RegistrationResult && $RegistrationResult1)
    {  
	          	echo "<script>alert('Registration Success...'); location='index.php';</script>";

    }
	          else
	          {
	          	echo "<script>alert('Registration Failed...'); window.history.back();</script>";
	          }
        ?>
  <?php
      
  }
    }
	else
	{
?>

	<section class="relative" style="top:42px">
		<div class="container-fluid">
    <h1 class="well">Register New Agent</h1>
	<form method="POST" >
  <div class="form-group">
    <label for="txtFirstName">First Name</label>
    <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" required placeholder="Ko">
  </div>
  <div class="form-group">
    <label for="txtLastName">Last Name</label>
    <input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Ing Tung" required>
  </div>
  <div class="form-group">
    <label for="txtEmail">Email</label>
    <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="itko1993@gmail.com" required>
  </div>
  <div class="form-group">
    <label for="txtPhone">Phone Number</label>
    <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="0168688690" minlength="10" maxlength="12" pattern="[0-9]*" required>
  </div>
<div class="form-group">
    <label for="txtUsername">Username</label>
    <input type="text" class="form-control" id="txtUsername" name="txtUsername" placeholder="itko" required>
  </div>
  <div class="form-group">
    <label for="txtPassword">Password</label>
    <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="******" minlength="6" maxlength="12" required>
  </div>
  <input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Submit"/>

</form>
	</div>
    <div class="row"><h2>&nbsp;</h2></div>
	
</section>
<?php
	}
}
	else
{
        echo "<script>alert('Access Denied!'); location='index.php'; </script>";
}
		

include "footer.php";

?>

</body>
</html>
