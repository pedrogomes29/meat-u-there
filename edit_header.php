<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/users.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    $db=getDatabaseConnection();

    if (getUserInfo($db)['idUser'] == $restaurant_info['owner'])
        header("Location: restaurant.php?id=".$_GET["restaurant_id"]);
    output_header("edit_header");

    ?>     
    <form action="action_edit_header.php" method="post" enctype=multipart/form-data>
        <input type="hidden" value=<?=$_GET['restaurant_id']?> name="restaurant_id">
        <label> Dish image:
            <input type="file" name="header">
        </label>
        <button name="button" type="submit">Edit header</button>
    </form>
<?php
    output_footer();
?>  