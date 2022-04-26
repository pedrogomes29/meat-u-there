<?php
    session_start();
    require_once("database/users.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/register.css">
    </head> 
    <body>
        <header>
            <h1><a href="index.php">Meat U There</a></h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Restaurants">Restaurants</a></li>
                    <li><a href="Profile">Profile</a></li>
                </ul>
            </nav>
        </header>
        <form action="action_register.php" method="post">
            <h2>Register</h2>
            <label class="field">Username:
                <input type="text" name="username">
            </label>
            <br>
            <label class="field">Password:
                <input type="password" name="password">
            </label>
            <br>
            <label class="field">Address:
                <input type="text" name="address">
            </label>
            <br>
            <label class="field">Phone number:
                <input type="tel" name="phoneNumber">
            </label>
            <br>
            <button type="submit">Register</button>
        </form>
    </body>
</html>