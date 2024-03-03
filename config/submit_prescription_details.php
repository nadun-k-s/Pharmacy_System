<?php
session_start();
require 'dbconfig.php';
date_default_timezone_set('Asia/Colombo');

$response = array();

for ($i = 1; $i <= 5; $i++) {
    // Check if the form is submitted
    if(isset($_POST['quotation_num'.$i])) {
        $prescription = $_POST['quotation_num'.$i];
        $drug_id = $_POST['drug'.$i];
        $quantity = $_POST['qty'.$i];
        $order_id = $_POST['order_id'];
        $user = $_SESSION['name'];
        $date = date("Y-m-d H:i:s");


        $sqlDrug = "SELECT `price` FROM `drugs` WHERE `drug_id` = $drug_id";
        $result = mysqli_query($conn, $sqlDrug);
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cost = $row["price"];
            }
        } else {
            $response[$i] = "Error fetching drug price";
            continue; // Skip to next iteration
        }

        // Insert data into the database
        $sql = "INSERT INTO `order_detail`(`order_id`, `prescription`, `drug`, `quantity`, `cost`, `added_by`, `added_date`) VALUES ('$order_id', '$prescription', '$drug_id', '$quantity', '$cost', '$user', '$date')";
        if(mysqli_query($conn, $sql)) {
            $response[$i] = "Form ".$i." submitted successfully";
        } else {
            $response[$i] = "Error submitting form ".$i.": " . mysqli_error($conn);
        }
    }
}

// Encode the response array into JSON format
echo json_encode($response);
?>
