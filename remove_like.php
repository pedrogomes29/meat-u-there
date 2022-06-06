<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  print_r($_POST);
  removeLike($db,$_POST["dishId"],$_POST["userId"]);
  echo json_encode("Success!");
?>