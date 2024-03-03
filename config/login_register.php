<?php
session_start();

require 'dbconfig.php';

// Registration process
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $password = $_POST['password'];

    // Check if the email already exists in the database
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        // User already exists
        echo "Error: This email is already registered.";
        header("Location: ../index.php?msg=error1");
        exit;
    } else {
        // Proceed with registration
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (fullname, email, address, contact_number, password, type) VALUES ('$fullname', '$email', '$address', '$contact_number', '$hashed_password', 1)";

        if (mysqli_query($conn, $sql)) {
            echo "Registration successful!";
            header("Location: ../index.php?msg=success");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            header("Location: ../index.php?msg=error2");
            exit;
        }
    }
}


// Login process
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['login_success'] = true;
            $_SESSION['name']=$row['fullname'];

            if ($row['type'] == 1) {
                // Redirect to customer home page
                header("Location: ../customer/home.php");
            } else {
                // Redirect to general home page
                header("Location: ../home.php");
            }
            exit;
        } else {
            // Incorrect password
            header("Location: ../index.php?msg_login=error1");
            exit;
        }
    } else {
        // User not found
        header("Location: ../index.php?msg_login=error2");
        exit;
    }
}


mysqli_close($conn);
?>
