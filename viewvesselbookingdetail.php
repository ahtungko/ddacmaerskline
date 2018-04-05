<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>MaerskLine - Confirmed Booking</title>
     <link rel="icon" href="images/favicon.ico">
       <script src="insight.js"></script>
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
      $id = mysqli_real_escape_string($conn, trim($_GET['id']));
      if($id == null)
        {
           echo "<script>alert('Missing ID..'); location='index.php'; </script>";
        }
        else
        {


      $searchQuery = "SELECT * FROM tblvesselschedule, tblbooking WHERE tblvesselschedule.id = tblbooking.vesselid AND tblbooking.vesselid = '".$id."' ORDER BY departuredate, arrivaldate ASC";
      

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
                    <th scope="col">Company Email</th>
                    <th scope="col">Company Adress</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Weight</th>
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
              echo "<td>".ucwords(strtolower($RecRow['comemail']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['comaddress']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['itemname']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['weight']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['cargocapacity']))."</td>";
                          
            }
      }
      else
      {
        echo "<script>alert('No Booking Details'); location='index.php'; </script>";
      }
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
