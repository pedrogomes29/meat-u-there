<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    output_header("restaurants");
    $db=getDatabaseConnection();
    $restaurants = getRestaurants($db);
?>
<menu>
    <h2>Restaurants</h2>
    <ul>
    <?php foreach($restaurants as $item){ ?>
            <li>
            <a href="restaurant.php?id=<?=$item['idRestaurant']?>">
            <p><?=$item['name']." Adress: ".$item['category']?></p>
            </a>
            </li>
        <?php } ?>
    </ul>
</menu>