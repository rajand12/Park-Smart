<?php
    session_start();
    unset($_SESSION['admin_details']);
    header('location:login.php');
?>