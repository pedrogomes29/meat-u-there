<?php
    session_start();
    function getDatabaseConnection(){
        
        $db = new PDO('sqlite:database/database.db');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $db;
    }
?>