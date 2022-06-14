<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    output_header("restaurants",array("restaurants"));
?>
<h2>Restaurants</h2>
<menu>
    <ul>
        <li>
            <h3>Search by average review score</h3>
            <label>
                <input class = "check 0" type="checkbox" name="avg">
                0
            </label>
            <label>
                <input class = "check 25" type="checkbox" name="avg">
                25
            </label>
            <label>
                <input class = "check 50" type="checkbox" name="avg">
                50
            </label>
            <label>
                <input class = "check 75" type="checkbox" name="avg">
                75
            </label>
            <label>
                <input class = "check 100" type="checkbox" name="avg">
                100
            </label>
        </li>
    </ul>
    <ul id="restaurants">
    </ul>
</menu>


