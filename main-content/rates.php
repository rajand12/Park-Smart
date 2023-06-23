<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<?php
$msg = "";
include "database_configuration.php";
session_start();
if (!isset($_SESSION['admin_details'])) {
    header('location:login.php');
}
$query = "SELECT `cost` from `price` where `vehicle_class`='bike'";
$query_result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($query_result);
$query1 = "SELECT `cost` from `price` where `vehicle_class`='car'";
$query_result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_assoc($query_result1);
$i = 1;
?>
<div class="main_container">
    <?php require_once "admin-nav.php"; ?>

    <div class="container">
        <div class="info">
            <form action="" method="post">
                <label for="bike_rate">Rate for Bike(Per 30 minutes)</label><br>
                <input type="number" name="bike_rate" value="<?php echo $row['cost']?>"><br>
                <label for="car_rate">Rate for Car(Per 30 minutes)</label><br>
                <input type="number" name="car_rate" value="<?php echo $row1['cost']?>"><br>
                <span class="myMsg"><?= $msg ?></span>
                <button type="submit" class="primary_btn">Update</button>
            </form>
</div>
</div>
</div>
<style>
    .myMsg{
        display:block;
        font-size:16px;
        font-weight:bold;
    }
    input{
        width:80%;
        padding:2px;
        margin:2%;
        height:5%;
    }
    .primary_btn{
        margin:2%;
    }
</style>

<?php
    $msg = "";
    if($_POST){
        $bike_rate = $_POST['bike_rate'];
        $car_rate = $_POST['car_rate'];
        $sql = "UPDATE `price` set cost=$bike_rate where `vehicle_class`='bike'";
        $sql1 = "UPDATE `price` set cost=$car_rate where `vehicle_class`='car'";
        if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)){
            echo '<script>alert("Rates Changed Successfully.");</script>';
            header("refresh: 0.5; url = http://localhost/park-smart/main-content/rates.php");
        }
        else{
            $msg = "Couldn't update rate.";
        }
    }
?>