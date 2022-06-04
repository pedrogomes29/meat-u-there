<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/users.php");
    require_once("database/restaurants.php");
    require_once("database/connection.php");
    $db=getDatabaseConnection();
    $restaurant_info =  getRestaurant($db,$_GET['restaurant_id']);
    if ((getUserInfo($db)['idUser'] != $restaurant_info['owner'])||!isset($_SESSION['username']))
        header("Location: restaurant.php?id=".$_GET["restaurant_id"]);
    output_header("add_dish_category");
?>      
    <form action="action_add_dish_category.php" method="post">
            <input type="hidden" value=<?=$_GET['restaurant_id']?> name="restaurant_id">
            <label> New dish category:
                <input type="text" name="new_dish_category">
            </label>
            <button name="button" type="submit">Add dish category</button>
    </form>
<?php
    output_footer();
?>  
