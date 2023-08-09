<?php
session_start();
include "database_configuration.php";
if (!isset($_SESSION['user_details'])) {
    header('location:login.php');
  } else { }  
  ?>
  <?php
    $payment_request_id = "PRID-" . rand(1, 1000000);
    $_SESSION['pri'] = $payment_request_id;
if (isset($_POST["moneyless"])) {
    $sql2 = "INSERT INTO `booking_table` (`slot_id`,`slot_name`,`user_id`,`full_name`,`vehicle_no`,`booked_date`,`arrival_time`,`departure_time`,`price`) 
    VALUES (" . $_SESSION['slot_id'] . ",'" . $_SESSION['slot_name'] . "'," . $_SESSION['user_details']['user_id'] . ",'" . $_SESSION['user_details']['full_name'] . "','" . $_SESSION['vehicle_num'] . "','" . $_SESSION['date'] . "','" . $_SESSION['arrival_time'] . "','" . $_SESSION['departure_time'] . "','" . $_SESSION['price'] . "');";
    if(mysqli_query($conn, $sql2)){
        // echo "hello";
        header('location:http://localhost/Park-Smart/main-content/receipt_no_eSewa.php');
    }
    
    
} if(isset($_POST["withmoney"])) {
    
    $sql = "INSERT INTO `booking_table` (`slot_id`,`slot_name`,`user_id`,`full_name`,`vehicle_no`,`booked_date`,`arrival_time`,`departure_time`,`price`,`payment_request_id`) 
      VALUES (" . $_SESSION['slot_id'] . ",'" . $_SESSION['slot_name'] . "'," . $_SESSION['user_details']['user_id'] . ",'" . $_SESSION['user_details']['full_name'] . "','" . $_SESSION['vehicle_num'] . "','" . $_SESSION['date'] . "','" . $_SESSION['arrival_time'] . "','" . $_SESSION['departure_time'] . "','" . $_SESSION['price'] . "','" . $payment_request_id . "');";
    mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/bootstrap.css">
    <script src="../Script/bootstrap.js"></script>
</head> -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='../CSS/after-login.css' />
    <title>Park Smart</title>
    <style>
        input[type=submit]{
            height:50px;
            width:30%;
            background-color:rgb(20, 148, 105);
            margin-bottom:2%;
            margin-left:35%;
            margin-top:3%;
            color:white;
        }
    </style>
</head>

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

    <body>
        <style>
            input{
                font-size: 20px;
            }
        </style>
        <form action="https://uat.esewa.com.np/epay/main" method="POST">
            <input value=" <?= $_SESSION['price'] ?>" name="tAmt" type="hidden">
            <input value="<?= $_SESSION['price'] ?>" name="amt" type="hidden">
            <input value="0" name="txAmt" type="hidden">
            <input value="0" name="psc" type="hidden">
            <input value="0" name="pdc" type="hidden">
            <input value="EPAYTEST" name="scd" type="hidden"><br>
            <input value="<?= $payment_request_id ?>" name="pid" type="hidden"><br>
            <input value="http://localhost/Park-Smart/main-content/success_page.php?q=su" type="hidden" name="su">
            <input value="http://localhost/Park-Smart/main-content/failure-page.php?q=fu" type="hidden" name="fu">
            <input type="submit" name="withmoney" value="Book From eSewa">
        </form>
        <!-- <form action="" method="POST">
    <input value="Submit" type="submit">
    

            </form> -->
        <form action="" method="POST">
            <!-- <button type="submit" name="moneyless" id="moneyless"class="btn btn-success">Book without Payment</button> -->
            <input type="submit" name="moneyless" value="Book without Payment">
        </form>
    </body>

</html>
<?php
// if(isset($_POST["withmoney"])){
//     echo 'with money ma ';
//     $url = "https://uat.esewa.com.np/epay/main";
//     $data =[
//         'amt'=> $_SESSION['price'] ,
//         'pdc'=> 0,
//         'psc'=> 0,
//         'txAmt'=> 0,
//         'tAmt'=> $_SESSION['price'],
//         'pid'=> $payment_request_id,
//         'scd'=> 'EPAYTEST',
//         'su'=>'http://localhost/Park-Smart/main-content/success_page.php?q=su',
//         'fu'=>'http://localhost/Park-Smart/main-content/failure-page.php?q=fu'
//     ];
//         $curl = curl_init($url);
//         curl_setopt($curl, CURLOPT_POST, true);
//         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//         $response = curl_exec($curl);
//         curl_close($curl);
//         echo 'with money ma ';
// }
?>