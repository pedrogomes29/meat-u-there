<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/restaurants.php");
    output_header("restaurants",array("restaurants"));
?>
<h1 id="pageTitle">Restaurants</h1>
<menu>
    <ul id="searchOptions">
        <li>
            <h3>Average review score</h3>
            <span id="searchByReviewScore">
                <div class="slider">
                    <div class="range"></div>
                    <input class='slideBar min' type="range" min="0" max="100" value="0" step="1" >
                    <input class='slideBar max' type="range" min="0" max="100" value="100" step="1">
                    <div class="minScore">0</div>
                    <div class="maxScore">100</div>
                </div>
            </span>
        </li>

        <li id="searchByPrice">
            <h3>Price Range</h3>
            <div class='prices'>
                <button class = "price 0" type="radio">
                €
                </button>
                <button class = "price 1" type="radio">
                €€
                </button>
                <button class = "price 2" type="radio">
                €€€
                </button>
                <button class = "price 3" type="radio">
                €€€€
                </button>
            </div>
        </li>

        <li id="sortBy">
            <h3>Sort By</h3>
            <label>
                <input class="sort sortByName" type="radio" checked name="sort">
                Name (default)
            </label>
            <br>
            <label>
                <input class = "sort sortByRating" type="radio" name="sort">
                Rating
            </label>
            <br>
            <label>
                <input class = "sort sortByMostPopular" type="radio" name="sort">
                Most popular
            </label>
        </li>
    </ul>
    <ul id="restaurants">
    </ul>
</menu>



