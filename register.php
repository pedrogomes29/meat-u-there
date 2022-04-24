<?php
    session_start();
    require_once("database/users.php");
?>

<html>
    <body>
        <form action="action_register.php" method="post">
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
                <input type="number" name="phoneNumber">
            </label>
            <br>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>