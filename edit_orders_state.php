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


    $restaurantRequests = getRestaurantRequests($db, $restaurant_info['idRestaurant']);
    $states = getStates($db);
    output_header("edit_orders_state");
    ?>     
    <form action="action_edit_orders.php" method="post">
        <input type="hidden" value=<?=$_GET['restaurant_id']?> name="restaurant_id">
        <h2>Requests: </h2>
        <ul>
            <?php foreach($restaurantRequests as $request){?>
            <ul>
                <h3>Request:<?=$request['idRequest']?> User:<?=$request['idUser']?> State:<?=$request['orderState']?>
                    <select name="state_<?=$request['idRequest']?>">
                    <?php foreach($states as $state) {?>
                        <option value="<?=$state["name"]?>" <?php if($state["name"]==$request['orderState']) echo("selected");?> ><?=$state["name"]?></option>
                    <?php } ?>
                    </select>
                </h3>
                <?php $requestDishes = getRequestDishes($db,$request['idRequest'])?>
                <?php foreach($requestDishes as $dish){?>
                <li>
                    <?php $dishInfo = getDishInfo($db, $dish['idDish']) ?>
                    <p><?=$dishInfo['name']?>--<?=$dishInfo['price']?>€</p>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </ul>
        <button type="submit">Edit state</button>
    </form>
<?php
    output_footer();
?>  