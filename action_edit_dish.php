<?php
  // Database connection
  session_start();


  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header("Location: restaurants.php");
  }

  require_once('database/restaurants.php');
  $db = getDatabaseConnection();

  if(getDishId($db,$_POST["name"],$_POST["restaurant_id"])==$_POST["dish_id"] || !dishExists($db,$_POST["name"],$_POST["restaurant_id"])){
    edit_dish($db,$_POST["name"],$_POST["price"],$_POST["dish_id"],$_POST["category"],$_POST["restaurant_id"]);
    update_image($db,$_POST["restaurant_id"],$_POST["dish_id"]);
    header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
  }
  else{
    header("Location: edit_dish.php?dish_id=".$_POST["dish_id"]."&restaurant_id=".$_POST['restaurant_id']."&invalid_name=true");
  }
?>