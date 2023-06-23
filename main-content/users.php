<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<?php
include "database_configuration.php";
session_start();
if (!isset($_SESSION['admin_details'])) {
    header('location:login.php');
}
$query = "SELECT * from `user_details`";
$query_result = mysqli_query($conn, $query);
$i = 1;
?>
<div class="main_container">
    <?php require_once "admin-nav.php"; ?>

    <div class="container">
        <div class="info">
            <table>
                <tr>
                    <th>S No.</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Is Admin</th>
                    <th colspan="2">Actions</th>

                </tr>
                <?php

                while ($query_row = mysqli_fetch_array($query_result)) {

                ?>
                    <tr>
                        <?php $id = $query_row['user_id']; ?>
                        <td><?php echo $i ?></td>
                        <td><?php echo $query_row['full_name'];
                            ?></td>
                        <td><?php echo $query_row['email'];
                            ?></td>
                        <td><?php echo $query_row['contact'];
                            ?></td>
                        <td><?php if ($query_row['is_admin'] == 1) {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }
                            ?></td>
                            <?php if ($query_row['is_admin'] == 0) { ?>
                            <td><button class="primary_btn" onclick="makeAdmin(<?php echo $id ?>)">Make Admin</a></button></td>
                            <td><button class="danger_btn" onclick="deleteUser(<?php echo $id ?>)">Delete user</a></button></td>
                            <?php } else{ ?>
                            
                                    <td colspan="2">Cannot perform actions on admin</td>
                           <?php } ?>

                    </tr>
                <?php
                    $i++;
                }

                $conn->close();

                ?>
            </table>
    </div>

</div>
<script>
        function makeAdmin(id){
           $.ajax({
               url: "http://localhost/Park-Smart/main-content/makeadmin.php?id="+id,
               type:'GET',
               success:function(res){
                alert (res);
                   window.location.href="http://localhost/park-smart/main-content/users.php";
                    // $('#message').html(res);
               }
           }) 
        }
        function deleteUser(id){
            $.ajax({
               url: "http://localhost/Park-Smart/main-content/deleteuser.php?id="+id,
               type:'GET',
               success:function(res){
                alert (res);
                   window.location.href="http://localhost/park-smart/main-content/users.php";
                    // $('#message').html(res);
               }
           }) 
        }
    </script>