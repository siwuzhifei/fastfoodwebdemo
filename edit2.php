<?php 
      session_start();

     //print_r($_SESSION);
    $staffID = $_SESSION['staffID'];
    $roleID = $_SESSION['roleID'];
    // if user did not login, this will re-direct to login page.
     if(!isset($_SESSION['staffID']) || (trim($_SESSION['staffID']) == '')) {
        header("location: login.php");
        exit();
       }

    if (!empty($_SESSION['updatemessage'])) {
        echo $_SESSION['updatemessage'];
        $_SESSION['updatemessage'] = "";}
                      
 // Create connection
 $connnection = new mysqli("localhost", "root", "", "fastfood_xc");
 // Check connection
 if ($connnection->connect_error) {
     die("Connection failed: " . $connnection->connect_error);
 }


if ( $_SERVER['REQUEST_METHOD'] == 'GET'){
    
    // Read all row from database table
    $sql = "SELECT * FROM staff where staffID = $staffID";
    $result = $connnection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row){
        //header("Location: /XCfastfood/index.php");
        die("Connection failed: " . $connnection->connect_error);
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
        $_SESSION['updatemessage'] = "Staff updated successfully";
        header("Location: /XCfastfood/edit2.php");
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
            <div class="row mb-3" style="display:none">
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