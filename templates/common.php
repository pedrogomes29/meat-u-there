<?php
    function output_header($style_file){
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="styles/<?=$style_file?>.css">
        </head>
        <body>
            <header>
                <h1><a href="index.php">Meat U There</a></h1>
                <nav>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Restaurants">Restaurants</a></li>
                        <?php   if(isset($_SESSION['username'])) {?>
                        <li><a href="profile.php">Profile</a></li>
                        <?php }
                                else {?>
                        <li><a href="login.php">Profile</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </header>
    
    <?php }
    function output_footer(){?>
        </body>
    </html>
    <?php }