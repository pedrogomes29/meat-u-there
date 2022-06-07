<?php
    session_start();
    require_once("database/connection.php");
    require_once("database/restaurants.php");

    function output_header($style_file,$script_files=array()){
        $db=getDatabaseConnection();
        $categories_restaurant = getRestaurants($db);
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="styles/common.css">
            <link rel="stylesheet" href="styles/<?=$style_file?>.css">
            <script type="text/javascript" src="templates/common.js" defer></script>
            <?php foreach($script_files as $script_file){?>
                <script type="text/javascript" src="<?=$script_file?>.js" defer></script>
            <?php } ?>
        </head>
        <body>
            <header>
                <nav>
                    <ul>
                        <a href="restaurants.php"><img class="logo" src="../imgs/logo.png" ></a>
                        <li id="search_bar">
                            <input  onclick="dropDownSearch()" id="searchbar" name="searchbar" type="search" placeholder="Search for Restaurants" data-search>
                                <div id="hidden_searchbar" class="search_bar_content">
                                    <ul>
                                        <?php if ($_SERVER['REQUEST_URI'] != "/restaurants.php"){
                                            foreach(array_keys($categories_restaurant) as $restaurant_category){ 
                                                foreach($categories_restaurant[$restaurant_category] as $restaurant){ ?>
                                                    <li class="restaurants <?=$restaurant['name']." Address: ".$restaurant['address']?>">
                                                    <a href="restaurant.php?id=<?=$restaurant['idRestaurant']?>">
                                                    <?=$restaurant['name']?>  <?=$restaurant['address']?>
                                                    </a>
                                                    </li>
                                            <?php }
                                            } 
                                        } ?>
                                    </ul>
                                </div>
                        </li>
                        <li>
                            <a href="cart.php">
                                <button id="cart">
                                    <img src="imgs/shopping-cart.png" alt="shopping car">
                                </button>
                            </a>
                        </li>
                        <?php if(isset($_SESSION['username'])) {?>
                        <li>
                            <div id="button" class="dropdown">
                                <button onclick="dropDownProfile()" href="profile.php" class="dropdown_button">
                                    Profile
                                </button>
                                <div id="hidden_dropdown" class="dropdown_content">
                                    <a href="profile.php">Profile</a>
                                    <a href="orders.php">Orders</a>
                                    <a href="logout.php">Logout</a>
                                </div>
                            </div>
                        </li>
                        <?php }
                                else {?>
                            <a id="button" href="login.php">
                                <button class="login_register">
                                    Login/Register
                                </button>
                            </a>
                        </li>  
                        <?php } ?>
                    </ul>
                </nav>
            </header>
    
    <?php }
    function output_footer(){?>
        </body>
    </html>
    <?php }