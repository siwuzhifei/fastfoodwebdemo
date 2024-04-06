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
        <a class="btn btn-primary" href="/fastfood/create.php" role="button">New Staff</a>
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
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "fastfood_xc";

                // Create connection
                $connnection = new mysqli($servername, $username, $password, $database);

                // Check connection

                if ($connnection->connect_error) {
                    die("Connection failed: " . $connnection->connect_error);
                }
                // Read all row from database table
                $sql = "SELECT * FROM staff";
                $result = $connnection->query($sql);

                if (!$result) {
                    trigger_error('Invalid query: ' . $connnection->error);
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
                        <a class='btn btn-primary btn-sm' href='/fastfood/edit.php?staffID=$row[staffID]' role='button'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/fastfood/delete.php?staffID=$row[staffID]' role='button'>Delete</a>
                        <a class='btn btn-success btn-sm' href='/fastfood/availability.php?staffID=$row[staffID]' role='button'>Avalability</a> 
                    </td>
                    </tr>
                ";                
                }
               
            ?>


    </div>
      
</body>
</html>