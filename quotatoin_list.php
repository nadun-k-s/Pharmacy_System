<?php 
    session_start();
    require 'config/dbconfig.php';
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
    <h2>Pending Quotations</h2>
    <!-- <p>This is the main content area of your dashboard.</p> -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style='text-align:center;'>Order ID</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Order Date</th>
                    <th style='text-align:center;'>Add Quotation</th>
                    <th>Email</th>
                </tr>
            </thead>
        <tbody>
                <?php
                    $sql = "SELECT * FROM orders WHERE email_status =0 ORDER BY order_date DESC";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            if ($row["email_status"]==0) {
                              $email_status = "<span><b>Pending</b></span>";
                            }

                            $orderID = str_pad($row["order_id"], 4, '0', STR_PAD_LEFT);
                            $button = '<a href="quotation.php?id='.$row["order_id"].'" class="addbtn">Add</a>';                        

                            echo "<tr>";
                            echo "<td style='text-align:right;'>#" . $orderID . "</td>";
                            echo "<td>" . $row["fullname"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["order_date"] . "</td>";
                            echo "<td style='text-align:center'>" . $button . "</td>";
                            echo "<td>" . $email_status . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // echo "0 results";
                        echo "<tr><td colspan='17'>No orders found</td></tr>";

                    }

                        
                    // } else {
                    //     echo "<tr><td colspan='8'>No orders found</td></tr>";
                    // }
                ?>
            </tbody>
        </table>
        </div>
  </div>

  <footer>
    <p>&copy; 2024 Guardians Texhnologies (Pvt) Ltd</p>
  </footer>

</div>

</body>
</html>
