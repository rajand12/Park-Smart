<?php
include "database_configuration.php";
session_start();
if (!isset($_SESSION['admin_details'])) {
    header('location:login.php');
}?>

<?php 
    $message = null;
    $message2 =null;
    $query = "SELECT COUNT(*) AS bookingCount, SUM(price) AS totalBookedAmt
    FROM booking_table WHERE `cancel_status`=0 GROUP BY DATE(booked_date) ";
    $query2 = "SELECT COUNT(*) AS bookingCount, SUM(price) AS totalBookedAmt
    FROM booking_table WHERE `cancel_status`=0
    GROUP BY DATE_FORMAT(booked_date, '%Y-%m')";

?>
<?php 

if($_POST){

$daily_prediction = $_REQUEST["daily_prediction"];
$monthly_prediction = $_REQUEST["monthly_prediction"];
// Sample input data (x, y)
$runQuery = mysqli_query($conn,$query);
        if($runQuery)
        {
            $data = array();
        }
        while($row = mysqli_fetch_assoc($runQuery)){
                $data[] = $row;
                
        }
        // print_r($data);
        // exit();
        mysqli_free_result($runQuery);

// Calculate the sum of x, y, and x*y
$sumX = 0;
$sumY = 0;
$sumXY = 0;
$sumX2 = 0;
$sumY2 = 0;
$n = count($data);

foreach($data as $myData) {
    $x = $myData['bookingCount'];
    $y = $myData['totalBookedAmt'];
    
    $sumX += $x;
    $sumY += $y;
    $sumXY += $x * $y;
    $sumX2 += ($x * $x);
    $sumY2 += ($y * $y);
}

// Calculate the average of x and y
$avgX = $sumX / count($data);
$avgY = $sumY / count($data);

// Calculate the slope (m) and y-intercept (b) of the regression line
$intercept = (($sumY*$sumX2)-($sumX* $sumXY))/(($n*$sumX2)-pow($sumX,2));
$slope = ($n*$sumXY-($sumX*$sumY))/(($n*$sumX2)-pow($sumX,2));

// $slope = ($sumXY - (count($data) * $avgX * $avgY)) / ($sumX - (count($data) * pow($avgX, 2)));
// $intercept = $avgY - ($slope * $avgX);

$dailyRevenue = $slope * $daily_prediction + $intercept;
$n1 = number_format( $dailyRevenue, 0 );
 $message = $n1;
 


$runQuery2 = mysqli_query($conn,$query2);
        if($runQuery2)
        {
            $data = array();
        }
        while($row = mysqli_fetch_assoc($runQuery2)){
                $data[] = $row;
                
        }
        // print_r($data);
        // exit();
        // mysqli_free_result($runQuery);

// Calculate the sum of x, y, and x*y
$sumX = 0;
$sumY = 0;
$sumXY = 0;
$sumX2 = 0;
$sumY2 = 0;
$n = count($data);

foreach($data as $myData) {
    $x = $myData['bookingCount'];
    $y = $myData['totalBookedAmt'];
    
    $sumX += $x;
    $sumY += $y;
    $sumXY += $x * $y;
    $sumX2 += ($x * $x);
    $sumY2 += ($y * $y);
}

// Calculate the average of x and y
$avgX = $sumX / count($data);
$avgY = $sumY / count($data);

// Calculate the slope (m) and y-intercept (b) of the regression line
$intercept = (($sumY*$sumX2)-($sumX* $sumXY))/(($n*$sumX2)-pow($sumX,2));
$slope = ($n*$sumXY-($sumX*$sumY))/(($n*$sumX2)-pow($sumX,2));

// $slope = ($sumXY - (count($data) * $avgX * $avgY)) / ($sumX - (count($data) * pow($avgX, 2)));
// $intercept = $avgY - ($slope * $avgX);

$monthlyRevenue = $slope * $daily_prediction + $intercept;
$n2 = number_format( $monthlyRevenue, 0 );
 $message2 = $n2;




}
?>


<style>
    p{
        color:green;
        font-size:15px;
    }
</style>

<div class="main_container">
    <?php require_once 'admin-nav.php'; ?>
    <div class="container">
        <div class="info">

        <form method="POST" action="">
        <p>Daily Prediction (Enter expected number of bookings for today)</p>
        <input type="number" name="daily_prediction">
        <p>Monthly Prediction (Enter expected number of bookings for this month)</p>
        <input type="number" name="monthly_prediction">
        <br>
        <button type="submit" class="primary_btn">Predict the booking amount</button>

        <?php if($message!==null  && $message2!==null){ ?>

        <p>The estimated revenue for today is Rs.<?php echo $message?></p>
        <p>The estimated revenue for this month is Rs.<?php echo $message2?></p>

        <?php } ?>

        
</form>

        
</div>
</div>
</div>