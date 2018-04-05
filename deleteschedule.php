<?php
require "dbconnect.php";
	    if(isset($_GET['id']) == null)
        {
           echo "<script>alert('Missing ID..'); location='index.php'; </script>";
        }
        else
        {
          $id = mysqli_real_escape_string($conn, trim($_GET['id']));
          $updateStatus = "UPDATE tblvesselschedule SET status = 3 WHERE id = '".$id."'";
          $updateStatusResult = mysqli_query($conn, $updateStatus);
          if($updateStatusResult)
          {
           echo "<script>alert('Vessel Schedule Updated Succcessfully'); location='index.php'; </script>";
          }
          else
          {
            echo "<script>alert('Vessel Schedule Updated Failed'); location='index.php'; </script>";

          }



        }


?>