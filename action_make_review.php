<?php
    session_start();                                         // starts the session
    require_once('database/connection.php');                 // database connection
    require_once('database/restaurants.php');                      // user table queries


    $db = getDatabaseConnection();

    add_review($db,$_POST["user_id"],$_POST["restaurant_id"],$_POST["score"],$_POST["description"]);
    header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
?>