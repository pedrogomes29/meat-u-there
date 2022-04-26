<?php
    session_start();
    require_once("database/users.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/login.css">
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
        <form action="action_login.php" method="post">
            <h2>Login</h2>
            <label >Username:
                <input type="text" name="username">
            </label>
            <br>
            <label>Password:
                <input type="password" name="password">
            </label>
            <br>
            <button name="button" type="submit">Login</button>
            <footer>
                <p>Don't have an account? <a href="register.php">Register!</a></p>
            </footer>
        </form>
        <br>
    </body>
</html>