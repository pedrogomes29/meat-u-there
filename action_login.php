<?php
    session_start();                                         // starts the session
    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');   
    

    $db = getDatabaseConnection();// user table queries

    if (userExists($db,$_POST['username'], $_POST['password'])){  // test if user exists
        $_SESSION['username'] = $_POST['username'];
        header('Location: restaurants.php');
    }
    else{
        header('Location: login.php?login_failed=true');
    }
?>