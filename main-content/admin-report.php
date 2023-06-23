<?php
include "database_configuration.php";
session_start();
if (!isset($_SESSION['admin_details'])) {
    header('location:login.php');
}
$query = "SELECT * from `booking_table` where `payment_status`= 0";
$query_result = mysqli_query($conn, $query);
$query2 = "SELECT * from `booking_table` where `payment_status`= 1";
$query_result2 = mysqli_query($conn, $query2);
$i = 1;
?>
<div class="main_container">
    <?php require_once 'admin-nav.php'; ?>
    <div class="container">
        <div class="info">

        <table>
            <caption>Booking Without Payment</caption>
            <tr>
                <th>S No.</th>
                <th>Full Name</th>
                <th>Vehicle No.</th>
                <th>Slot Name</th>
                <th>Date</th>
                <th>Arrival Time</th>
                <th>Departure Time</th>
                <th>Price</th>

            </tr>
            <?php

            while ($query_row = mysqli_fetch_array($query_result)) {

            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $query_row['full_name'];     ?>
                    <td><?php echo $query_row['vehicle_no'];    ?>
                    <td><?php echo $query_row['slot_name'];     ?>
                    <td><?php echo $query_row['booked_date'];          ?>
                    <td><?php echo $query_row['arrival_time'];  ?>
                    <td><?php echo $query_row['departure_time']; ?>
                    <td><?php echo $query_row['price'];         ?>
                </tr>
            <?php
                $i++;
            }

            ?>
        </table>

        <table>
            <caption>Booking With eSewa Payment</caption>
            <tr>
                <th>S No.</th>
                <th>Full Name</th>
                <th>Vehicle No.</th>
                <th>Slot Name</th>
                <th>Date</th>
                <th>Arrival Time</th>
                <th>Departure Time</th>
                <th>Price</th>

            </tr>
            <?php

            while ($query_row2 = mysqli_fetch_array($query_result2)) {

            ?>
                <tr>
                    <?php $i=1;?>
                    <td><?php echo $i ?></td>
                    <td><?php echo $query_row2['full_name'];     ?>
                    <td><?php echo $query_row2['vehicle_no'];    ?>
                    <td><?php echo $query_row2['slot_name'];     ?>
                    <td><?php echo $query_row2['booked_date'];          ?>
                    <td><?php echo $query_row2['arrival_time'];  ?>
                    <td><?php echo $query_row2['departure_time']; ?>
                    <td><?php echo $query_row2['price'];         ?>
                </tr>
            <?php
                $i++;
            }

            $conn->close();

            ?>
        </table>

    </div>
    
</div>