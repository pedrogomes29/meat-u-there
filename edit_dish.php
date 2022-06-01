<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/users.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    $db=getDatabaseConnection();
    $restaurant_info =  getRestaurant($db,$_GET['restaurant_id']);

    if (getUserInfo($db)['idUser'] != $restaurant_info['owner'])
        header("Location: restaurant.php?id=".$_GET["restaurant_id"]);
    output_header("edit_dish");
    $categories = getCategories($db);
    $dish_info = getDishInfo($db,$_GET['dish_id']);  
    ?>     
    <form action="action_edit_dish.php" method="post" enctype=multipart/form-data>
        <label> Dish name:
            <input type="text" name="name" value="<?=$dish_info["name"]?>">
        </label>
        <?php
        ?>
        <label> Dish category: 
            <select name="category">
            <?php
                foreach($categories as $category){?>
                    <option value="<?=getCategoryId($db,$category["name"])?>" <?php if(getCategoryId($db,$category["name"])==$dish_info["idCategory"]) echo("selected");?> ><?=$category["name"]?></option>
                <?php } ?>
            </select>
        </label>
        <label> Dish price:
            <input type="number" name="price" value=<?=$dish_info["price"]?>>
        </label>
        <input type="hidden" value=<?=$_GET['dish_id']?> name="dish_id">
        <input type="hidden" value=<?=$_GET['restaurant_id']?> name="restaurant_id">
        <label> Dish image:
            <input type="file" name="new_image">
        </label>
        <button name="button" type="submit">Edit dish</button>
    </form>
    <form action="action_remove_dish.php" method="post">
        <input type="hidden" value=<?=$_GET['dish_id']?> name="dish_id">
        <input type="hidden" value=<?=$_GET['restaurant_id']?> name="restaurant_id">
        <button name="button" type="submit">Remove dish</button>
    </form>
<?php
    output_footer();
?>  