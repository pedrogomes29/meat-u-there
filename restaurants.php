<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    output_header("restaurants");
    $db=getDatabaseConnection();
    $categories_restaurant = getRestaurants($db);
?>
<menu>
    <h2>Restaurants</h2>
    <ul>
    <?php foreach(array_keys($categories_restaurant) as $restaurant_category){ ?>
            <ul id="Category"><h1><?=$restaurant_category?></h1>          
        <?php foreach($categories_restaurant[$restaurant_category] as $restaurant){ ?>
                <li class="restaurants <?=$restaurant['name']." Address: ".$restaurant['address']?>">
                    <a href="restaurant.php?id=<?=$restaurant['idRestaurant']?>">
                    <p><?=$restaurant['name']?> <br>Address: <?=$restaurant['address']?></p>
                    </a>
                </li>
        <?php }
        } ?>
    </ul>
</menu>