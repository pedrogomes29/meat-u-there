<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/users.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    $db=getDatabaseConnection();

    if (getUserInfo($db)['idUser'] == $restaurant_info['owner'])
        header("Location: restaurant.php?id=".$_GET["restaurant_id"]);
    output_header("edit_dish");
    $dish_info = getDishInfo($db,$_GET['dish_id']);  
    ?>     
    <form action="action_edit_dish.php" method="post" enctype=multipart/form-data>
        <label> Dish name:
            <input type="text" name="name" value="<?=$dish_info["name"]?>">
        </label>
        <label> Dish price:
            <input type="number" name="price" value=<?=$dish_info["price"]?>>
        </label>
        <input type="hidden" value=<?=$_GET['dish_id']?> name="dish_id">
        <input type="hidden" value=<?=$_GET['restaurant_id']?> name="restaurant_id">
        <label> Dish image:
            <input type="file" name="image">
        </label>
        <button name="button" type="submit">Edit dish</button>
    </form>
<?php
    output_footer();
?>  