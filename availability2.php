
<?php 
      session_start();

     //print_r($_SESSION);
    $staffID = $_SESSION['staffID'] ;
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
        <h4 >Specify when you are available to work</h4>
        </div>
        <div class="card-body">
        <form action="availUpdate.php" method="POST">
        <div>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <button type="submit" name="AvailableUpdate-btn" class="btn btn-primary">Update</button>
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
               
                // Read all row from database table
                $sql = "SELECT roster.dateTimeFrom,roster.dateTimeTo,staff.staffID,role.name, roster.rosterID FROM rosterrole
                JOIN roster on roster.rosterID = rosterrole.rosterID 
                JOIN staff on staff.roleID = rosterrole.roleID
                JOIN role on role.roleID =staff.roleID
                WHERE staff.staffID = $staffID";

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
                    <input type='checkbox' name='availability_staff_add[]' value="<?=$row['rosterID'];?>">
                    </td>
                    <td><?=$row['dateTimeFrom'];?></td>
                    <td><?=$row['dateTimeTo'];?></td>
                    <td><?=$row['staffID'];?></td>
                    <td><?=$row['name'];?></td>
                    <td><?=$row['rosterID'];?></td>

                    </tr> 
                    
                <?php 
                ?>
                <!--ensure that staffIDis passed to the availability.php via hidden input type-->
                <input type="hidden" name="staffID" value="<?php echo $staffID?>">    
                <?php

                }
                }
                ?>
            </tbody>
        </table>
        </div>
            <div class="row mb-3">
                <div class="col-sm-3 offset-sm-3 d-grid">
                    <button type="submit" name="Availability_add" class="btn btn-primary">Save</button>
                </div>
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