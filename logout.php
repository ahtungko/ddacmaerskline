<?php
	session_start();
	require "dbconnect.php";

	$updatelastlogin = "UPDATE tbllogin SET lastLogin = '".$_SESSION['LogDT']."' WHERE Username = '".$_SESSION['userName']."'";

    $updateLastLogResult = mysqli_query($conn, $updatelastlogin);
        if($updateLastLogResult)
        {
        	session_destroy(); //destroy all the session
			header('Location: index.php');
        }
        else
        {
          echo "<script>alert('Logout Failed'); window.history.back(); </script>";
        }

?>