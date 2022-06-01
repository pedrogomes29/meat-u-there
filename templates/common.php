<?php
    function output_header($style_file){
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="styles/common.css">
            <link rel="stylesheet" href="styles/<?=$style_file?>.css">
            <script type="text/javascript" src="templates/common.js" defer></script>
        </head>
        <body>
            <header>
                <nav>
                    <ul>
                        <li><h1><a href="restaurants.php">Meat U There</a></h1></li>
                        <li id="search_bar">
                            <input id="searchbar" name="searchbar" type="search" placeholder="Search for Restaurants" data-search>
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