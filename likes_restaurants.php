<?php
    session_start();

    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/users.php");
    if(!isset($_SESSION["username"]))
        header("Location: restaurants.php");
    $db=getDatabaseConnection();
    $user_info = getUserInfo($db);
    output_header("likes_restaurants");
?>
    <?php $likes_restaurants = getLikedRestaurants($db,$user_info["idUser"])?>
    <?php foreach($likes_restaurants as $restaurant){?>
        <div class="restaurant">
            <a href="restaurant.php?id=<?=$restaurant["idRestaurant"]?>"><?=$restaurant['name']?></a>
        </div>
    <?php } ?>
<?php
    output_footer();
?>