<?php
    session_start();
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    require_once("database/users.php");
    if(!isset($_SESSION["username"]))
        header("Location: login.php");
    else{
        $db = getDatabaseConnection();
        $user_info = getUserInfo($db);
        createRequest($db,'received',$user_info["idUser"]);
        $requestId = $db->lastInsertId();
        foreach ($_SESSION["dishes"] as $dish){
            createRequestDish($db,$requestId, $dish);
        }
        $_SESSION["dishes"] = array();
        header("Location: restaurants.php");
    }
?> 