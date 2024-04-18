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

if ( $_SERVER['REQUEST_METHOD'] == 'GET'){
    // GET method: show the data of the staff
    if (!isset($_GET["staffID"])){
      header("Location: /XCfastfood/index.php");
      exit;
    }
    $staffID = $_GET["staffID"];

    // Read all row from database table
    $sql = "SELECT * FROM staff where staffID = $staffID";
    $result = $connnection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row){
        header("Location: /XCfastfood/index.php");
        exit;
         }
        $name = $row['name'];
        $address = $row['address'];
        $dateOfBirth = $row['dateOfBirth'];
        $email = $row['email'];
        $mobile = $row['mob'];
        $password = $row['password'];
        $roleID = $row['roleID'];
         
}
else{
 // POST method: update the staff
    $staffID = $_POST['staffID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];
    $mobile = $_POST['mob'];
    $password = $_POST['password'];
    $roleID = $_POST['roleID'];

    do{
        if(empty($name) || empty($address) || empty($email) || empty($mobile) || empty($roleID)){
            $errorMessage = "All fields are required";
            break;
        }
        $sql = "Update staff set name = '$name', address = '$address', dateOfBirth = '$dateOfBirth', email = '$email', mob = '$mobile', password = '$password', roleID = '$roleID' where staffID = $staffID";
        $result = $connnection->query($sql);

        if (!$result) {
            trigger_error('Invalid query: ' . $connnection->error);
            break;
        }
        $successMessage = "Staff updated successfully";
        header("Location: /XCfastfood/index.php");
        exit;
    } while(false);
   
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
        <h2 >Update Staff</h2>

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

        <form method="post">
            <input type="hidden" name="staffID" value="<?php echo $staffID;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="int" class="form-control" name="name" value="<?php echo $name;?>">
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
                    <input type="text" class="form-control" name="dateOfBirth" value="<?php echo $dateOfBirth;?>">
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
            </div>            
            <div class="row mb-3">
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
                    <a class="btn btn-outline-primary" href="/XCfastfood/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>

    </div>
    <script>https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js</script>
</body>
</html>