<?php
include 'database_configuration.php';
if($_GET){
$user_id =$_GET['id'];
$sql2 = "UPDATE `user_details` SET `is_admin` = 1 where `user_id` = $user_id";
if(mysqli_query($conn, $sql2)){
    echo 'User role updated successfully';

        }else{
          echo "Couldn't update user";          
        }
   } 
?>    