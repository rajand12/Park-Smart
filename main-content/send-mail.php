<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

                $name = htmlentities("ParkSmart");
                $email = htmlentities("");
                $subject = htmlentities("Registered to ParkSmart");
                $body = htmlentities("Hello Rajan Welcome to ParkSmart. You have used this email to register to ParkSmart.");    
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'parksmart121@gmail.com';
                $mail->Password = '';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->isHTML(true);
                $mail->setFrom($email, $name);
                $mail->addAddress('');
                $mail->Subject = ("$subject");
                $mail->Body = $body;
                $mail->send();

                echo "Mail Sent";

?>
