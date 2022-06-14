<?php
    session_start(); 
    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        header("Location: restaurants.php");
      }
                                              // starts the session
    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries
   

    $db = getDatabaseConnection();

    if (!findUser($db,$_POST['username'])){
        registerUser($db,$_POST['username'],$_POST['password'],$_POST['address'],$_POST['phoneNumber']);
        header('Location: login.php');
    }
    else{
        header('Location: register.php?register_failed=true');
    }

?>