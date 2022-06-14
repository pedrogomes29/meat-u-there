<?php
  // Database connection
  require_once('database/connection.php');
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE') { 
    $body = file_get_contents('php://input'); //Be aware that the stream can only be read once
  }

  $arguments = explode('&',$body);


  $restaurantId = explode('=',$arguments[0])[1];
  $userId = explode('=',$arguments[1])[1];
  removeRestaurantLike($db,$restaurantId,$userId);

  echo json_encode("Success!");
?>