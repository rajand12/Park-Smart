<?php
include 'database_configuration.php';
if($_GET){

$user_id =$_GET['id'];
$sql2 = "DELETE from `user_details` where `user_id` = $user_id";
if(mysqli_query($conn, $sql2)){
    
     echo 'User deleted successfully';
}

        else{
            echo "Couldn't delete user";       
        }
    
} 
?>    