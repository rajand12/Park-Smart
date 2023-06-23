<?php
    include "database_configuration.php";
    session_start();
    if(!isset($_SESSION['admin_details'])){
        header('location:login.php');
    }
?>
<div class="main_container">
        <?php require_once 'admin-nav.php';?>
        <div class="container">
            <div class="info">
                    <b>Username : </b>
                    <?= $_SESSION['admin_details']['full_name']; ?><br>
                    <b>E-mail : </b>
                    <?= $_SESSION['admin_details']['email']; ?><br>
                <b>Role:</b>  Admin
            </div>
            
        </div>
    </div>