<?php
  // Database connection
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();

  if(!dishCategoryExists($db,$_POST["new_dish_category"],$_POST["restaurant_id"])){
    add_dish_category($db,$_POST["restaurant_id"],$_POST["new_dish_category"]);
    header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
  }
  else
    header("Location: add_dish_category.php?restaurant_id=".$_POST["restaurant_id"]."&invalid_category=true");
?>