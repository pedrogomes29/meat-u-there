<?php
    session_start();
    require_once("templates/common.php");
    output_header("upload_image");
?>      
    <form action="action_upload_image.php" method="post">
        <input 
        <input type="file" id="myFile" name="filename">
        <button name="button" type="submit">Submit</button>
    </form>
<?php
    output_footer();
?>  