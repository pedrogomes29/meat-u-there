<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/users.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    $db=getDatabaseConnection();

    $restaurant_info = getRestaurant($db,$_GET['restaurant_id']);
    $categories = getRestaurantCategories($db);

    if ((getUserInfo($db)['idUser'] != $restaurant_info['owner']) || !isset($_SESSION['username']))
        header("Location: restaurant.php?id=".$_GET["restaurant_id"]);

    output_header("edit_header");

    ?>     
    <form action="action_edit_restaurant.php" method="post" enctype=multipart/form-data>
        <label> Restaurant name:
            <input type="text" name="name" value="<?=$restaurant_info["name"]?>">
        </label>
        <label> Restaurant Address:
            <input type="text" name="address" value="<?=$restaurant_info["address"]?>">
        </label>
        <label> Restaurant category: 
            <select name="category">
            <?php
                foreach($categories as $category){?>
                    <option value="<?=getRestaurantCategoryId($db,$category["name"])?>" <?php if(getRestaurantCategoryId($db,$category["name"])==$restaurant_info['idRestaurantCategory']) echo("selected");?> ><?=$category["name"]?></option>
                <?php } ?>
            </select>
        </label>
        <input type="hidden" value=<?=$_GET['restaurant_id']?> name="restaurant_id">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <label> Header image:
            <input type="file" name="header">
        </label>
        <button name="button" type="submit">Edit Information</button>
    </form>
<?php
    output_footer();
?>  