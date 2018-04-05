<?php
//$servername = "kitmaerskline-maerskline.mysql.database.azure.com";
//$username = "username@kitmaerskline-maerskline";
//$password = "tung1234!";
//$dbName = "dbmaerskline";

$servername = "localhost";
$username = "username";
$password = "password";
$dbName = "dbmaerskline";

//$servername = "127.0.0.1:50271";
//$username = "azure";
//$password = "6#vWHD_$";
//$dbName = "dbmaerskline";

// Create connection
$conn = mysqli_connect($servername, $username, $password);


$TableList = array(
	"CREATE TABLE tbllogin(Username varchar(12) NOT NULL PRIMARY KEY, password varchar(32) NOT NULL, role char(1) NOT NULL, lastLogin datetime NOT NULL, status char(1) NOT NULL)",
	"CREATE TABLE tblagent(Username varchar(12) NOT NULL PRIMARY KEY, firstname varchar(12) NOT NULL, lastname varchar(32) NOT NULL, email varchar(32) NOT NULL, phonenum varchar(32) NOT NULL, dateRegister datetime)",
	"CREATE TABLE tblvesselschedule(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, vessel varchar(32) NOT NULL, harbor varchar(32) NOT NULL, terminal varchar(32) NOT NULL, departuredate datetime NOT NULL, arrivaldate dateTime NOT NULL, space INT NOT NULL, status char(1))",
	"CREATE TABLE tblbooking(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, vesselid INT NOT NULL, bookBy varchar(12) NOT NULL, dateCreate datetime NOT NULL, companyname varchar(32) NOT NULL, comcontact varchar(12) NOT NULL, comemail varchar(32) NOT NULL, comaddress varchar(100) NOT NULL, itemname varchar(32) NOT NULL, weight double NOT NULL, cargocapacity INT NOT NULL, status char(1) NOT NULL)",
);

function CreateTables($NewLink, $TableQueryList)
{
	foreach($TableQueryList as $TableQuery)
	{
		mysqli_query($NewLink, $TableQuery);
	}
}

if($conn)
	{
		$date = date("y/m/j G:i:s");
		$pass = md5("1234");
		//Choose Database
		if(mysqli_select_db($conn,$dbName))
		{
			CreateTables($conn, $TableList);
			$AddAdminQuery = "INSERT INTO tbllogin (Username, password, role, lastLogin, status) VALUES ('admin', '".$pass."', '9', '".$date."', '1')";
			$AddAdminResult = mysqli_query($conn, $AddAdminQuery);
		}
		else
		{
			$Query = "CREATE DATABASE ".$dbName;
			$Result = mysqli_query($conn, $Query);
			mysqli_select_db($conn,$dbName);
			CreateTables($conn, $TableList);
			$AddAdminQuery = "INSERT INTO tbllogin (Username, password, role, lastLogin, status) VALUES ('admin','".$pass."', '9', '".$date."', '1')";
			$AddAdminResult = mysqli_query($conn,$AddAdminQuery);
			if($Result)
				echo "<script>alert('Database created');</script>";
		}
	}

?>