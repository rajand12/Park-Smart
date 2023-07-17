<?php
include "database_configuration.php";
$success_msg = "";
$i = 1;
session_start();
$date = date("Y-m-d"); 
$sql1 = 'SELECT * FROM `slots` WHERE `slot_name` LIKE "a%"';
$sql2 = 'SELECT * FROM `slots` WHERE `slot_name` LIKE "b%"';
$sql3 = 'SELECT * FROM `slots` WHERE `slot_name` LIKE "c%"';
$sql4 = 'SELECT * FROM `slots` WHERE `slot_name` LIKE "d%"';
$sql5 = 'SELECT * FROM `slots` WHERE `slot_name` LIKE "e%"';
$sql6 = 'SELECT * FROM `slots` WHERE `slot_name` LIKE "f%"';

// $sql7 = "SELECT `slot_name`,SUM(TIMESTAMPDIFF(MINUTE, `arrival_time`, `departure_time`)) as `total` FROM `booking_table` where `booked_date`= '$date' GROUP BY `slot_name`";

// $run7 = mysqli_query($conn,$sql7);




// if($run7)
// {
//     $data1 = array();
//     $data = array();
    
// }
// $i = 0;
// while($row = mysqli_fetch_assoc($run7)){
//         $data[] = $row;
//         if($row["total"]<=240){
//           $data1[$i] = $row["slot_name"];
//           $i++;
//         }
        
// }
// print_r ($data1);

    
    
    


$run1 = mysqli_query($conn,$sql1);
$run2 = mysqli_query($conn,$sql2);
$run3 = mysqli_query($conn,$sql3);
$run4 = mysqli_query($conn,$sql4);
$run5 = mysqli_query($conn,$sql5);
$run6 = mysqli_query($conn,$sql6);
if (!isset($_SESSION['user_details'])) {
    header('location:login.php');
}

else{

}?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='../CSS/after-login.css' />
    <title>Park Smart</title>
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
    <div class="center-main-div">
      <div class="legend">
        <div class="legend-item">
          <div class="color none-booked"></div>
          <span>Not Booked</span>
        </div>
        <div class="legend-item">
          <div class="color min-booked"></div>
          <span>Booked Minimun</span>
        </div>
        <div class="legend-item">
    <div class="color medium-booked"></div>
    <span>Booked Medium</span>
  </div>
  <div class="legend-item">
    <div class="color highly-booked"></div>
    <span>Highly Booked</span>
  </div>
  <div class="legend-item">
    <div class="color booked"></div>
    <span>Not Available</span>
  </div>
