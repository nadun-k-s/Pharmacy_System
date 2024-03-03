<?php
// Include your database connection file if not already included
include_once 'config/dbconfig.php'; // Adjust the path as needed

// Check if the prescription image is provided in the GET request
if (isset($_GET['prescription'])) {
    $prescriptionImage = $_GET['prescription'];
    $orderId = $_GET['order_id'];

    // Sanitize the input (you should use prepared statements to prevent SQL injection)
    $prescriptionImage = mysqli_real_escape_string($conn, $prescriptionImage);

    // Query to retrieve prescription-specific data from the database
    $sql = "SELECT drugs.drug_name, drugs.price, order_detail.quantity, order_detail.cost 
            FROM order_detail
            INNER JOIN drugs ON drugs.drug_id = order_detail.drug
            WHERE order_detail.prescription = '$prescriptionImage' AND order_detail.order_id=$orderId"; // Modify as needed

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Start building the HTML for the tbody
        $tbodyHtml = '';
        $total=0;

        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $subtotal=$row["cost"]*$row["quantity"];
                $total=$total+$subtotal;

                $tbodyHtml .= '<tr>';
                $tbodyHtml .= '<td>' . $row["drug_name"] . '</td>';
                $tbodyHtml .= '<td>' . $row["cost"] . ' X ' . $row["quantity"] . '</td>';
                $tbodyHtml .= '<td style="text-align:right;">' . number_format($subtotal,2) . '</td>';
                $tbodyHtml .= '</tr>';
                $tbodyHtml .= '<tr>';

            }
                $tbodyHtml .= '<td class="right-align" colspan="2"><b>Total</b></td>';
                $tbodyHtml .= '<td style="text-align:right;"><b>'.number_format($total,2).'</b></td>';
                $tbodyHtml .= '</tr>';
        } else {
            // If no data found, display a message in a single row
            $tbodyHtml .= '<tr><td colspan="3">No data found</td></tr>';
            echo $sql;
        }

        // Send the HTML response back to the client
        echo $tbodyHtml;
    } else {
        // Error handling if the query fails
        echo '<tr><td colspan="3">Error fetching data</td></tr>';
            echo $sql;
    }
} else {
    // If prescription image parameter is not provided in the request
    echo '<tr><td colspan="3">Prescription image not provided</td></tr>';
}
?>
