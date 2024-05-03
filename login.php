<?php
// use to control login success/fail
$is_invalid = false;

// Create connection
$connnection = new mysqli("localhost", "root", "", "fastfood_xc");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

if($connnection->connect_error){
 die("Connection failed: " . $connnection->connect_error);
} 
    // read the row of the selected client from database table
    //$sql = "SELECT * FROM staff where email='$email'";
    // to avoid a sql injection attack, we should use the following:
    $sql = sprintf("SELECT * FROM staff WHERE email = '%s'", $connnection->real_escape_string($email));
    $stmt_result = $connnection->query($sql);
    if($stmt_result->num_rows > 0){
        $data = $stmt_result->fetch_assoc();
        if($password === $data['password']){
            session_start();
            $_SESSION['staffID'] = $data['staffID'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['roleID'] = $data['roleID'];

            header("Location: /XCfastfood/index2.php");
            exit;
        
        } 
    }
// if we reach this point, form is submitted, but email or password is invalid
    $is_invalid = true;
}
 
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      
    </head>
    <body>
        <div class="container vh-100">
            <div class="row justify-content-center h-100">
                    <div class="card w-25 my-auto">
                        <div class="card-header text-center bg-primary text-white">
                            <h2>Login Form</h2>
                        </div>
                        <?php if ($is_invalid) : ?>
                            <em>Invalid Login</em>
                            <?php endif; ?>
                        <div class="card-body">
                            <form action="login.php" method="POST">
                                <div class="form-group">
                                    <label for="username">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <small>&copy Anthony Fastfood</small></div>
                    </div>
            </div>
        </div>
    </body>
</html>
