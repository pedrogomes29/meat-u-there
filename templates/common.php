<?php
    function output_header($style_file){
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="styles/<?=$style_file?>.css">
        </head>
        <body>
            <header>
                <nav>
                    <ul>
                        <li><h1><a href="restaurants.php">Meat U There</a></h1></li>
                        <li id="search_bar">
                            <input type="text" placeholder="Search for Restaurants">
                        </li>
                        <li>
                            <button id="cart">
                                Cart
                            </button>
                        <li>
                        <?php if(isset($_SESSION['username'])) {?>
                        <li>
                            <a id="button" href="profile.php">
                                Profile
                            </a>
                        </li>
                        <?php }
                                else {?>
                            <a id="button" href="login.php">
                                Login/Register
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