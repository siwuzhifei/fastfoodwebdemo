<?php
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

header("Location: /fastfood/index.php");
exit;

?>