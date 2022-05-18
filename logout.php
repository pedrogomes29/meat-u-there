<?php   
    session_start();
    session_destroy();
    header('Location: restaurants.php');         // redirect to the page we came from
?>