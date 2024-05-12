<?php
    session_start();

    //print_r($_SESSION);
   $staffID = $_SESSION['staffID'] ;
   $roleID = $_SESSION['roleID'];
   // if user is not admin, this will re-direct to login page.
    if($roleID !=3 && $roleID !=4) {
    echo "You are not authorised to view this page";
       exit();
      }

      //  if user did not login, this will re-direct to login page.
if (!isset($_SESSION['staffID']) || (trim($_SESSION['staffID']) == '')) {
    header("Location: login.php");
    exit();
}

 // Create connection
$connnection = new mysqli("localhost", "root", "", "fastfood_xc");
  // Check connection

  if ($connnection->connect_error) {
    die("Connection failed: " . $connnection->connect_error);
}


$staffID = "";
$name = "";
$address = "";
$dateOfBirth = "";
$email = "";
$mobile = "";
$password = "";
$roleID = "";

$userExistMessage = "";
$errorMessage ="";
$successMessage="";



if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method: add new staff to database
    $staffID = $_POST['staffID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];
    $mobile = $_POST['mob'];
    $password = $_POST['password'];
    $roleID = $_POST['roleID'];


    do {
    // check if staff already exists
     $sql1 = "select * from staff where staffID = '$staffID'";
     $sql2 = "select * from staff where email = '$email'";
     $result1 = $connnection->query($sql1);
     $result2 = $connnection->query($sql2);
        if ($result1->num_rows > 0|| $result2->num_rows > 0) {
            $userExistMessage = "Staff already exists, Check staffID or email";
            die($userExistMessage);
        }       
        if (empty($staffID) || empty($name) || empty($address) || empty($dateOfBirth) || empty($email) || empty($mobile) || empty($roleID)|| empty($password)
    ){
            $errorMessage = "All fields are required";
            die($errorMessage);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorEmailMessage = "Invalid email format";
            die($errorEmailMessage);
        }



        // add new staff to database
        $sql = "insert into staff (staffID, name, address, dateOfBirth, email, mob, password, roleID)
                 values ('$staffID','$name', '$address', '$dateOfBirth', '$email', '$mobile', '$password', '$roleID')";
        $result = $connnection->query($sql);
        // check query execution success
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

        header("Location: /XCfastfood/index.php");
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
                    <a class="btn btn-outline-primary" href="/XCfastfood/index2.php" role="button">Cancel</a>
                </div>
            </div>
        </form>

    </div>
    <script>https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js</script>
</body>
</html>