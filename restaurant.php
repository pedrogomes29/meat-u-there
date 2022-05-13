<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    output_header("restaurant");
    $db=getDatabaseConnection();
    $restaurant_info = getRestaurant($db,$_GET['id']);
    $restaurant_menu = getRestaurantMenu($db,$_GET['id']);
?>
<h1 class="restaurant_name"><?=$restaurant_info["name"]?></h1>
<img src="imgs/hamburger_background" alt="restaurant_image">
<p><?=$restaurant_info["address"]?></p>
<menu>
<h2>Menu</h2>
    <ul>
    <?php foreach($restaurant_menu as $item){ ?>
            <li><?php echo $item['name']."--".$item['price']; ?></li>
        <?php } ?>
    </ul>
</menu>

<?php
    output_footer();
?>  