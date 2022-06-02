<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();

  
  add_dish_category($db,$_POST["restaurant_id"],$_POST["new_dish_category"]);
  header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
?>