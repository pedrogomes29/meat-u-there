<?php
  // Database connection

  session_start();
  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header("Location: restaurants.php");
  }
  require_once('database/restaurants.php');
  
  $db = getDatabaseConnection();
  if(!dishHasOrders($db,$_POST["dish_id"])){
    removeDish($db,$_POST["dish_id"]);
    $imageId = getImageId($db,$item['idDish']);
    $fileName = "imgs/restaurants/".$_POST['restaurant_id']."/".$imageId.".jpg";
    if(file_exists($fileName)){
        unlink($filanme);
    }
    header("Location: restaurant.php?id=".$_POST["restaurant_id"]);
  }
  else{
    header("Location: edit_dish.php?dish_id=".$_POST["dish_id"]."&restaurant_id=".$_POST['restaurant_id']."&dish_has_orders=true");
  }
?>