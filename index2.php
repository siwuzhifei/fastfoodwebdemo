<?php

session_start();

//  if user did not login, this will re-direct to login page.
if (!isset($_SESSION['staffID']) || (trim($_SESSION['staffID']) == '')) {
    header("Location: login.php");
    exit();
}
?>
// Display data based on RoleID
                if ($userRoleID == 3 || $userRoleID == 4) {
                    // If RoleID is 3 or 4, display all staff details
                    $sql = "SELECT * FROM staff";
                } else {
                    // If RoleID is not 3 or 4, display only the user's details
                    $sql = "SELECT * FROM staff WHERE Name = '" . $user_profile['Name']. "'";
                }


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar for Fastfood Management System </title>
      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        /* Centering container */
        .MyDetails {
            position: absolute;
            top: 25%;
            left: 15%;
            text-align: left;
        } </style>
</head>
<body style="height:500px">
<div class="container">
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
          <a class="navbar-brand mb-0 h1" href="#">
            <img src="image\logo2.png" width="80" height="80">
          </a>
          <button 
          class="navbar-toggler" 
          type="button" 
          data-bs-toggle="collapse" 
          data-bs-target="#navbarNav" 
          aria-controls="navbarNav" 
          aria-expanded="false" 
          aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/XCfastfood/index2.php">
                  Home
                </a>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle"
                  role="button"
                  id="navbarDropdown" 
                  data-bs-toggle="dropdown"
                  aria-expanded="false"> 
                  Manage Staff
                </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdwon">
              <li><a class="dropdown-item" href="/XCfastfood/create2.php">Create</a></li>
              <li><a class="dropdown-item" href="/XCfastfood/edit2.php">Update</a></li>
              <li><a class="dropdown-item" href="/XCfastfood/delete2.php">Delete</a></li>
              </ul>
          </li>

              <li class="nav-item">
                <a class="nav-link" href="/XCfastfood/availability2.php">
                  Availablity
                </a>
              </li>
               <!-- 
              <li class="nav-item">
                <a class="nav-link" href="">
                  My Details
                </a>
              </li>
              -->
             <li class="nav-item">
                    <a class="nav-link" href="/XCfastfood/logout.php">Logout</a>
            </li>
            </ul>
            <!-- 
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
          </div>
        
      </nav>

</div>
  <br><br><br><br><br>
<div class='MyDetails'>
    <h1 style="color:blue;"> Welcome, <?php echo $_SESSION['name']; ?></h1>
    <p>Your Email is <?php echo $_SESSION['email'] ; ?></p>
    <p>Your staffID is <?php echo $_SESSION['staffID'] ; ?></p>
    <p>Your RoleID is <?php echo $_SESSION['roleID'] ; ?></p>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</html>