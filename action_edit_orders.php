<?php
    // Database connection
    session_start();
    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        header("Location: restaurants.php");
      }
      
    require_once("templates/common.php");
    require_once("database/users.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    $db=getDatabaseConnection();
    $restaurant_info =  getRestaurant($db,$_POST['restaurant_id']);
    $restaurantRequests = getRestaurantRequests($db, $restaurant_info['idRestaurant']);
    if (getUserInfo($db)['idUser'] != $restaurant_info['owner'])
        header("Location: restaurant.php?id=".$_POST["restaurant_id"]);

    foreach($restaurantRequests as $request){
        $requestId = $request["idRequest"];
        $newRequestState = $_POST["state_".$requestId];
        updateState($db,$requestId,$newRequestState);
    }

    header('Location: edit_orders_state.php?restaurant_id='.$_POST["restaurant_id"]);
?>