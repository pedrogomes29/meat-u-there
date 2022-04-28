<?php
    session_start();
    require_once('connection.php');
    function getRestaurant($db,$restaurant_id){
        $stmt = $db->prepare('SELECT *
                            FROM Restaurant
                            WHERE idRestaurant=:restaurant_id');
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt;
    }

    function getRestaurantMenu($db,$restaurant_id){
        $stmt = $db->prepare('SELECT Dish.name, Dish.price
        FROM Restaurant,Menu,Dish
        WHERE Menu.idRestaurant=Restaurant.idRestaurant AND Menu.idMenu = Dish.menu_id AND Restaurant.idRestaurant=:restaurant_id');
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }
?>