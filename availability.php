

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
        <h2 >Availability</h2>
        <br>
        <form action="availUpdate.php" method="POST">
        <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Add</th>
                    <th>DateTimeFrom</th>
                    <th>DateTimeTo</th>
                    <th>StaffID</th>
                    <th>Title</th>
                    <th>RosterID</th>

                </tr>
            </thead>
            <tbody>
                <?php
                 $connnection = new mysqli("localhost", "root", "", "fastfood_xc");

                 // Check connection
                 if ($connnection->connect_error) {
                     die("Connection failed: " ). $connnection->connect_error;
                 }

            if ( $_SERVER['REQUEST_METHOD'] == 'GET'){
                    // GET method: show the data of the staff
                    if (!isset($_GET["staffID"])){
                      header("Location: /XCfastfood/index.php");
                      exit;
                    }
                    $staffID = $_GET["staffID"];
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
                    <td style="width:10 px;text-align;center;">
                    <input type='checkbox' name='availability_staff_add[]' value="<?=$row['rosterID'];?>">
                    </td>
                    <td><?=$row['dateTimeFrom'];?></td>
                    <td><?=$row['dateTimeTo'];?></td>
                    <td><?=$row['staffID'];?></td>
                    <td><?=$row['name'];?></td>
                    <td><?=$row['rosterID'];?></td>

                    </tr> 
                    
                <!-- ensure that staffID is also passed to availUpdate.php via hidden input type -->
                <input type="hidden" name="hiddenstaffID" value="<?=$row['staffID'];?>">
                <?php
                }
            }
            
            ?>
            </tbody>
        </table>
        </div>
            <div class="row mb-3">
                <div class="col-sm-3 offset-sm-3 d-grid">
                    <button type="submit" name="Availability_add_btn" class="btn btn-primary">Save</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/XCfastfood/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>

    </div>
    <script>https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js</script>
</body>
</html>