<?php
require_once "database_configuration.php";
if ($_GET && isset($_REQUEST["refId"])) {
    //Fetch record with respect to payment request id
    $sql = "SELECT * from `booking_table` where `price` = "
        . $_REQUEST['amt'] . " AND payment_request_id = '" . $_REQUEST['oid']
        . "' AND payment_status = 0";

    $result = mysqli_query($conn, $sql);
    $purchaseData = mysqli_fetch_assoc($result);

    if ($purchaseData) {
        $url = "https://uat.esewa.com.np/epay/transrec";
        $data = [
            'amt' => $purchaseData["price"],
            'rid' => $_REQUEST["refId"],
            'pid' => $purchaseData["payment_request_id"],
            'scd' => 'EPAYTEST'
        ];
        // print_r($data); exit;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        if (strpos($response, "Success") !== false) {
            //Need to update the database with the transaction reference id
            $sql = "UPDATE `booking_table` set payment_status = 1 
            where payment_request_id = '" .$purchaseData["payment_request_id"]."'" ;
            if(mysqli_query($conn, $sql)) {
    $sql2 = "UPDATE `booking_table` SET `booking_status`= 1 where `payment_request_id` = '".$_REQUEST['oid']."';";
    mysqli_query($conn,$sql2);

                header('location:http://localhost/Park-Smart/main-content/receipt_eSewa.php');
            } else {
                echo "Some problem occurred while saving the request in our end. Please contact the administrator or call us at +977-9851320011.";
            }
        } else {
            echo "Error occurred while performing the transaction. Please contact the administrator or call us at +977-9851320011.";
        }
    } else {
        echo "<h2>Invalid request.</h2>";
        exit;
    }
}