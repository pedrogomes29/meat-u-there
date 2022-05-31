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
    <h2>Products Bought</h2>
    <?php $total = 0; ?>
    <ul>
    <?php foreach($_SESSION["dishes"] as $dish){ ?>
        <?php $dish_price = getDishName($db,$dish)["price"] ?>
        <?php $total += $dish_price ?>
            <li class="dish <?=$dish?>">
                <p><?=getDishName($db,$dish)["name"]?>--<?=$dish_price?></p>
            </li>
        <?php } ?>
    </ul>
    <p>Total: <?=$total?></p>
    <form action="action_create_request.php" method="post">
        <button  id="Checkout" type="submit"> 
            Checkout
        </button>
    </form>
</menu>