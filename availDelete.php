<?php

 // Create connection
 $connnection = new mysqli("localhost", "root", "", "fastfood_xc");

if ($connnection->connect_error) {
    die("Connection failed: " . $connnection->connect_error);
}

if (isset($_POST['AvailableDelete-btn'])) {
    $selectedValues = $_POST['availability_delete'];
    $extractvalue = implode(",", $selectedValues);
    echo $extractvalue;
    $sql = "Delete from availability 
    WHERE AvailabilityID IN ($extractvalue)";
    $result = $connnection->query($sql);

    if ($result) {
        $_SESSION['availmessage'] = "Availability deleted successfully";
        header("Location: /XCfastfood/availability2.php");
    } else {
        echo "Error: " . $sql . "<br>" . $connnection->error;
    }
}
$connnection->close();

?>