</div>
<div class="main-div">
        <div class="bike-row">
          <div class="text"><i class="fa fa-motorcycle" aria-hidden="true"></i></div>
          <?php
            while($row1=$run1->fetch_assoc()){
              
              if($row1['slot_status']==0){
                $slot_name = $row1["slot_name"];
                $bookQuery = "SELECT SUM(TIMESTAMPDIFF(MINUTE, `arrival_time`, `departure_time`)) as `total` FROM `booking_table` where `booked_date`= '$date' AND `slot_name`= '$slot_name'";
                // echo $bookQuery;
                // exit();
                $runBookQuery = mysqli_query($conn,$bookQuery);
                $resultBookQuery=$runBookQuery->fetch_assoc();
                $time = (int)$resultBookQuery['total'];
                if(is_null($resultBookQuery['total'])){ ?>
                      <div class="bike" id="<?= $row1['slot_id']?>"><?= $row1['slot_name']?></div>
                <?php }elseif( $time>0 && $time<361){?>
                      <div class="bike-boked-low" id="<?=$row1['slot_id']?>"><?=$row1['slot_name']?><?php echo $resultBookQuery['total']; ?></div>
                <?php } elseif($resultBookQuery['total']<=840){ ?>
                  <div class="bike-booked-medium" id="<?=$row1['slot_id']?>"><?=$row1['slot_name']?></div>

                <?php }
                elseif($resultBookQuery['total']<=1440){ ?>
                      <div class="bike-booked-high" id="<?=$row1['slot_id']?>"><?=$row1['slot_name']?></div>
                <?php }  ?>
                              
              <?php }
                else{?>
                  <div class="bike-booked" id="<?=$row1['slot_id']?>"><?=$row1['slot_name']?></div>
                <?php }
            }?>
        </div>
        <div class="road"></div>
        <div class="bike-row">
        <div class="text"><i class="fa fa-motorcycle" aria-hidden="true"></i></div>
          <?php
            while($row2=$run2->fetch_assoc()){
              if($row2['slot_status']==0){
                $slot_name = $row2["slot_name"];
                $bookQuery = "SELECT SUM(TIMESTAMPDIFF(MINUTE, `arrival_time`, `departure_time`)) as `total` FROM `booking_table` where `booked_date`= '$date' AND `slot_name`= '$slot_name'";
                // echo $bookQuery;
                // exit();
                $runBookQuery = mysqli_query($conn,$bookQuery);
                $resultBookQuery=$runBookQuery->fetch_assoc();
                $time = (int)$resultBookQuery['total'];
                if(is_null($resultBookQuery['total'])){ ?>
                      <div class="bike" id="<?=$row2['slot_id']?>"><?=$row2['slot_name']?></div>
                <?php }
                elseif($time>0 && $time<361){ ?>
                      <div class="bike-booked-low" id="<?=$row2['slot_id']?>"><?=$row2['slot_name']?></div>
                <?php } elseif($resultBookQuery['total']<=840){ ?>
                  <div class="bike-booked-medium" id="<?=$row2['slot_id']?>"><?=$row2['slot_name']?></div>

                <?php }
                elseif($resultBookQuery['total']<=1440){ ?>
                      <div class="bike-booked-high" id="<?=$row2['slot_id']?>"><?=$row2['slot_name']?></div>
                <?php }  ?>
                              
              <?php }
                else{?>
                  <div class="bike-booked" id="<?=$row2['slot_id']?>"><?=$row2['slot_name']?></div>
                <?php }
            }?>
        </div>
        <div class="road"></div>
        <div class="bike-row">
        <div class="text"><i class="fa fa-motorcycle" aria-hidden="true"></i></div>
          <?php
            while($row3=$run3->fetch_assoc()){
              if($row3['slot_status']==0){
                $slot_name = $row3["slot_name"];
                $bookQuery = "SELECT SUM(TIMESTAMPDIFF(MINUTE, `arrival_time`, `departure_time`)) as `total` FROM `booking_table` where `booked_date`= '$date' AND `slot_name`= '$slot_name'";
                // echo $bookQuery;
                // exit();
                $runBookQuery = mysqli_query($conn,$bookQuery);
                $resultBookQuery=$runBookQuery->fetch_assoc();
                $time = (int)$resultBookQuery['total'];

                if(is_null($resultBookQuery['total'])){ ?>
                      <div class="bike" id="<?=$row3['slot_id']?>"><?=$row3['slot_name']?></div>
                <?php }
                elseif($time>0 && $time<361){ ?>
                      <div class="bike-booked-low" id="<?=$row3['slot_id']?>"><?=$row3['slot_name']?></div>
                <?php } elseif($resultBookQuery['total']<=840){ ?>
                  <div class="bike-booked-medium" id="<?=$row3['slot_id']?>"><?=$row3['slot_name']?></div>

                <?php }
                elseif($resultBookQuery['total']<=1440){ ?>
                      <div class="bike-booked-high" id="<?=$row3['slot_id']?>"><?=$row3['slot_name']?></div>
                <?php }  ?>
                              
              <?php }
                else{?>
                  <div class="bike-booked" id="<?=$row3['slot_id']?>"><?=$row3['slot_name']?></div>
                <?php }
            }?>
        </div>
        <div class="road"></div>
        <div class="bike-row">
        <div class="text"><i class="fa fa-motorcycle" aria-hidden="true"></i></div>          
          <?php
            while($row4=$run4->fetch_assoc()){
              if($row4['slot_status']==0){
                $slot_name = $row4["slot_name"];
                $bookQuery = "SELECT SUM(TIMESTAMPDIFF(MINUTE, `arrival_time`, `departure_time`)) as `total` FROM `booking_table` where `booked_date`= '$date' AND `slot_name`= '$slot_name'";
                // echo $bookQuery;
                // exit();
                $runBookQuery = mysqli_query($conn,$bookQuery);
                $resultBookQuery=$runBookQuery->fetch_assoc();
                $time = (int)$resultBookQuery['total'];

                if(is_null($resultBookQuery['total'])){ ?>
                      <div class="bike" id="<?=$row4['slot_id']?>"><?=$row4['slot_name']?></div>
                <?php }
                elseif($time>0 && $time<361){ ?>
                      <div class="bike-booked-low" id="<?=$row4['slot_id']?>"><?=$row4['slot_name']?></div>
                <?php } elseif($resultBookQuery['total']<=840){ ?>
                  <div class="bike-booked-medium" id="<?=$row4['slot_id']?>"><?=$row4['slot_name']?></div>

                <?php }
                elseif($resultBookQuery['total']<=1440){ ?>
                      <div class="bike-booked-high" id="<?=$row4['slot_id']?>"><?=$row4['slot_name']?></div>
                <?php }  ?>
                              
              <?php }
                else{?>
                  <div class="bike-booked" id="<?=$row4['slot_id']?>"><?=$row4['slot_name']?></div>
                <?php }
            }?>
        </div>
        <div class="road"></div>
        <div class="car-row">
        <div class="text"><i class="fa fa-car" aria-hidden="true"></i></div>
          <?php
            while($row5=$run5->fetch_assoc()){
              if($row5['slot_status']==0){
                $slot_name = $row5["slot_name"];
                $bookQuery = "SELECT SUM(TIMESTAMPDIFF(MINUTE, `arrival_time`, `departure_time`)) as `total` FROM `booking_table` where `booked_date`= '$date' AND `slot_name`= '$slot_name'";
                // echo $bookQuery;
                // exit();
                $runBookQuery = mysqli_query($conn,$bookQuery);
                $resultBookQuery=$runBookQuery->fetch_assoc();
                $time = (int)$resultBookQuery['total'];
                if(is_null($resultBookQuery['total'])){ ?>
                      <div class="car" id="<?=$row5['slot_id']?>"><?=$row5['slot_name']?></div>
                <?php }
                elseif($time>0 && $time<361){ ?>
                      <div class="car-booked-low" id="<?=$row5['slot_id']?>"><?=$row5['slot_name']?></div>
                <?php } elseif($resultBookQuery['total']<=840){ ?>
                  <div class="car-booked-medium" id="<?=$row5['slot_id']?>"><?=$row5['slot_name']?></div>

                <?php }
                elseif($resultBookQuery['total']<=1440){ ?>
                      <div class="car-booked-high" id="<?=$row5['slot_id']?>"><?=$row5['slot_name']?></div>
                <?php }  ?>
                              
              <?php }
                else{?>
                  <div class="car-booked" id="<?=$row5['slot_id']?>"><?=$row5['slot_name']?></div>
                <?php }
            }?>
        </div>
        <div class="road"></div>
        <div class="car-row">
        <div class="text"><i class="fa fa-car" aria-hidden="true"></i></div>
          <?php
            while($row6=$run6->fetch_assoc()){
              if($row6['slot_status']==0){
                $slot_name = $row6["slot_name"];
                $bookQuery = "SELECT SUM(TIMESTAMPDIFF(MINUTE, `arrival_time`, `departure_time`)) as `total` FROM `booking_table` where `booked_date`= '$date' AND `slot_name`= '$slot_name'";
                // echo $bookQuery;
                // exit();
                $runBookQuery = mysqli_query($conn,$bookQuery);
                $resultBookQuery=$runBookQuery->fetch_assoc();
                $time = (int)$resultBookQuery['total'];

                if(is_null($resultBookQuery['total'])){ ?>
                      <div class="car" id="<?=$row6['slot_id']?>"><?=$row6['slot_name']?></div>
                <?php }
                elseif($time>0 && $time<361){ ?>
                      <div class="car-booked-low" id="<?=$row6['slot_id']?>"><?=$row6['slot_name']?></div>
                <?php } elseif($resultBookQuery['total']<=840){ ?>
                  <div class="car-booked-medium" id="<?=$row6['slot_id']?>"><?=$row6['slot_name']?></div>

                <?php }
                elseif($resultBookQuery['total']<=1440){ ?>
                      <div class="car-booked-high" id="<?=$row6['slot_id']?>"><?=$row6['slot_name']?></div>
                <?php }  ?>
                              
              <?php }
                else{?>
                  <div class="car-booked" id="<?=$row6['slot_id']?>"><?=$row6['slot_name']?></div>
                <?php }
            }?>
        </div>
      </div>

      <script src="../Script/script.js"></script>