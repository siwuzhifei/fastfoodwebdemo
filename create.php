
<?php

//https://www.youtube.com/watch?v=NqP0-UkIQS4&ab_channel=BoostMyTool
$servername = "localhost";
$username = "root";
$password = "";
$database = "fastfood_xc";

// Create connection
$connnection = new mysqli($servername, $username, $password, $database);

$staffID = "";
$name = "";
$address = "";
$dateOfBirth = "";
$email = "";
$mobile = "";
$password = "";
$roleID = "";

$errorMessage ="";
$successMessage="";



if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method: add new staff
    $staffID = $_POST['staffID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];
    $mobile = $_POST['mob'];
    $password = $_POST['password'];
    $roleID = $_POST['roleID'];


    do {
        if (empty($staffID) || empty($name) || empty($address) || empty($dateOfBirth) || empty($email) || empty($mobile) || empty($roleID)
    ){
            $errorMessage = "All fields are required";
            break;
        }

        // add new staff to database
        $sql = "insert into staff (staffID, name, address, dateOfBirth, email, mob, password, roleID)
                 values ('$staffID','$name', '$address', '$dateOfBirth', '$email', '$mobile', '$password', '$roleID')";
        $result = $connnection->query($sql);

        if (!$result) {
            trigger_error('Invalid query: ' . $connnection->error);
            break;
        }
        $staffID = "";
        $name = "";
        $address = "";
        $dateOfBirth = "";
        $email = "";
        $mobile = "";
        $password = "";
        $roleID = "";

        $successMessage = "Staff added successfully";

        header("Location: /fastfood/index.php");
        exit;

    } while (false);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anthony Fast Food</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2 >New Staff</h2>

        <?php
        if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>    

        <form method="POST">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">StaffID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="staffID" value="<?php echo $staffID;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Of Birth</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="dateOfBirth" value="<?php echo $dateOfBirth;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mobile</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mob" value="<?php echo $mobile;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="<?php echo $password;?>">
                </div>
            </div>            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">RoleID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="roleID" value="<?php echo $roleID;?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "
                <div class = 'row mb-3'>
                    <div class='col-sm-3 offset-sm-3'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="col-sm-3 offset-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/fastfood/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>

    </div>
</body>
</html>