<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<?php
    include "database_configuration.php";
    session_start();
    if(!isset($_SESSION['admin_details'])){
        header('location:login.php');
    }
?>
<div class="main_container">
        <?php require_once 'admin-nav.php';?>
        <div class="container">
            <div class="info">
                    <table>
                <tr>

                    <th>Slot Name</th>
                    <th>Slot Status</th>
                    <th colspan="2">Actions</th>
                </tr>
                <?php
                include "database_configuration.php";
                $sss = "SELECT * FROM slots";
                $result = mysqli_query($conn, $sss);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['slot_name'];
                        $status = $row['slot_status'];
                        $id = $row['slot_id'];

                        ?>
                        <tr>
                        <td><?php echo $name;?></td>
                        <td><?php 
                            if($status==0)
                            print "Available";
                            else
                            print "Unavailable";
                        ?></td>
                    
                    <p id="message"></p>
                    <td><button class="danger_btn" onclick="makeUnavailable(<?= $id ?>)">Make Unavialble</a></button></td>
                        <td><button class="primary_btn" onclick="makeAvailable(<?= $id ?>)">Make Available</a></button></td>
                        
                        </tr>
                <?php
                        
                    }
                }
                ?>
            </div>
            
        </div>
    </div>
    <script>
        function makeUnavailable(id){
           $.ajax({
               url: "http://localhost/Park-Smart/main-content/makeUnavailable.php?id="+id,
               type:'GET',
               success:function(res){
                   alert (res);
                   window.location.href="http://localhost/park-smart/main-content/slots_status.php";
                    // $('#message').html(res);
               }
           }) 
        }
        function makeAvailable(id){
            $.ajax({
               url: "http://localhost/Park-Smart/main-content/makeAvailable.php?id="+id,
               type:'GET',
               success:function(res){
                   alert (res);
                   window.location.href="http://localhost/park-smart/main-content/slots_status.php";
                    // $('#message').html(res);
               }
           }) 
        }
    </script>