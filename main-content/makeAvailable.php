<?php
include 'database_configuration.php';
if($_GET){
    $slot_id =$_GET['id'];
$sql = "UPDATE `slots` SET `slot_status` = 0 where `slot_id` = $slot_id";
if(mysqli_query($conn, $sql))
{
    echo "Status updated successfully";
}
else{
    echo "Couldn't change stauts";
}
}


?>