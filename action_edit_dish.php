<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  add_dish($db,$_POST["name"],$_POST["price"],$_POST["id_dish"]);
  header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
?>