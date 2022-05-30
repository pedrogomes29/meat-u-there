<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  if(!dishExists($db,$_POST["name"],$_POST["restaurant_id"])){
    edit_dish($db,$_POST["name"],$_POST["price"],$_POST["dish_id"],$_POST["category"],$_POST["restaurant_id"]);
    update_image($db,$_POST["restaurant_id"],$_POST["name"]);
    header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
  }
  else{
    header("Location: edit_dish.php?dish_id=".$_POST["dish_id"]."&restaurant_id=".$_POST['restaurant_id']."&invalid_name=true");
  }
?>