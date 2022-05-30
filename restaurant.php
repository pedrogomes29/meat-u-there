<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/users.php");
    require_once("database/restaurants.php");
    output_header("restaurant");
    $db=getDatabaseConnection();
    $restaurant_info = getRestaurant($db,$_GET['id']);
    $restaurant_categories = getRestaurantMenu($db,$_GET['id']);
?>
<div id="restaurant_header">
    <img id="header_image" src="imgs/restaurant_<?=$restaurant_info["idRestaurant"]?>.jpg" alt="restaurant_image">
    <h1 class="restaurant_name"><?=$restaurant_info["name"]?></h1>
    <p>📍Location: <?=$restaurant_info["address"]?></p> 
</div>
<menu>
<h2>Menu</h2>
    <ul>
    <?php foreach(array_keys($restaurant_categories) as $restaurant_category){ ?>
            <ul><h1><?=$restaurant_category?></h1>
                <?php foreach($restaurant_categories[$restaurant_category] as $item){?>
                <li>
                    <a href="edit_dish.php?dish_id=<?=$item['idDish']?>&restaurant_id=<?=$_GET['id']?>">
                        <img src="imgs/restaurants/<?=$_GET['id']?>/thumbs_medium/<?=getImageId($db,$item['name'],$_GET['id'])?>.jpg" alt="<?=$item['name']?>">
                    </a>
                    <p><?=$item['name']."--".$item['price']."€"?></p>
                    <form action="action_add_to_cart.php" method="post">
                        <input type="hidden" value=<?=$item['idDish']?> name="dish_id">
                        <input type="hidden" value=<?=$restaurant_info['idRestaurant']?> name="restaurant_id">
                        <button  id="add_cart" type="submit"> 
                            <img  src="imgs/add_to_cart.png" alt="plus sign">
                        </button>
                    </form>
                </li>
                <?php } ?>
            <ul>
        <?php } ?>
    </ul>
    <?php if (getUserInfo($db)['idUser'] == $restaurant_info['owner']){?>
        <a class="add_dish" href="add_dish.php?restaurant_id=<?=$_GET['id']?>">
        Add dish to <br> your restaurant.</a>
    <?php } ?>
</menu>

<?php
    output_footer();
?>  