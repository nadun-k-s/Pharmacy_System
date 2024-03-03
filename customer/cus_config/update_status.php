<?php

session_start();
require '../../config/dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get order_id and status from the form
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update status in drug table
    $sql = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
        echo '<script>
                alert("Status Sent successfully")
                window.location.href = "../profile.php";
            </script>;';
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $conn->close();
}
?>
