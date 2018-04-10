<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>MaerskLine - Vessel Schedule</title>
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
	
	  $departuredate = mysqli_real_escape_string($conn, trim($_POST['txtdepartureDate']));
	  $arrivaldate = mysqli_real_escape_string($conn, trim($_POST['txtArrivalDate']));

	  if($departuredate >= $arrivaldate)
	  {
	   	echo "<script>alert('The Arrival Date and Time cannot be Earlier than Departure Date And Time'); window.history.back();</script>";

	  }
	  else
	  {
	  	$Vessel = mysqli_real_escape_string($conn, trim($_POST['sVessel']));
	  	$Harbor = mysqli_real_escape_string($conn, trim($_POST['sHarbor']));
	  	$Terminal = mysqli_real_escape_string($conn, trim($_POST['sTerminal']));
	  	$Space = mysqli_real_escape_string($conn, trim($_POST['txtSpace']));

	  	$addVessel = "INSERT INTO tblvesselschedule(vessel, harbor, terminal, departuredate, arrivaldate, space, status) VALUES('".$Vessel."', '".$Harbor."', '".$Terminal."', '".$departuredate."', '".$arrivaldate."', '".$Space."', '1')";

	  	$addVesselResult = mysqli_query($conn, $addVessel);
	  	if($addVesselResult)
	  	{
	   		echo "<script>alert('Schedule Create Successfully'); location='defineschedule.php'</script>";
	  	}
	  	else
	  	{
	   		echo "<script>alert('Schedule Create Failed'); window.history.back();</script>";
	  	}


	  }


	 
        ?>
  <?php
      
  }
    
	else
	{
?>
	<section class="relative" style="top:42px">
		<div class="container-fluid">
    <h1 class="well">Create Vessel Schedule</h1>
	<form method="POST" >
  <div class="form-group">
    <label for="sVessel">Vessel Name</label>
   	<select id="sVessel" name="sVessel" class="form-control">
   		<option selected="selected">Altmark</option>
   		<option>Altona</option>
   		<option>Histria Azure</option>
   		<option>Osaka Express</option>
   		<option>Quinquereme</option>
   		<option>Torben Spirit</option>
   		<option>U-Sea Colonsay</option>
   		<option>U-Sea Saskatchewan</option>
   	</select>
  </div>
  <div class="form-group">
    <label for="sHarbor">Harbor</label>
   	<select id="sHarbor" name="sHarbor" class="form-control">
   		<option selected="selected">Boston Harbor</option>
   		<option>Osaka</option>
   		<option>Pearl Harbor</option>
   		<option>Plymouth Sound</option>
   		<option>Port Jackson</option>
   		<option>Provincetown Harbor</option>
   		<option>Keelung</option>
   		<option>Kaoshiung</option>
   	</select>
  </div>
    <div class="form-group">
    <label for="sTerminal">Terminal</label>
   	<select id="sTerminal" name="sTerminal" class="form-control">
   		<option selected="selected">Terminal SiChuang</option>
   		<option>Terminal 11</option>
   		<option>T67</option>
   		<option>Terminal PortJack</option>
   		<option>Terminal T45</option>
   		<option>Sky Terminal</option>
   		<option>Terminal Keeling</option>
   	</select>
  </div>
  <div class="form-group">
    <label for="txtdepartureDate">Estimate Departure Date and Time</label>
    <input type="datetime-local" class="form-control" id="txtdepartureDate" name="txtdepartureDate" required min="<?php echo date('Y-m-d\TH:i'); ?>" />
  </div>
  <div class="form-group">
    <label for="txtArrivalDate">Estimate Arrival Date and Time</label>
    <input type="datetime-local" class="form-control" id="txtArrivalDate" name="txtArrivalDate" required min="<?php echo date('Y-m-d\TH:i'); ?>" />
  </div>
  <div class="form-group">
    <label for="txtSpace">Space Available</label>
    <input type="number" class="form-control" id="txtSpace" name="txtSpace" placeholder="1" required min="1" step="1">
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
