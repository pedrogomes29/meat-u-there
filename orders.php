<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    require_once("database/users.php");
    if(!isset($_SESSION["username"]))
        header("Location: login.php");
    output_header("orders");
    $db=getDatabaseConnection();
    $userInfo = getUserInfo($db,$_SESSION["username"]);
    $requests = getRequests($db,$userInfo['idUser']);
    
?>
<menu>
    <h2>Orders</h2>
    <ul>
    <?php foreach($requests as $request){ ?>
            <ul id="OrderNumber"><h1>OrderNumber: <?=$request['idRequest']?> -- <?=$request['orderState']?></h1>
                <?php $requestDishes = getRequestDishes($db,$request['idRequest'])?>
                <?php foreach($requestDishes as $dish){?>
                <li>
                    <?php $dishInfo = getDishInfo($db, $dish['idDish']) ?>
                    <p><?=$dishInfo['name']?>--<?=$dishInfo['price']?>€</p>
                </li>
                <?php } ?>
            <ul>
        <?php } ?>
    </ul>
</menu>