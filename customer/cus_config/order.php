<?php
session_start();
date_default_timezone_set('Asia/Colombo');

require '../../config/dbconfig.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $name = $_POST['fullname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_SESSION['name'];
    $status = 'pending';

    // Get current date and time
    $orderDate = date("Y-m-d H:i:s");

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (order_by, order_date, fullname, address, phone, img1, img2, img3, img4, img5, note1, note2, note3, note4, note5, status, pres_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        // Print detailed error message
        die("Error in preparing SQL statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssssssssssi", $username, $orderDate, $name, $address, $phone, $img1, $img2, $img3, $img4, $img5, $note1, $note2, $note3, $note4, $note5, $status, $pres_num);
    
    // Initialize presentation number count
    $pres_num = 0;

    // Handle image uploads
    $targetDir = "../uploads/"; // Specify the directory where images will be uploaded
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif'); // Allowed file types
    
    // Loop through each uploaded file
    for ($i = 1; $i <= 5; $i++) {
        // Check if the file exists and is not empty
        if (!empty($_FILES['picture'.$i]['name'])) {
            $fileName = $_FILES['picture'.$i]['name'];
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $targetFile = $targetDir . basename($fileName);
            
            // Check if file type is allowed
            if (in_array($fileType, $allowedTypes)) {
                // Upload file
                if (move_uploaded_file($_FILES['picture'.$i]['tmp_name'], $targetFile)) {
                    // File uploaded successfully
                    ${"img".$i} = $targetFile; // Dynamically assign image path to corresponding variable
                    ${"note".$i} = $_POST['note'.$i]; // Assign note to corresponding variable
                    $pres_num++; // Increment presentation number count
                } else {
                    // Error uploading file
                    echo "Error uploading file.";
                    exit; // Exit script if error occurs
                }
            } else {
                // Invalid file type
                echo "Invalid file type.";
                exit; // Exit script if invalid file type
            }
        } else {
            // If no file uploaded for this image, set its path and note to empty string
            ${"img".$i} = "";
            ${"note".$i} = "";
        }
    }

    // Execute SQL statement
    if ($stmt->execute()) {
        // If successful, redirect with success message
        echo "<script>alert('Order Placed Successfully');</script>";
        echo "<script>window.location.href = '../profile.php';</script>";

        // $message = "Order submitted successfully.";
        // header("Location: ../profile.php?message=" . urlencode($message));
        // exit;
    } else {
        // If execution fails, display error message
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
