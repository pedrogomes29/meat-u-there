<?php
    session_start();
    require_once("templates/common.php");
    output_header("add_dish");
?>      
    <form action="action_upload_dish.php" method="post" enctype=multipart/form-data>
        <label> Dish name:
            <input type="text" name="name">
        </label>
        <label> Dish price:
            <input type="number" name="price">
        </label>
        <input type="hidden" value=<?=$_GET["restaurant_id"]?> name="restaurant_id">
        <input type="hidden" value=<?=$_GET["menu_id"]?> name="menu_id">
        <label> Dish image:
            <input type="file" name="image">
        </label>
        <button name="button" type="submit">Add dish</button>
    </form>
<?php
    output_footer();
?>  