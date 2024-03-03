<?php
    session_start();
    require '../config/dbconfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details & Pictures Upload</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

</script>

<?php
    require 'header.php';
?>
    <!-- <div class="header-topic"><h2>Place an Order</h2></div> -->
    <div class="container-orders">
    <h2 style="margin-top:0">Your Orders</h2>
    <!-- . { -->
        <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style='text-align:center;'>Order ID</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Order Date</th>
                    <th style='text-align:center;'>Order Details</th>
                </tr>
            </thead>
        <tbody>
                <?php
                    $sql = "SELECT * FROM orders WHERE Order_by = '" . $_SESSION["name"] . "'  ORDER BY order_date DESC";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $orderID = str_pad($row["order_id"], 4, '0', STR_PAD_LEFT);

                            if ($row["email_status"]==1) {
                                $button = '<a href="order_details.php?id='.$row["order_id"].'" class="viewbtn">View</a>';                        
                            } else {
                                $button = "<span style='color:red'><b>PENDING</b></span>";
                            }


                            echo "<tr>";
                            echo "<td style='text-align:right;'>#" . $orderID . "</td>";
                            echo "<td>" . $row["fullname"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["order_date"] . "</td>";
                            echo "<td style='text-align:center'>" . $button . "</td>";
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


<script src="navbar.js"></script>

<script>
    console.log("Current URL:", currentURL);
</script>


<footer>
    <p>&copy; 2024 Guardians Texhnologies (Pvt) Ltd</p>
</footer>

</body>
</html>
