<?php
    session_start();
    require_once("templates/common.php");
    output_header("login");
?>      
    <form action="action_login.php" method="post">
        <h2>Login</h2>
        <?php if(isset($_SESSION["login_failed"]) && $_SESSION["login_failed"]){?>
            <p>Login failed, please try again</p>
        <?php } ?>
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
<?php
    output_footer();
?>  