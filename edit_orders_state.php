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
    <form action="" method="post" enctype=multipart/form-data>
        <input type="hidden" value=<?=$_GET['restaurant_id']?> name="restaurant_id">
        <h2>Requests: </h2>
        <ul>
            <?php foreach($restaurantRequests as $request){?>
            <ul>
                <h3>Request:<?=$request['idRequest']?> User:<?=$request['idUser']?> State:
                    <select name="state">
                    <?php foreach($states as $state) {?>
                        <option value="<?=$request['orderState']?>" <?php if($request['orderState'] == $state) echo("selected");?>><?=$request['orderState']?></option> 
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
    </form>
<?php
    output_footer();
?>  