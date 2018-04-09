<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>MaerskLine - View Agent List</title>
       <!-- <style type="text/css">
       body {
            background-image: url("images/background1.jpg");  
            background-repeat: no-repeat;     
        }
     </style>-->
       <script src="js/insight.js"></script>
     
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
       $searchQuery = "SELECT * FROM tblagent ORDER BY firstname, lastname ASC";
      

    $CheckResult = mysqli_query($conn, $searchQuery);
      //Retrieve Number Return
      if(mysqli_num_rows($CheckResult) > 0)
      {
        ?>
        
             <h1>Agent List</h1>
            
              <table class="table table-hover">
                <thead>
                <tr>
                  <th scope="col">No</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                </tr>
            </thead>
             <tbody>
        <?php
            for($i=0;$i<mysqli_num_rows($CheckResult);$i++)
            {
              $RecRow = mysqli_fetch_array($CheckResult);
              echo "<tr  class=\"clickable-row\">";
              echo "<th scope=\"row\">".($i+1)."</th>";
              echo "<td>".ucwords(strtolower($RecRow['firstname']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['lastname']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['Username']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['email']))."</td>";
              echo "<td>".ucwords(strtolower($RecRow['phonenum']))."</td>";
                          
            }
      }
      else
      {
        echo "<script>alert('No Registered Agent'); location='index.php'; </script>";
      }



?>
</tbody></table>

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
