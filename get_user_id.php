<?php
 require_once('database/users.php');
 require_once('database/connection.php');
 $db=getDatabaseConnection();
 echo json_encode(getUserInfo($db)['idUser']);
?>