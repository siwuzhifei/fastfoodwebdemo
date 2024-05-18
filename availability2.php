
<?php 
      session_start();

     //print_r($_SESSION);
    $staffID = $_SESSION['staffID'] ;
    $roleID = $_SESSION['roleID'];
    // if user did not login, this will re-direct to login page.
     if(!isset($_SESSION['staffID']) || (trim($_SESSION['staffID']) == '')) {
        header("location: login.php");
        exit();
       }
    


                      
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
            if (!empty($_SESSION['availmessage'])) {
                echo  $_SESSION['availmessage'];
                unset($_SESSION['availmessage']);
            }
            if (!empty($_SESSION['availcreatemsg'])) {
                echo  $_SESSION['availcreatemsg'];
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

                // Display data based on RoleID
                if ($roleID == 3 || $roleID == 4) {
                    // If RoleID is 3 or 4, display all staff details
                    $sql = "SELECT av.AvailabilityID,av.dateTimeFrom,av.dateTimeTo,av.staffID,role.name, av.rosterID FROM availability as av	
                    JOIN staff on staff.staffID = av.staffID
                    JOIN role on role.roleID =staff.roleID
                    order by rosterID, staffID";
                } else {
                    // If RoleID is not 3 or 4, display only the user's details
                    $sql = "SELECT av.AvailabilityID,av.dateTimeFrom,av.dateTimeTo,av.staffID,role.name, av.rosterID FROM availability as av	
                    JOIN staff on staff.staffID = av.staffID
                    JOIN role on role.roleID =staff.roleID
                    WHERE staff.staffID = $staffID
                    order by rosterID";
                }
               
                // Read all row from database table


                $result = $connnection->query($sql);

                // don't seem to work
                if (empty($result)) {
                    echo "No data found";
                    header("Location: /XCfastfood/index.php");
                    exit; 
                }
                
                if ($result->num_rows > 0) {
                // output data of each row
                   foreach($result as $row) {
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
        </form>
    </div>

    </div>
    <script>https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js</script>
</body>
</html>