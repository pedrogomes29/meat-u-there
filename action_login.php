<?php
    session_start();                                         // starts the session
    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    if (userExists($_POST['username'], $_POST['password'])){  // test if user exists
        $_SESSION['username'] = $_POST['username'];            // store the username
        echo("Login succesfull!");
    }
    else{
        echo("Username:" . $_POST['username']);  
          
        echo("Password:" . $_POST['password']);

        // redirect to the page we came from
    }
?>