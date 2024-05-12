<?php

 // Create connection
 $connnection = new mysqli("localhost", "root", "", "fastfood_xc");

if ($connnection->connect_error) {
    die("Connection failed: " . $connnection->connect_error);
}

if (isset($_POST['Availability_add_btn'])) {

    $selectedValues = $_POST['availability_staff_add'];
    $extractvalue = implode(",", $selectedValues);
    $avail_staffID = $_POST['hiddenstaffID'];
    // echo $extractvalue;
    // echo $avail_staffID;

    $sql = "INSERT INTO availability (dateTimeFrom, DateTimeTo, StaffID, rosterID) 
        SELECT r.dateTimeFrom, r.DateTimeTo, $avail_staffID, r.rosterID 
        FROM roster as r
                JOIN rosterrole on r.rosterID = rosterrole.rosterID 
                JOIN staff on staff.roleID = rosterrole.roleID
        WHERE r.rosterID IN ($extractvalue)
        AND staff.staffID = $avail_staffID";
    $result = $connnection->query($sql);
    if ($result) {
        echo "New record update successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connnection->error;
    }
}
$connnection->close();








?>