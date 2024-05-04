<?php
session_start();

//print_r($_SESSION);
$roleID = $_SESSION['roleID'] ;
// if user did not login, this will re-direct to login page.
if($roleID!= 3) {
echo "You are not authorised to view this page";
//session_destroy();
//header("Location: /XCfastfood/login.php");
//header("location: login.php");
   exit();
  }

if (isset($_GET["staffID"])) {

    $staffID = $_GET["staffID"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "fastfood_xc";
    
    // Create connection
    $connnection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM staff WHERE staffID = $staffID";
    $result = $connnection->query($sql);
}



header("Location: /XCfastfood/index.php");
exit;

?>