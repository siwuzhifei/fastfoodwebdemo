<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anthony Fast Food</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2 >List of Staff</h2>
        <div class="row mb-3">
                <div class="col-sm-3 offset-sm-3 d-grid">
                <a class="btn btn-primary" href="/XCfastfood/create.php" role="button">New Staff</a>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/XCfastfood/index2.php" role="button">Back to Homepage</a>
                </div>
            </div>
        
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>StaffID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Date Of Birth</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Password</th>
                    <th>RoleID</th>

                </tr>
            </thead>
           
            <tbody>
                <?php
                session_start();

                //print_r($_SESSION);
               $staffID = $_SESSION['staffID'] ;
               $roleID = $_SESSION['roleID'];

            // Create connection
                $connnection = new mysqli("localhost", "root", "", "fastfood_xc");

            // Check connection
            if ($connnection->connect_error) {
                die("Connection failed: " ). $connnection->connect_error;
                }

                // Display data based on RoleID
                if ($roleID == 3 || $roleID == 4) {
                    // If RoleID is 3 or 4, display all staff details
                    $sql = "SELECT * FROM staff";
                } else {
                    // If RoleID is not 3 or 4, display only the user's details
                    $sql = "SELECT * FROM staff where staff.staffID = $staffID";
                }
         
                $result = $connnection->query($sql);

                if (!$result) {
                    die('Invalid query: ' . $connnection->error);
                }
                // output data of each row
                while($row = $result->fetch_assoc()) {
                echo"
                    <tr>
                    <td>$row[staffID]</td>
                    <td>$row[name]</td>
                    <td>$row[address]</td>
                    <td>$row[dateOfBirth]</td>
                    <td>$row[email]</td>
                    <td>$row[mob]</td>
                    <td>$row[password]</td>
                    <td>$row[roleID]</td>
                    
                    <td>
                        <a class='btn btn-primary btn-sm' href='/XCfastfood/edit.php?staffID=$row[staffID]' role='button'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/XCfastfood/delete.php?staffID=$row[staffID]' role='button'>Delete</a>
                        <a class='btn btn-success btn-sm' href='/XCfastfood/availability.php?staffID=$row[staffID]' role='button'>Avalability</a> 
                    </td>
                    </tr>
                ";                
                }
            ?>
            </tbody>


    </div>
      
</body>
</html>