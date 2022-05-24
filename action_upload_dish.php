<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  add_dish($db,$_POST["name"],$_POST["price"],$_POST["menu_id"]);
  add_image($db,$_POST["restaurant_id"],$_POST["name"],$_POST["menu_id"]);
  header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
?>