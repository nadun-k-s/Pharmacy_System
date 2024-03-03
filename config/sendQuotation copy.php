<?php
session_start();
require 'dbconfig.php';
use PHPMailer\PHPMailer\PHPMailer;
// require '../PHPMailer/src/PHPMailer.php';
// require '../PHPMailer/src/SMTP.php';
// require '../PHPMailer/src/Exception.php';

function checkImagesInOrderDetails($orderId, $conn) {
    // Query to count the number of images related to the order ID in the orders table
    // $sqlOrders = "  SELECT COUNT(*) AS img_count
    $sqlOrders = "  SELECT pres_number
                    FROM orders
                    WHERE order_id = $orderId";
    $resultOrders = $conn->query($sqlOrders);
    $rowOrders = $resultOrders->fetch_assoc();
    $imgCountOrders = $rowOrders['pres_number'];

    // echo $sqlOrders;

    // Query to count the number of images related to the order ID in the order_details table
    $sqlOrderDetails = "SELECT COUNT(DISTINCT prescription) AS prescription_count
                        FROM order_detail
                        WHERE order_id = $orderId";
    $resultOrderDetails = $conn->query($sqlOrderDetails);
    $rowOrderDetails = $resultOrderDetails->fetch_assoc();
    $imgCountOrderDetails = $rowOrderDetails['prescription_count'];

    // echo $sqlOrderDetails;

    // Compare the counts
    if ($imgCountOrders == $imgCountOrderDetails) {
        return true; // All images are included in the order_details table
    } else {
        return false; // Not all images are included in the order_details table
    }
}

// Example usage:
$orderId = $_POST['order_id']; // Replace with the specific order ID you want to check
if (checkImagesInOrderDetails($orderId, $conn)) {
    echo "All images are included in the order_details table. Admin can send email.";
    
    $userEmailSql="SELECT users.email, users.fullname FROM users INNER JOIN
                    orders ON orders.order_by = users.fullname
                    WHERE orders.order_id = $orderId";
    
    echo $userEmailSql;

    $result = mysqli_query($conn, $userEmailSql);

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $cus_name=$row['fullname'];
            $cus_email=$row['email'];
        }
    }

    $cus_email = "nadunkaushalya2020@gmail.com";

    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    require '../PHPMailer/src/Exception.php';


    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // Enable verbose debug output
    // $mail->SMTPDebug = 2;

    // SMTP configuration for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'nadundevelop@gmail.com'; // Your Gmail email address
    $mail->Password = 'kjya onsy wghz cajm'; // Your Gmail password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to Gmail SMTP server

    // Sender and recipient settings
    $mail->setFrom('nadundevelop@gmail.com', 'New Keerthy Pharmacy');
    $mail->addAddress($cus_email);

    // Email subject
    $mail->Subject = 'Your order quotation has been sent';

    $mail->Body = "Dear customer,\n\nYour order (order number: ".$_POST['order_id'].") quotation has been sent. Please check it from your account.\n\nRegards,\n".$_SESSION['name']."";

    // Send the email
    if($mail->send()) {
        echo 'Email sent successfully.';
    } else {
        echo 'Error: ' . $mail->ErrorInfo;
    }

} else {
    echo "Not all images are included in the order_details table. Admin cannot send email.";
}

// Close connection
$conn->close();
?>