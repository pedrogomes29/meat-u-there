<?php
  // Database connection
  require_once('database/connection.php');
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  if (isset($_GET["search"]) && isset($_GET["min"]) && isset($_GET["max"]))
    $restaurants = getRestaurants($db,$_GET["search"],$_GET["min"],$_GET["max"]);
  else if(isset($_GET["search"]))
    $restaurants = getRestaurants($db,$_GET["search"],$_GET["min"],$_GET["max"]);
  else
    $restaurants = getRestaurants($db,"",0,100);
  echo json_encode($restaurants);
?>