<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  edit_dish($db,$_POST["name"],$_POST["price"],$_POST["id_dish"]);
  update_image($db,$_POST["name"],$restaurant_id);
  header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
?>