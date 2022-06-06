<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/users.php");
    require_once("database/restaurants.php");
    if(!isset($_SESSION["username"]))
        header("Location: login.php");
    output_header("cart");
    $db=getDatabaseConnection();
?> 
<menu>
    <h2>Shopping Cart</h2>
    <?php $total = 0; ?>
    <ul>
    <?php foreach($_SESSION["dishes"] as $key => $dish){
        if(!dish_exists($db,$dish)){
            unset($_SESSION["dishes"][$key]);
            continue;
        }
    ?>
        <?php $dish_price = getDishName($db,$dish)["price"]."€"?>
        <?php $total += $dish_price ?>
            <li class="dish <?=$dish?>">
                <a><p><?=getDishName($db,$dish)["name"]?>:<?=" ".$dish_price?></p></a>
            </li>
        <?php } ?>
    </ul>
    <p id="total">Total: <?=$total?> €</p>
    <form action="action_create_request.php" method="post">
        <?php if(sizeof($_SESSION["dishes"])>0){?>
        <button  id="Checkout" type="submit"> 
            Checkout
        </button>
        <?php } ?>
    </form>
</menu>