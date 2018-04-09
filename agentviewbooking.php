<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>MaerskLine - View Schedule</title>
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
   if(isset($_SESSION['isLogin']) == 1 && (($_SESSION['Role']) == 1))
    {
       $searchQuery = "SELECT * FROM tblvesselschedule, tblbooking WHERE tblvesselschedule.id = tblbooking.vesselid AND bookBy = '".$_SESSION['userName']."' ORDER BY departuredate, arrivaldate ASC";
      

    $CheckResult = mysqli_query($conn, $searchQuery);
      //Retrieve Number Return
      if(mysqli_num_rows($CheckResult) > 0)
      {
        ?>
          
             <h1>Confirmed Booking List</h1>
              <form method="get" action="bookschedule.php">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th scope="col">No</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Company Contact Number</th>
                    <th scope="col">Vessel Name</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Departure Date and Time</th>
                    <th scope="col">Arrival Date and Time</th>
                    <th scope="col">Harbor</th>
                    <th scope="col">Terminal</th>
                    <th scope="col">Cargo Capacity</th>
                </tr>
            </thead>
             <tbody>
        <?php
            for($i=0;$i<mysqli_num_rows($CheckResult);$i++)
            {
              $RecRow = mysqli_fetch_array($CheckResult);
              echo "<tr  class=\"clickable-row\">";
              echo "<th scope=\"row\">".($i+1)."</th>";
              echo "<td>".ucwords(strtolower($RecRow['companyname']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['comcontact']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['vessel']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['itemname']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['weight']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['departuredate']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['arrivaldate']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['harbor']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['terminal']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['cargocapacity']))."</td>";
                          
            }
      }
      else
      {
        echo "<script>alert('No Upcoming Schedule'); location='index.php'; </script>";
      }
    }
    else
    {
        echo "<script>alert('Access Denied!'); location='index.php'; </script>";

    }




  ?>




 

  <?php
    include "footer.php";
  ?>

</body>
</html>
