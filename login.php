<?php
  session_start();
  date_default_timezone_set("Asia/Kuala_Lumpur");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MaerskLine - Sign In</title>
     <link rel="icon" href="images/favicon.ico">

    <style type="text/css">
       body {
            background-image: url("images/background.jpg");       
        }
     </style>
       <script src="js/insight.js"></script>
     
    <?php require_once "dbconnect.php"; ?>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <?php
    if(isset($_SESSION['isLogin']) == null)
    {
    if(isset($_POST['btnLogin']))
    {
      $Username = mysqli_real_escape_string($conn, trim($_POST['txtUsername']));
      $Password = mysqli_real_escape_string($conn, trim($_POST['txtPassword']));
      $checkPass = md5($Password);
      $loginQuery = "SELECT COUNT(Username) AS RecNumber FROM tbllogin WHERE Username = '".$Username."' AND Password = '".$checkPass."' AND status = '1'";
      $loginQueryResult = mysqli_query($conn, $loginQuery);
      $Row = mysqli_fetch_array($loginQueryResult);
      if($Row['RecNumber'] > 0)
      {
        $RoleQuery = "SELECT Username, role, lastLogin FROM tbllogin WHERE Username = '".$Username."'";
        $RoleQueryResult = mysqli_query($conn, $RoleQuery);
        $Row = mysqli_fetch_array($RoleQueryResult);
        $loginName = $Row['Username'];
        $Role = $Row['role'];
        $LoginDT = date("Y-m-d H:i:s");
        
        
        $_SESSION["isLogin"] = 1;
        $_SESSION["Role"] = $Role;
        $_SESSION["LogDT"] = $LoginDT;
        $_SESSION['userName'] = $loginName;
        
        echo "<script>location = \"index.php\";</script>";
      }
      else
      {
        echo "<script>alert('Invalid Username or Password!'); window.history.back();</script>";
      }

    }
    else
    {
    ?>



    <form class="form-signin" method="POST">
      <a href="index.php"><img class="mb-4" src="images/logo.png" alt="" width="200" height="60"></a>
      <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
      <label for="inputUsername" class="sr-only">Username</label>
      <input type="text" id="txtUsername" name="txtUsername" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnLogin" id="btnLogin">Sign in</button>
      <p class="mt-5 mb-3 text-muted">Copyright &copy; 2018 Ko Ing Tung</p>
    </form>
    <?php
      }
    }
      else
      {
        echo "<script>location = \"index.php\";</script>";

      }
    ?>
     <?php
    include "footer.php";
  ?>
  </body>
</html>
