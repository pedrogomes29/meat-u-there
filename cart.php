<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/users.php");
    if(!isset($_SESSION["username"]))
        header("Location: login.php");
    output_header("cart");
    $db=getDatabaseConnection();
?> 