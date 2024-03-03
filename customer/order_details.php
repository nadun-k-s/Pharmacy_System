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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .navbar ul{
            display: none;
        }

    </style>
</head>
<body>

</script>

<?php
    require 'header.php';
?>
    <div class="container-order-details">
        <?php        
        $orderID = $_GET['id'];
        $sql = "SELECT `order_id`, `fullname`, `address`, `phone`, `order_date`, `status`, `img1`, `img2`, `img3`, `img4`, `img5`, `note1`, `note2`, `note3`, `note4`, `note5` FROM `orders` WHERE order_id = $orderID";
        $result = $conn->query($sql);
        
        // echo $sql;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $orderID = str_pad($row["order_id"], 4, '0', STR_PAD_LEFT);
            $status = $row['status'];
            ?>
            <div class="order-details">
                <div class="backbtn"><a href="profile.php"><i class="fas fa-angle-double-left"></i> Back</a></div>

                <h2 style="margin-top: 0px;">Order Details</h2>
                <?php
                    if ($status=='accepted') {
                        $disable = 'disabled style="display:none"';
                        // echo $statusLable = 'You Have Accepted This Quotation';
                        echo '<span style="font-weight: bold; color: #4CAF50; padding: 8px; border: 1px solid #4CAF50;">You Have Accepted This Quotation</span>';
  
                    } else if ($status=='pending') {
                        $disable = '';
                        echo $statusLable = '';
                    } if ($status=='rejected') {
                        $disable = 'disabled style="display:none"';
                        // echo $statusLable = 'You have Rejected This Quotation';
                        echo '<span style="font-weight: bold; color: red; padding: 8px; border: 1px solid red;">You have Rejected This Quotation</span>';

                    } else {
                        $disable = '';
                        $statusLable = "";    
                    }
                ?>
                <div class="order-info">
                    <p><strong>Order ID</strong></p>
                    <p><b><?php echo '#' . str_pad($row['order_id'], 4, '0', STR_PAD_LEFT); ?></b></p>
                </div>
                <div class="order-info">
                    <p><strong>Name</strong></p>
                    <p><?php echo $row['fullname']; ?></p>
                </div>
                <div class="order-info">
                    <p><strong>Address</strong></p>
                    <p><?php echo $row['address']; ?></p>
                </div>
                <div class="order-info">
                    <p><strong>Phone</strong></p>
                    <p><?php echo $row['phone']; ?></p>
                </div>
                <div class="order-info">
                    <p><strong>Order Date</strong></p>
                    <p><?php echo $row['order_date']; ?></p>
                </div>
                <p><strong>Prescriptions</strong></p>

                <div class="prescriptions">
    <?php for ($i = 1; $i <= 5; $i++) {
        $imgColumnName = 'img'.$i;
        $noteColumnName = 'note'.$i;
        // echo "Image Column Name: $imgColumnName, Note Column Name: $noteColumnName<br>";
        if (!empty($row[$imgColumnName]) && !empty($row[$noteColumnName])) { ?>
            <div class="prescription">
                <img src="upload/<?php echo $row[$imgColumnName]; ?>" alt="Prescription Image">
                <p><strong>Note - Prescription <?php echo $i; ?></strong> <br><?php echo $row[$noteColumnName]; ?></p>
                <div class="">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Drug</th>
                                <th>Qty</th>
                                <th>Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch data from the database
                            $sqlPres = "SELECT order_detail.order_id, drugs.drug_name, order_detail.drug, order_detail.quantity, order_detail.cost 
                                    FROM order_detail 
                                    INNER JOIN drugs ON drugs.drug_id = order_detail.drug  
                                    INNER JOIN orders ON orders.order_id = order_detail.order_id  
                                    WHERE order_detail.order_id = $orderID AND prescription = $i";
                            $result = $conn->query($sqlPres);
                            if ($result) {
                                if ($result->num_rows > 0) {
                                    $total = 0;
                                    while($rowPres = $result->fetch_assoc()) {
                                        $stubtotal = $rowPres['quantity'] * $rowPres['cost'];
                                        $total += $stubtotal;
                                        $stubtotal = number_format($stubtotal, 2);
                                        echo "<tr>";
                                        echo "<td>{$rowPres['drug_name']}</td>";
                                        echo "<td style='text-align:right;'>{$rowPres['quantity']}</td>";
                                        echo "<td style='text-align:right;'>{$stubtotal}</td>";
                                        echo "</tr>";
                                    }
                                    $total = number_format($total, 2);
                                    echo "<tr>";
                                    echo "<td colspan='2' style='text-align:right; font-weight:bold;'>Total</td>";
                                    echo "<td style='text-align:right; font-weight:bold;'>{$total}</td>";
                                    echo "</tr>";
                                } else {
                                    echo "<tr><td colspan='3'>No data found</td></tr>";
                                }
                            } else {
                                echo "Error: " . $conn->error; // Print SQL error for debugging
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    <?php 
        } 
    } ?>
</div>

                <?php
                    // if ($status=='accepted') {
                    //     $disable = 'disabled';
                    //     // echo $statusLable = 'You Have Accepted This Quotation';
                    //     echo '<span style="font-weight: bold; color: #4CAF50; padding: 8px; border: 1px solid #4CAF50;">You Have Accepted This Quotation</span>';
  
                    // } else if ($status=='pending') {
                    //     $disable = 'disabled';
                    //     echo $statusLable = '';
                    // } if ($status=='rejected') {
                    //     $disable = 'disabled';
                    //     // echo $statusLable = 'You have Rejected This Quotation';
                    //     echo '<span style="font-weight: bold; color: red; padding: 8px; border: 1px solid red;">You have Rejected This Quotation</span>';

                    // } else {
                    //     $disable = '';
                    //     $statusLable = "";    
                    // }
                ?>

                <div class="buttons" style="text-align:right;">
                    <form action="cus_config/update_status.php" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $_GET['id']; ?>">
                        <button class="button-accept" <?php echo $disable;?> type="submit" name="status" value="accepted">Accept</button>
                        <button class="button-reject" <?php echo $disable;?> type="submit" name="status" value="rejected">Reject</button>
                    </form>
                </div>
            </div>
        <?php } ?>
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
