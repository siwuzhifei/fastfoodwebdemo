<?php
session_start();
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
        $_SESSION['availcreatemsg'] = "New record update successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connnection->error;
    }
}
$connnection->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <div class="card-header">
        <h4 >Delete when you are NOT available to work</h4>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['availcreatemsg'])) {
                echo $_SESSION['availcreatemsg'];
                unset($_SESSION['availcreatemsg']);
            }
            ?>
        <form action="availDelete.php" method="POST">
        <div>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <button type="submit" name="AvailableDelete-btn" class="btn btn-primary">Delete</button>
                    </th>
                    <th>DateTimeFrom</th>
                    <th>DateTimeTo</th>
                    <th>StaffID</th>
                    <th>Title</th>
                    <th>RosterID</th>

                </tr>
            </thead>
            <tbody>
                <?php

                // Create connection
                $connnection = new mysqli("localhost", "root", "", "fastfood_xc");

                // Check connection
                if ($connnection->connect_error) {
                    die("Connection failed: " ). $connnection->connect_error;
                }

            if ( $_SERVER['REQUEST_METHOD'] == 'GET'){
                    // GET method: show the data of the staff
                    if (!isset($staffID)){
                        die("get staffid failed: " ). $connnection->connect_error;
                      //header("Location: /XCfastfood/index2.php");
                      //exit;
                    };
                }

             
                    //  RoleID is 3 or 4, display all staff details
                    $new_sql = "SELECT av.AvailabilityID,av.dateTimeFrom,av.dateTimeTo,av.staffID,role.name, av.rosterID FROM availability as av	
                    JOIN staff on staff.staffID = av.staffID
                    JOIN role on role.roleID =staff.roleID
                    order by rosterID,staffID";
         
                // Read all row from database table
                $new_result = $connnection->query($new_sql);

                // don't seem to work
                if (empty($new_result)) {
                    echo "No data found";
                    header("Location: /XCfastfood/index.php");
                    exit; 
                }
                
                if ($new_result->num_rows > 0) {
                // output data of each row
                   foreach($new_result as $row) {
                ?>
                    <tr>
                    <td>
                    <input type='checkbox' name='availability_delete[]' value="<?=$row['AvailabilityID'];?>">
                    </td>
                    <td><?=$row['dateTimeFrom'];?></td>
                    <td><?=$row['dateTimeTo'];?></td>
                    <td><?=$row['staffID'];?></td>
                    <td><?=$row['name'];?></td>
                    <td><?=$row['rosterID'];?></td>

                    </tr> 
                    
                <?php 
                ?>
                <!--ensure that staffID is passed to the availability2.php via hidden input type-->
                <input type="hidden" name="hiddenID" value="<?=$row['AvailabilityID'];?>">    
                <?php

                }
                }
                ?>
            </tbody>
        </table>
        </div>
            <div class="row mb-3">
                <!-- <div class="col-sm-3 offset-sm-3 d-grid">
                    <button type="submit" name="AvailableDelete-btn" class="btn btn-primary">Save</button>
                </div> -->
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/XCfastfood/index2.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    </div>
    <script>https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js</script>
</body>
</html>