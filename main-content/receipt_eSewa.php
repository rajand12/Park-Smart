<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Report</title>
    <style>
    div {
  background-color: lightgrey;
  width: 25%;
  border: 7px solid green;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 10px;
  padding-bottom: 10px;
  /* margin: 3px; */
  margin-left:35%;
}
body {
            background-image: url("../Images/background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        button{
          background-color:rgb(20, 148, 105);
          height:40px;
          width:50%;
          color:white;
          margin-left:25%;
          margin-top:8%;
          margin-bottom:5%;
        }
        i{
          color:purple;
        }
        a{
          font-size:larger;
          /* margin-top:5%; */
          text-decoration:none;
          font-weight:bolder;
          margin-left:30%;
          
        }
</style>
</head>
<body>
<div>
<h3>Name:  <i><?= $_SESSION['user_details']['full_name']?></i></h3>
<h3>Email:  <i><?= $_SESSION['user_details']['email']?></i></h3>
<h3>Date:  <i><?= $_SESSION['date']?></i></h3>
<h3>Vehicle Number:  <i><?= $_SESSION['vehicle_num']?></i></h3>
<h3>Arrival Time:  <i><?=$_SESSION['arrival_time']?></i></h3>
<h3>Departure Time:  <i><?= $_SESSION['departure_time']?></i></h3>
<h3>Booked Slot:  <i><?=$_SESSION['slot_name']?></i></h3>
<h3>Price:  <i><?= $_SESSION['price']?></i></h3>
<h3>Mode of Payment:  <i>Paid through eSewa</i></h3>

<?php  

$name = htmlentities("ParkSmart");
$email = htmlentities($_SESSION['user_details']['email']);
$subject = htmlentities("Parking Slot Booked");
$body = htmlentities("Hello user.
                      You have booked the parking slot " .$_SESSION['slot_name'] ' from '.$_SESSION['arrival_time'].' to'.$_SESSION['departure_time']
                      .'Thank you'
                    );    
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'parksmart121@gmail.com';
$mail->Password = 'smnnzezbarhqpvxt';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->isHTML(true);
$mail->setFrom($email, $name);
$mail->addAddress($email);
$mail->Subject = ("$subject");
$mail->Body = $body;
$mail->send();

?>

<button onclick="window.print();return false;">Save as PDF</button>
<br>
<a href="http://localhost/Park-Smart/main-content/after-login.php">Return to Home</a>
</div>
</body>
</html>


<!-- <?php 
    // unset($_SESSION['arrival_time']);
    // unset($_SESSION['departure_time']);
    // unset($_SESSION['slot_name']);
    // unset($_SESSION['date']);
    // unset($_SESSION['price']);
    // unset($_SESSION['slot_id']);
    // unset($_SESSION['vehicle_num']);
?> -->

<!-- <button onclick="window.print();return false;">Save as PDF</button> -->