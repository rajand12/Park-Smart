<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
$message = "";
$error_message = "";    
include "database_configuration.php";
if($_POST){
        $fullName = $_REQUEST['full-name'];
        $user_email = $_REQUEST['email'];
        $contact = $_REQUEST['contact'];
        $userName = $_REQUEST['user-name'];
        $password = $_REQUEST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $checkUser = "SELECT `user_name` from `user_details` where user_name='$userName'";
        $userResult = mysqli_query($conn,$checkUser);
        $finalResult = mysqli_num_rows($userResult);
        if($finalResult>0){
            $error_message = "User name already exist try another";
        }
        else{
            $createUser = "INSERT into `user_details` (`full_name`,`email`,`contact`,`user_name`,`password`) VALUES ('$fullName','$user_email','$contact','$userName','$hashedPassword')";
            if(mysqli_query($conn,$createUser)){
                $message = ("User created successfully");
                $name = htmlentities("ParkSmart");
                $email = htmlentities($user_email);
                $subject = htmlentities("Registered to ParkSmart");
                $body = htmlentities("Welcome to ParkSmart.
                                    You have used this email to register to ParkSmart.
                                    Thankyou");    
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
                
            }
            else{
                $error_message = "Couldn't create user";
            }
        }
        mysqli_close($conn);
    }
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/registration-style.css" />
    <script src="../Script/registrationValidation.js"></script>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Register to Park Smart</title>
</head>

<body>
    <div id="login">
        <h1>Registration Form</h1>
        <div class="container">
            <form action="" method="POST" id="signUpForm" onsubmit="event.preventDefault();validation();">
            <label for="full-name">Full Name</label>
                <input type="text" id="full-name" placeholder="&#xf007;  Enter your full name" name="full-name">
                <span id="full-name-validation" class="error-message"></span>
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="&#xf0e0;  Enter your email" name="email">
                <span id="email-validation" class="error-message"></span>
                <label for="contact">Contact</label>
                <input type="number" id="contact" placeholder="&#xf10b;  Enter your contact number" name="contact">
                <span id="contact-validation" class="error-message"></span>
                <label for="user-name">User Name</label>
                <input type="text" id="user-name" placeholder="&#xf2c2;  Create a user name" name="user-name">
                <span id="user-name-validation" class="error-message"></span>
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="&#xf084;  Create a password" name="password">
                <span id="password-validation" class="error-message"></span>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" placeholder="&#xf00c;&#xf084;  Confirm your password" name="confirm-password">
                <span id="confirm-password-validation" class="error-message"></span>
                <span class="backend-error-message"><?= $error_message?></span>
                <span class="message"><?= $message?></span>
                <button type="submit">Register</button>
                <hr>
                <span style="text-align:center"><b>Already have an account</b></span>
                <a href="login.php"><button type="button">Proceed to Login</button></a>
            </form>
        </div>
    </div>
</body>
</html>
