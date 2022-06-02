<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();

  
  add_restaurant_header($_POST["restaurant_id"]);
  edit_restaurant_info($db,$_POST['name'],$_POST['address'],$_POST['category'],$_POST["restaurant_id"]);
  header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
?>