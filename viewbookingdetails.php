<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>MaerskLine - Vessel Schedule</title>
  <!--      <style type="text/css">
       body {
            background-image: url("images/background1.jpg");  
            background-repeat: no-repeat;     
        }
     </style>-->
     <link rel="icon" href="images/favicon.ico">
     
  </head>
<body>
	<!-- Navigation -->
	<section id="navigation" class="dark-nav" style="top: 0px">
		<?php 
			include ('menu.php');
		?>
	</section>
	<!-- End Navigation Section -->

  <section class="relative" style="top:42px">
    <div class="container-fluid">
      <?php
      if(isset($_SESSION['isLogin']) == 1 && (($_SESSION['Role']) == 9))
      {
       $searchQuery = "SELECT * FROM tblvesselschedule WHERE status = '1' ORDER BY departuredate, arrivaldate ASC";
      

    $CheckResult = mysqli_query($conn, $searchQuery);
      //Retrieve Number Return
      if(mysqli_num_rows($CheckResult) > 0)
      {
        ?>
        
             <h1>Schedule List</h1>
            <form method="get" action="viewvesselbookingdetail.php">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th scope="col">No</th>
                    <th scope="col">Vessel Name</th>
                    <th scope="col">Harbor</th>
                    <th scope="col">Terminal</th>
                    <th scope="col">Departure Date and Time</th>
                    <th scope="col">Arrival Date and Time</th>
                    <th scope="col">Space</th>
                    <th scope="col">Manage</th>
                    <!--<th scope="col">&nbsp;</th>-->
                </tr>
            </thead>
             <tbody>
        <?php
            for($i=0;$i<mysqli_num_rows($CheckResult);$i++)
            {
              $RecRow = mysqli_fetch_array($CheckResult);
              echo "<tr  class=\"clickable-row\">";
              echo "<th scope=\"row\">".($i+1)."</th>";
              echo "<td>".ucwords(strtolower($RecRow['vessel']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['harbor']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['terminal']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['departuredate']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['arrivaldate']))."</td>";
              echo "<td>".$RecRow['space']."</td>";
              echo  "<td><button type=\"submit\" class=\"btn btn-sm btn-info\" id=\"id\" name=\"id\" value=\"$RecRow[id]\">View Booking</button></td>";

                          
            }
      }
      else
      {
        echo "<script>alert('No Upcoming Schedule'); location='index.php'; </script>";
      }



?>
</tbody></table></form>

    <?php

}
else
{
        echo "<script>alert('Access Denied!'); location='index.php'; </script>";
}
    ?>
  </div>
  </section>


  <?php
    include "footer.php";
  ?>

</body>
</html>
