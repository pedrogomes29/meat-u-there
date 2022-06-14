<?php
  // Database connection
  require_once('database/connection.php');
  require_once('database/restaurants.php');
  session_start();
  $db = getDatabaseConnection();
  $dishIds = array();
  $returnStatement = getDishIds($db,$_GET["search"]);
  foreach($returnStatement as $row){
      array_push($dishIds,$row["idDish"]);
  }
  echo json_encode($dishIds);
?>