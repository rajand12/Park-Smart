<?php
include "database_configuration.php";
session_start();
if (!isset($_SESSION['admin_details'])) {
    header('location:login.php');
}?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['date'])) {
        $date = $_GET['date'];
        $formattedDate = date('Y-m-d', strtotime($date));
        // echo "<script>console.log($formattedDate)</script>";
        // echo "I received on php ".$formattedDate;
        // $data = array(
        //     array('John Doe', '25', 'Male'),
        //     array('Jane Smith', '30', 'Female'),
        //     array('Bob Johnson', '40', 'Male')
        // );
        $query = 'SELECT `full_name`,`vehicle_no`,`slot_name`,`booked_date`,`arrival_time`,`departure_time`,`price` from `booking_table` where `cancel_status`=0 AND `booked_date` = "'.$formattedDate.'"';
        $runQuery = mysqli_query($conn,$query);
        if($runQuery)
        {
            $data = array();
        }
        while($row = mysqli_fetch_assoc($runQuery)){
                $data[] = $row;
                
        }
        mysqli_free_result($runQuery);
               
        // Send the response back as JSON
        echo json_encode($data);
        exit;
    
    }
?>


<?php 

$query = "SELECT MIN(booked_date) as minDate from `booking_table`";
$runQuery1 = mysqli_query($conn,$query);
$query2 = "SELECT MAX(booked_date) as maxDate from `booking_table`";
$runQuery2= mysqli_query($conn,$query2);

while($row = mysqli_fetch_assoc($runQuery1)){
    $minDate =  $row['minDate'];
}
while($row = mysqli_fetch_assoc($runQuery2)){
    $maxDate =  $row['maxDate'];
}

?>

<div class="main_container">
    <?php require_once 'admin-nav.php'; ?>
    <div class="container">
        <div class="info">

            <label style="color:green; font-size:20px;">Select the date you want the report of</label>
            <input type="date" id="dateSelect" min="<?php echo $minDate; ?>" max="<?php echo $maxDate; ?>">
            <button id="dateSelectBtn" class="primary_btn">Get Data</button>
            <table id="myTable" style="display:none;">
            <thead>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Vehicle Number</th>
                <th>Slot Name</th>
                <th>Booked Date</th>
                <th>Arrival Time</th>
                <th>Departure Time</th>
                <th>Price</th>
</thead>
<tbody id="myTableBody">

</tbody>
                
                
            </table>

        
</div>
</div>
</div>

<script>
    $(document).ready(function(){
        console.log('ready')
        $("#dateSelectBtn").on('click',function(){
            console.log($('#dateSelect').val())
            $.ajax({
                url:'<?php echo $_SERVER['PHP_SELF']; ?>',
                type:'GET',
                data:{
                    date:$('#dateSelect').val()
                },
                success:function(response){
                    console.log(response);
                    element = document.getElementById("myTable");
                    if(element.style.display=="none"){
                        element.style.display="block";
                        
                    }
                $('#myTableBody').html("");
                    
                    tableFun =()=>{
                        var tableData = JSON.parse(response);
                    for(i=0;i<tableData.length;i++){
                        console.log(tableData[i]);

                        tableRow = document.createElement("tr");
                        document.getElementById('myTableBody').appendChild(tableRow);
                        tableD = document.createElement("td");
                        sNum = document.createTextNode(i+1);
                        tableD.appendChild(sNum);
                        tableRow.appendChild(tableD);
                        
                        tableD = document.createElement("td");
                        fullName = document.createTextNode(tableData[i]['full_name']);
                        tableD.appendChild(fullName);
                        tableRow.appendChild(tableD);

                        tableD = document.createElement("td");
                        vehicleNum = document.createTextNode(tableData[i]['vehicle_no']);
                        tableD.appendChild(vehicleNum);
                        tableRow.appendChild(tableD);

                        tableD = document.createElement("td");
                        slotName = document.createTextNode(tableData[i]['slot_name']);
                        tableD.appendChild(slotName);
                        tableRow.appendChild(tableD);

                        tableD = document.createElement("td");
                        bookedDate = document.createTextNode(tableData[i]['booked_date']);
                        tableD.appendChild(bookedDate);
                        tableRow.appendChild(tableD);

                        tableD = document.createElement("td");
                        arrivalTime = document.createTextNode(tableData[i]['arrival_time']);
                        tableD.appendChild(arrivalTime);
                        tableRow.appendChild(tableD);

                        tableD = document.createElement("td");
                        departureTime = document.createTextNode(tableData[i]['departure_time']);
                        tableD.appendChild(departureTime);
                        tableRow.appendChild(tableD);

                        tableD = document.createElement("td");
                        price = document.createTextNode(tableData[i]['price']);
                        tableD.appendChild(price);
                        tableRow.appendChild(tableD);
                    }
                }
                tableFun();
                
                },
                error:function(){

                }


            })
        })
    })
</script>

<?php 



?>