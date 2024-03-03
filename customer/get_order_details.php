<?php
session_start();
require '../config/dbconfig.php';

$orderID = $_GET['order_id'];
$sql = "SELECT `order_id`, `address`, `phone`, `order_date`, `status`, `img1`, `img2`, `img3`, `img4`, `img5`, `note1`, `note2`, `note3`, `note4`, `note5` FROM `orders` WHERE order_id = $orderID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $orderDetails = $result->fetch_assoc();
    echo json_encode($orderDetails);
} else {
    echo json_encode(array('error' => 'Order not found'));
}

$conn->close();
?>
