<?php
  // Database connection
  require_once('database/connection.php');
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  if($_GET["sort"]=="sortByName")
    $restaurants = getRestaurantsSortByName($db,$_GET["search"],$_GET["minScore"],$_GET["maxScore"],$_GET["priceMagnitude"]);
  else if($_GET["sort"]=="sortByRating")
    $restaurants = getRestaurantsSortByReviewScore($db,$_GET["search"],$_GET["minScore"],$_GET["maxScore"],$_GET["priceMagnitude"]);
  else if($_GET["sort"]=="sortByMostPopular")
    $restaurants = getRestaurantsSortByLikes($db,$_GET["search"],$_GET["minScore"],$_GET["maxScore"],$_GET["priceMagnitude"]);
  echo json_encode($restaurants);
?>