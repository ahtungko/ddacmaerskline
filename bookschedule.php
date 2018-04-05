<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>MaerskLine - Book Vessel Schedule</title>
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
   if(isset($_SESSION['isLogin']) == 1 && (($_SESSION['Role']) == 1))
    {
        $id = mysqli_real_escape_string($conn, trim($_GET['id']));

        if($id == null)
        {
            echo "<script>alert('Missing ID..'); location='agentviewschedule.php';</script>";
        }
        else
        {
          if(isset($_POST['btnSubmit']))
          {
            $createBy = $_SESSION['userName'];
            $companyname = mysqli_real_escape_string($conn, trim($_POST['txtName']));
            $Contact = mysqli_real_escape_string($conn, trim($_POST['txtContact']));
            $email = mysqli_real_escape_string($conn, trim($_POST['txtEmail']));
            $Address = mysqli_real_escape_string($conn, trim($_POST['txtAddress']));
            $itemname = mysqli_real_escape_string($conn, trim($_POST['txtItem']));
            $weight = mysqli_real_escape_string($conn, trim($_POST['txtweight']));
            $cargo = mysqli_real_escape_string($conn, trim($_POST['txtCargo']));

            $checkSpace = "SELECT space FROM tblvesselschedule WHERE id = '".$id."'";
            $checkSpaceResult = mysqli_query($conn, $checkSpace);
            if(mysqli_num_rows($checkSpaceResult) > 0)
            {
              $RecRow = mysqli_fetch_array($checkSpaceResult);
              if($RecRow['space'] >= $cargo)
              {
                $insertQuery = "INSERT INTO tblbooking(vesselid, bookBy, dateCreate, companyname, comcontact, comemail, comaddress, itemname, weight, cargocapacity, status) VALUES ('".$id."', '".$createBy."', '".date("Y-m-d G:i:s")."', '".$companyname."', '".$Contact."', '".$email."', '".$Address."', '".$itemname."', '".$weight."', '".$cargo."','1')";
                $insertQueryResult = mysqli_query($conn, $insertQuery);
                if($insertQueryResult)
                {
                  $updateQuery = "UPDATE tblvesselschedule SET space = (space - '".$cargo."') WHERE id = '".$id."'";
                  $updateQueryResult = mysqli_query($conn, $updateQuery);
                  if($updateQueryResult)
                  {
                    echo "<script>alert('Schedule Booked Successfully..'); location='agentviewschedule.php';</script>";
                  }
                }
                else
                {
                  echo "<script>alert('Schedule Booked Failed..'); window.history.back();</script>";

                }

              }
              else
              {
                echo "<script>alert('Not Enough Space!'); window.history.back();</script>";
              }

            }
          }
          else
          {
            ?>
             <section class="relative" style="top:42px">
                <div class="container-fluid">
                  <h1 class="well">Customer Details</h1>
              <form method="POST" >
              <div class="form-group">
                <label for="txtName">Company Name</label>
                <input type="text" class="form-control" id="txtName" name="txtName" required placeholder="Nettium Sdn Bhd">
              </div>
              <div class="form-group">
                <label for="txtContact">Company Contact Number</label>
                <input type="text" class="form-control" id="txtContact" name="txtContact" placeholder="0168688690" minlength="10" maxlength="12" pattern="[0-9]*" required>
              </div>
              <div class="form-group">
                <label for="txtEmail">Company Email</label>
                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="itko1993@gmail.com" required>
              </div>
              <div class="form-group">
                <label for="txtAddress">Company Address</label>
                <input type="text" class="form-control" id="txtAddress" name="txtAddress" placeholder="Jalan Akau" required>
              </div>
                  <h1 class="well">Item Details</h1>

            <div class="form-group">
                <label for="txtItem">Item Name</label>
                <input type="text" class="form-control" id="txtItem" name="txtItem" placeholder="iPhone" required>
              </div>
              <div class="form-group">
                <label for="txtweight">Item Weight (Kg) </label>
                <input type="number" class="form-control" id="txtweight" name="txtweight" placeholder="1" min="1" step="0.1" required>
              </div>
              <div class="form-group">
                <label for="txtCargo">Cargo Capacity </label>
                <input type="number" class="form-control" id="txtCargo" name="txtCargo" placeholder="1" min="1" required>
              </div>
              <input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Submit"/>

            </form>
              </div>
            <div class="row"><h2>&nbsp;</h2></div>

              </section>

            <?php
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
