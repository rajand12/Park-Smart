<?php
    require_once 'admin-nav.php';
    include "database_configuration.php";
    session_start();
    if(!isset($_SESSION['admin_details'])){
        header('location:login.php');
    }
    $sql = "DELETE from `booking_table` where `payment_status`=0 and `booking_status`=0";
    mysqli_query($conn,$sql);
?>

<div class="main_container">
        
        <div class="container">
            <div class="info">
                    Welcome to the admin dashboard of Park Smart. <br>
                    Navigate by clicking the sections on the left sidebar.
            </div>
            
        </div>
    </div>