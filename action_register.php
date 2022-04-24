<?php
    session_start();                                         // starts the session
    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    if (!findUser($_POST['username'])){
        registerUser($_POST['username'],$_POST['password'],$_POST['address'],$_POST['phoneNumber']);
    }

    header('Location: register.php');         // redirect to the page we came from
?>