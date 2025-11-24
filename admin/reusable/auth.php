<?php
    session_start();

    function secure(){
        if (!isset($_SESSION['id'])) {
            header("Location: /assignment2/admin/login.php");
            exit();
        }
    }

?>
