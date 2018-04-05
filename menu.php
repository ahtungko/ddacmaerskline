 <?php
  session_start();
  date_default_timezone_set("Asia/Kuala_Lumpur");
  include "dbconnect.php";
  require 'preventsubmission.php';


?>

 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><img src="images/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
      if((isset($_SESSION['isLogin'])) == null)
      {
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Sign In <span class="sr-only">(current)</span></a>

      </li>
      <li class="nav-item">
        <a class="nav-link" href="aboutus.php">About Us</a>
      </li>
      <?php
      }
      else
      {
        if($_SESSION['Role'] == 9)
        {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Agent
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="agentregistration.php">Register Agent</a>
              <a class="dropdown-item" href="viewagentlist.php">View Agent List</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Schedule
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="defineschedule.php">Create Vessel Schedule</a>
              <a class="dropdown-item" href="viewschedule.php">View Schedule</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewbookingdetails.php">Confirmed Booking</a>

          </li>
          <?php
        }
        else if($_SESSION['Role'] == 1)
        {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Schedule Booking
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="agentviewschedule.php">Book Schedule</a>
              <a class="dropdown-item" href="agentviewbooking.php">View Booking</a>
            </div>
          </li>

          <?php
        }
      ?>
      <li class="nav-item">
        <a class="nav-link" href="aboutus.php">About Us</a>
      </li>
      
      <?php
      }
      ?>
      
    </ul>
    <?php
    if((isset($_SESSION['isLogin'])) == 1)
      {
      ?>
      <li class="form-inline my-2 my-lg-0">
        <b>Welcome, <?php echo $_SESSION['userName']; ?>  </b>  
      </li>
      <li class="form-inline my-2 my-lg-0">
        <b><a class="nav-link" href="logout.php">Log Out</a></b>  
      </li>
      <?php
      }
      ?>

  </div>
</nav>