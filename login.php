<?php
    session_start();
    require_once("database/users.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/login.css">
    </head>
    <body>
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