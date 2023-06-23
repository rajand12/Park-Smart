<?php
include "database_configuration.php";
session_start();
$i = 0;
if (!isset($_SESSION['user_details'])) {
  header('location:login.php');
} ?>
<?php
$date = date("Y-m-d");
$user_id = $_SESSION['user_details']['user_id'];
$sql = "SELECT * FROM `booking_table` WHERE `user_id`= $user_id AND `booked_date`= '$date' AND `cancel_status`=0";
$run = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM `booking_table` WHERE `user_id`= $user_id AND `booked_date`!= '$date' AND `cancel_status`=0";
$run2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT * FROM `booking_table` WHERE `user_id`= $user_id AND `cancel_status`=1";
$run3 = mysqli_query($conn, $sql3);
$count = mysqli_num_rows($run);
$count2 = mysqli_num_rows($run2);
$count3 = mysqli_num_rows($run3);
if($_POST){
  $bookingId = $_POST['booking_id'];
  $cancelQuery = "UPDATE `booking_table` SET `cancel_status`=1 WHERE `booking_id`=$bookingId;";
  if(mysqli_query($conn,$cancelQuery)){
    echo '<script>alert("Booking Cancelled. Contact us if you have any problems with our service.");</script>';
            header("refresh: 0.5; url = http://localhost/park-smart/main-content/my-history.php");
        }
        else{
          echo '<script>alert("Something went wrong..");</script>';
        }
  }
if (!isset($_SESSION['user_details'])) {
  header('location:login.php');
} else { ?>
  <!DOCTYPE html>
  <html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel='stylesheet' href='../CSS/my-history.css' />
    <link rel='stylesheet' href='../CSS/after-login.css' />
    <title>Park Smart</title>
  </head>
  <style>
    p{
      background-color:white;
      color:red;
      font-size:larger;
      text-align:center;
      font-weight:bolder;
      padding:0.5%;
      margin:0.5%;
    }
    caption{
      color:red;
      font-weight:bolder;
      font-size:larger;
      background-color:white;
      padding:0.5%;
      margin:0.5%;
    }
    input[type=submit]{
      height:30px;
      width:100px;
      background-color:red;
      color:white;
      word-wrap: break-word;
    }
    table{
      margin:1%;
    }
  </style>
  <body>

    <nav>
      <img src="../Images/new-logo.png">
      <div id="overflow">
        <ul>

          <li><?= $_SESSION['user_details']['full_name'] ?>
            <ul>
              <li><a href="my-history.php">My History</a></li>
              <li><a href="user-logout.php">Logout</a></li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
    <div class="center-main-div">
      <div class="main-div">
        <?php  if($count==NULL){?>
          <p>No Bookings done today</p>
          <?php } else { ?>
        <table>
          <caption>Bookings Done Today</caption>
          <tr>
            <th>S.N</th>
            <th>Date</th>
            <th>Slot Name</th>
            <th>Arrival Time</th>
            <th>Departure Time</th>
            <th>Price</th>
            <th>Payment Method</th>
            <th>Action</th>
          </tr>

          <?php
          while ($result = mysqli_fetch_assoc($run)) {
            $i++; $id=$result['booking_id'];?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $result['booked_date'] ?></td>
              <td><?= $result['slot_name'] ?></td>
              <td><?= $result['arrival_time'] ?></td>
              <td><?= $result['departure_time'] ?></td>
              <td><?= $result['price'] ?></td>
              <td><?php 
                IF($result['payment_status']==0){
                  echo "Cash on checkout";
                }
                else{
                  echo "Paid through eSewa";
                }
              
              ?></td>
              <td><form id="cancellationForm" action="" method="POST" onsubmit="event.preventDefault();checkTime();">
                      <input type="hidden" value="<?= $result['booking_id'] ?>" name="booking_id">
                      <input type="hidden" value="<?= $result['arrival_time']?>" id="arrival_time">
                      <span id="error_msg"></span>
                      <input type="submit" value="Cancel Booking">
              </form></td>
            </tr>
          <?php } ?>

        </table>
        <?php } ?>

        <?php if($count2==NULL){ ?>
        <p>No past bookings</p>
        <?php } else {?>
        <table>
          <caption>Past Bookings</caption>
          <tr>
            <th>S.N</th>
            <th>Date</th>
            <th>Slot Name</th>
            <th>Arrival Time</th>
            <th>Departure Time</th>
            <th>Price</th>
            <th>Payment Method</th>
            <th>Action</th>
          </tr>

          <?php
          while ($result2 = mysqli_fetch_assoc($run2)) {
            $i++; $id=$result2['booking_id'];?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $result2['booked_date'] ?></td>
              <td><?= $result2['slot_name'] ?></td>
              <td><?= $result2['arrival_time'] ?></td>
              <td><?= $result2['departure_time'] ?></td>
              <td><?= $result2['price'] ?></td>
              <td><?php 
                if($result2['payment_status']==0){
                  echo "Cash on checkout";
                }
                else{
                  echo "Paid through eSewa";
                }
              
              ?></td>
              <td>NULL</td>
            </tr>
          <?php } ?>

        </table>
        <?php } ?>
        <?php  if($count3==NULL){?>
          <p>No Cancelled Bookings</p>
          
          <?php } else{ ?>
        <table>
          <caption>Cancelled Bookings</caption>
          <tr>
            <th>S.N</th>
            <th>Date</th>
            <th>Slot Name</th>
            <th>Arrival Time</th>
            <th>Departure Time</th>
            <th>Price</th>
            <th>Payment Method</th>
            <th>Action</th>
          </tr>

          <?php
          while ($result3 = mysqli_fetch_assoc($run3)) {
            $i++; $id=$result3['booking_id'];?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $result3['booked_date'] ?></td>
              <td><?= $result3['slot_name'] ?></td>
              <td><?= $result3['arrival_time'] ?></td>
              <td><?= $result3['departure_time'] ?></td>
              <td><?= $result3['price'] ?></td>
              <td><?php 
                if($result3['payment_status']==0){
                  echo "Cash on checkout";
                }
                else{
                  echo "Paid through eSewa";
                }
              
              ?></td>
              <td>NULL</td>
            </tr>
          <?php } ?>
          <?php } ?>

        </table>
      </div>
    </div>
  <?php } ?>

  <script>
          function checkTime(){
                  arrivalTime = document.getElementById("arrival_time").value;
                  const today = new Date();
                  var time = today.toLocaleTimeString();
                  time = convertTo24HrsFormat(time);
                  function convertTo24HrsFormat(time) {
                  const slicedTime = time.split(/(PM|AM)/gm)[0];

                      let [hours, minutes] = slicedTime.split(':');

                        if (hours === '12') {
                        hours = '00';
                        }

                let updateHourAndMin;

   function addition(hoursOrMin) {
      updateHourAndMin =
         hoursOrMin.length < 2
            ? (hoursOrMin = `${0}${hoursOrMin}`)
            : hoursOrMin;

      return updateHourAndMin;
   }

   if (time.endsWith('PM')) {
      hours = parseInt(hours, 10) + 12;
   }

   return `${addition(hours)}:${addition(minutes)}`;
}
          if(time<arrivalTime){
            isValid = true;
          }
          else{
            alert("Sorry! It seems you have gone past cancellation time..");
            // document.getElementById("error_msg").innerHTML = "Sorry! It seems you have gone past cancellation time..";
          }
          if(isValid){
            document.getElementById("cancellationForm").submit();
          }
          }
  </script>