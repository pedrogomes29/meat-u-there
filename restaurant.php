<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/users.php");
    require_once("database/restaurants.php");
    output_header("restaurant");
    $db=getDatabaseConnection();
    $restaurant_info = getRestaurant($db,$_GET['id']);
    $restaurant_menu = getRestaurantMenu($db,$_GET['id']);
?>
<div class="restaurant_info">
<h1 class="restaurant_name"><?=$restaurant_info["name"]?></h1>
<img src="imgs/hamburger_background" alt="restaurant_image">
<p>📍Location: <?=$restaurant_info["address"]?></p>
</div>
<menu>
<h2>Menu</h2>
    <ul>
    <?php foreach($restaurant_menu as $item){ ?>
            <li>
                <a href="edit_dish.php?dish_id=<?=$item['idDish']?>">
                    <img src="imgs/restaurants/<?=$_GET['id']?>/original/<?=getImageId($db,$item['name'],getMenuId($db,$_GET['id'])['idMenu'])?>.jpg" alt="<?=$item['name']?>">
                </a>
                <br>
                <p><?=$item['name']."--".$item['price']."€"?></p>
            </li>
        <?php } ?>
    </ul>
    <?php if (getUserInfo($db)['idUser'] == $restaurant_info['owner']){?>
        <a class="add_dish" href="add_dish.php?restaurant_id=<?=$_GET['id']?>&menu_id=<?=getMenuId($db,$_GET['id'])['idMenu']?>">
        Add dish to <br> your restaurant.</a>
    <?php } ?>
</menu>

<?php
    output_footer();
?>  