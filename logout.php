<?php
session_start();
session_destroy();
header("Location: /XCfastfood/login.php");
exit;
?>