<?php

// print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Check if all required fields are set
    if (
        isset($_POST['fullname']) &&
        isset($_POST['email']) &&
        isset($_POST['address']) &&
        isset($_POST['contact_number']) &&
        isset($_POST['password']) &&
        isset($_POST['confirm_password'])
    ) {
        // Retrieve form data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $contact_number = $_POST['contact_number'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate form data (you may need to add more validation)
        if ($password !== $confirm_password) {
            echo "Error: Passwords do not match";
            exit; // Stop further execution
        }

        print_r($_POST);

        require 'dbconfig.php';


        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (fullname, email, address, contact_number, password) VALUES ('$fullname', '$email', '$address', '$contact_number', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Error: All required fields are not set";
    }
} else {
    echo "Error: Form submission method or button not set";
}
?>
