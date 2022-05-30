<?php
    session_start();
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    require_once("database/users.php");
    if(!isset($_SESSION["username"]))
        header("Location: login.php");
    $db=getDatabaseConnection();
    $user_info = getUserInfo($db);
    //createRequestState($db,$user_info["idUser"],$_POST["restaurant_id"],'received');
    //createRequest($db,0);
    header("Location: $_SERVER[HTTP_REFERER]");
?> 