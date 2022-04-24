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
            <label class="field">Username:
                <input type="text" name="username">
            </label>
            <br>
            <label class="field">Password:
                <input type="password" name="password">
            </label class="field">
            <br>
            <button name="button" type="submit">Submit</button>
        </form>
    </body>
</html>