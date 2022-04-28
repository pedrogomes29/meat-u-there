<?php
    session_start();
    require_once("templates/common.php");
    output_header("register");
?>
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
<?php
    output_footer();
?>