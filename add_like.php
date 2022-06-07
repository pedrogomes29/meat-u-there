<?php
  // Database connection
  require_once('database/connection.php');
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  addLike($db,$_POST["dishId"],$_POST["userId"]);
  echo json_encode("Success!");
?>