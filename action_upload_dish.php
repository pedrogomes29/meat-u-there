<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();

  $db = getDatabaseConnection();
  if(!dishExists($db,$_POST["name"],$_POST["restaurant_id"])){
    $dish_id = add_dish($db,$_POST["name"],$_POST["price"],$_POST["restaurant_id"],$_POST["dishCategory"]);
    add_image($db,$_POST["restaurant_id"],$dish_id);
    header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
  }
  else{
    header("Location: add_dish.php?restaurant_id=".$_POST["restaurant_id"]."&invalid_name=true");
  }
?>