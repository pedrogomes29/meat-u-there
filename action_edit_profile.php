<?php
    session_start();                                         // starts the session
    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    $db = getDatabaseConnection();// user table queries
    editUser($db,$_POST['userId'],$_POST['username'],$_POST['address'],$_POST['phoneNumber']);

    header('Location: login.php');
?>