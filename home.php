<?php
session_start();
require 'config/dbconfig.php';

if (!isset($_SESSION['login_success']) || !$_SESSION['login_success']) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style/style.css">
  
  <title>Dashboard</title>
  
  
  <style>
    body {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body>

<div class="wrapper">

  <header>
     <h1>Dashboard</h1>
     <a id="logout" href="config/logout.php">Logout <i class="fa fa-power-off" aria-hidden="true"></i></a>
  </header>
  
  <div class="menu">
    <?php require 'mastermenu.php'?>
  </div>

    <div class="content">
        <h2>Welcome to the Dashboard</h2>
        <?php
        // Query to get counts for each status
        $sql_pending = "SELECT COUNT(*) AS pending_count FROM orders WHERE status = 'pending'";
        $sql_accepted = "SELECT COUNT(*) AS accepted_count FROM orders WHERE status = 'accepted'";
        $sql_rejected = "SELECT COUNT(*) AS rejected_count FROM orders WHERE status = 'rejected'";

        // Execute queries
        $result_pending = $conn->query($sql_pending);
        $result_accepted = $conn->query($sql_accepted);
        $result_rejected = $conn->query($sql_rejected);

        // Initialize counts
        $pending_count = 0;
        $accepted_count = 0;
        $rejected_count = 0;

        // Fetch counts
        if ($result_pending->num_rows > 0) {
            $row_pending = $result_pending->fetch_assoc();
            $pending_count = $row_pending["pending_count"];
        }
        if ($result_accepted->num_rows > 0) {
            $row_accepted = $result_accepted->fetch_assoc();
            $accepted_count = $row_accepted["accepted_count"];
        }
        if ($result_rejected->num_rows > 0) {
            $row_rejected = $result_rejected->fetch_assoc();
            $rejected_count = $row_rejected["rejected_count"];
        }

        // Close connection
        $conn->close();
        ?>

        <div class="quotation-boxes">
            <div class="box pending">
                <h3>Pending Quotations</h3>
                <p class="count"><?php echo $pending_count; ?></p>
            </div>
            <div class="box accepted">
                <h3>Accepted Quotations</h3>
                <p class="count"><?php echo $accepted_count; ?></p>
            </div>
            <div class="box rejected">
                <h3>Rejected Quotations</h3>
                <p class="count"><?php echo $rejected_count; ?></p>
            </div>
        </div>
    </div>



  <footer>
    <p>&copy; 2024 Guardians Texhnologies (Pvt) Ltd</p>
  </footer>

</div>

</body>
</html>
