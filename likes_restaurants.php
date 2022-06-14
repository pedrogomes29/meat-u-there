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
<article>
    <h2>Liked Restaurants</h2>
    <?php $likes_restaurants = getLikedRestaurants($db,$user_info["idUser"])?>
    <ul>
    <?php foreach($likes_restaurants as $restaurant){?>
        <li class="restaurant">
            <a href="restaurant.php?id=<?=$restaurant["idRestaurant"]?>"><?=$restaurant['name']?></a>
        </li>
    <?php } ?>
    </ul>
</article>
<?php
    output_footer();
?>