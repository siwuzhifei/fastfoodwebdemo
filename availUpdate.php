<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "fastfood_xc";

// Create connection
$connnection = new mysqli($servername, $username, $password, $database);

if ($connnection->connect_error) {
    die("Connection failed: " . $connnection->connect_error);
}

if (isset($_POST['Availability_add'])) {

    $selectedValues = $_POST['availability_staff_add'];
    $extractvalue = implode(",", $selectedValues);
    $avail_staffID = $_SESSION['staffID'];

    $sql = "INSERT INTO availability (dateTimeFrom, DateTimeTo, rosterID, StaffID) 
        SELECT dateTimeFrom, DateTimeTo, rosterID, '$avail_staffID' 
        FROM roster 
        WHERE rosterID IN ($extractvalue);" ;
    $result = $connnection->query($sql);
    if ($result) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connnection->error;
    }
}
$connnection->close();








?>