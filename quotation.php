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
    <h2 style="margin-bottom:10px; margin-top:0px">Make Quotation</h2>
    <!-- <p>This is the main content area of your dashboard.</p> -->

    <?php        
        $orderID = $_GET['id'];
        $sql = "SELECT `order_id`, `fullname`, `address`, `phone`, `order_date`, `status`, `img1`, `img2`, `img3`, `img4`, `img5`, `note1`, `note2`, `note3`, `note4`, `note5` FROM `orders` WHERE order_id = $orderID";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $orderID = str_pad($row["order_id"], 4, '0', STR_PAD_LEFT);
            ?>
        
    <div class="container" style="max-width:80%; display: grid; grid-template-columns: 40% 60%;">
    <div id="form-container" style="display: grid; grid-template-rows: repeat(5, auto); gap: 10px; border: 1px solid #ccc;  ; padding:10px; margin-right:10px;">
    <div style="font-weight:bold">Order Number : <span id="orderNum"><?php echo str_pad($row["order_id"], 4, '0', STR_PAD_LEFT);?></span></div>
    
        <div class="main-image center-align">
            <img id="mainImage" src="customer/uploads/<?php echo $row['img1'];?>" alt="Main Image" style="border: 1px solid #ccc;">

            <div class="image-list" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px;">
                <?php if (!empty($row['img1'])): ?>
                    <img src="customer/uploads/<?php echo $row['img1'];?>" alt="Image 1" onclick="changeImageAndForm('<?php echo $row['img1'];?>','1')">
                <?php endif; ?>
                <?php if (!empty($row['img2'])): ?>
                    <img src="customer/uploads/<?php echo $row['img2'];?>" alt="Image 2" onclick="changeImageAndForm('<?php echo $row['img2'];?>','2')">
                <?php endif; ?>
                <?php if (!empty($row['img3'])): ?>
                    <img src="customer/uploads/<?php echo $row['img3'];?>" alt="Image 3" onclick="changeImageAndForm('<?php echo $row['img3'];?>','3')">
                <?php endif; ?>
                <?php if (!empty($row['img4'])): ?>
                    <img src="customer/uploads/<?php echo $row['img4'];?>" alt="Image 4" onclick="changeImageAndForm('<?php echo $row['img4'];?>','4')">
                <?php endif; ?>
                <?php if (!empty($row['img5'])): ?>
                    <img src="customer/uploads/<?php echo $row['img5'];?>" alt="Image 5" onclick="changeImageAndForm('<?php echo $row['img5'];?>','5')">
                <?php endif; ?>
            </div>

        </div>
    </div>
    
    <div id="form-container" style="display: grid; grid-template-rows: repeat(5, auto); gap: 10px; padding:10px">
        <div><b>Quotatoin Number : <span id="quotation_Number">1</span></b></div>
        <table style="margin-bottom: 20px; width:100%;">
            <thead>
                <tr>
                    <th>Drug</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="prescriptionData">
            <?php
                // $prescription = 0;
                // $sql = "SELECT drugs.drug_name, order_detail.quantity, order_detail.cost 
                //         FROM order_detail
                //         INNER JOIN drugs ON drugs.drug_id = order_detail.drug WHERE order_detail.prescription = $prescription"; // Modify the query according to your database schema
                // $result = mysqli_query($conn, $sql);
                // if (mysqli_num_rows($result) > 0) {
                //     // Output data of each row
                //     while ($row = mysqli_fetch_assoc($result)) {
                //         echo '<tr>';
                //         echo '<td>' . $row["drug_name"] . '</td>';
                //         echo '<td>' . $row["quantity"] . '</td>';
                //         echo '<td>' . $row["cost"] . '</td>';
                //         echo '</tr>';
                //     }
                // } else {
                //     echo '<tr><td colspan="3">No data found</td></tr>';
                // }
            ?>
                <!-- <tr>
                    <td class="right-align" colspan="2"><b>Total</b></td>
                    <td><b></b></td>
                </tr> -->
            </tbody>
        </table>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function updatePrescriptionData(prescriptionImage) {
                var orderId = $('#orderNum').text();

                // alert();

                $.ajax({
                    url: 'fetch_prescription_data.php', // Change to your server endpoint
                    method: 'GET',
                    data: { 
                            prescription: prescriptionImage,
                            order_id: orderId },
                    success: function(response) {
                        // Update the tbody with the fetched data
                        $('#prescriptionData').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            var prescriptionImage = $('#quotation_Number').text();
            updatePrescriptionData(prescriptionImage);
        </script>

        <form id="form1" action="config/submit_prescription_details.php" style="display: block; border-bottom: 1px solid #ccc; margin-bottom:10px">
            <div class="form-group right-align">
                <label for="drug1">Drug</label>
                <select name="drug1" id="drug" class="selectDrug">
                    <option value=""></option>
                    <?php
                    $sql = "SELECT drug_id, price, drug_name FROM drugs";
                    $result = mysqli_query($conn, $sql);
                    
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row["drug_id"] . '">' . $row["drug_name"] . ' | Rs.' . $row["price"] . '</option>';
                            }
                        } else {
                            echo '<option value="">No drugs found</option>';
                            // echo $sql;
                        }
                    ?>
                </select>

            </div>
            <input type="hidden" name="quotation_num1" value="1">
            <input type="hidden" name="order_id" value="<?php echo $orderID; ?>">
            <div class="form-group right-align">
                <label for="">Quantity</label>
                <input type="number" id="qty" name="qty1" placeholder="Quantity" style="width:40%">
            </div>
            <div class="form-group right-align">
                <input type="submit" value="Add" style="width: 20%;">
            </div> 
        </form>

        <!-- Clone form1 content to form2 to form5 -->
        <script>
            for (let i = 1; i <= 5; i++) {
                let form1Content = document.getElementById('form1').innerHTML;
                form1Content = form1Content.replace(/drug1/g, 'drug' + i);
                form1Content = form1Content.replace(/qty1/g, 'qty' + i);
                // form1Content = form1Content.replace(/qty1/g, 'qty' + i);
                form1Content = form1Content.replace(/quotation_num1/g, 'quotation_num' + (i));
                form1Content = form1Content.replace(/value="1"/g, 'value="' + (i) + '"');
                // form1Content = form1Content.replace(/1/g, i);
                document.write('<form action="config/submit_prescription_details.php" id="form' + i + '" style="display: none; border-bottom: 1px solid #ccc; margin-bottom:10px">' + form1Content + '</form>');
            }
        </script>

        <form id="quotation_button" method="POST" action="config/sendQuotation.php">
            <div class="form-group right-align" style="margin-bottom:5px;">
                <input type="hidden" name="order_id" value="<?php echo $orderID;?>">
                <input type="submit" value="Send Quotation" style="width: 30%;">
            </div>
        </form>
    </div>
    
</div>
<?php } 
// }
 ?>

<script>
    // Function to handle form submission
    function submitForm(formId) {
        // Get the form element
        var form = document.getElementById(formId);
        
        // Create a new FormData object to store form data
        var formData = new FormData(form);

        // Make an AJAX request to submit the form data
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'config/submit_prescription_details.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                // Check if the request was successful
                if (xhr.status === 200) {
                    // Parse the JSON response
                    var response = JSON.parse(xhr.responseText);
                    // Handle the response for each form
                    for (var key in response) {
                        console.log(response[key]); // Log response message
                    }

                    var prescriptionImage = $('#quotation_Number').text();

                    updatePrescriptionData(prescriptionImage);

                    form.reset();

                } else {
                    // Handle error
                    console.error('Error submitting form:', xhr.status);
                }
            }
        };
        xhr.send(formData);
    }

    // Add event listeners to each form
    for (let i = 1; i <= 5; i++) {
        let form = document.getElementById('form' + i);
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            submitForm('form' + i); // Call submitForm function with the form ID
        });
    }

</script>



    <script>
        function changeImageAndForm(imageNumber,formid) {
            var mainImage = document.getElementById("mainImage");
            mainImage.src = 'customer/uploads/'+imageNumber;
            
            // Hide all forms
            var forms = document.querySelectorAll('#form-container form');
            forms.forEach(function(form) {
                form.style.display = 'none';
            });
            
            // Show the relevant form
            var formToShow = document.getElementById('form' + formid);
            formToShow.style.display = 'block';

            var quotationButton = document.getElementById("quotation_button");
            quotationButton.style.display = 'block';

            var quotationNo = document.getElementById("quotation_Number");
            quotationNo.innerHTML = formid;
            
            var prescriptionImage = $('#quotation_Number').text();

            updatePrescriptionData(prescriptionImage);

        }

        // function updatePrescriptionData(prescriptionImage) {
        //         // Make an AJAX request to fetch data based on the prescription image
        //         $.ajax({
        //             url: 'fetch_prescription_data.php', // Change to your server endpoint
        //             method: 'GET',
        //             data: { prescription: prescriptionImage },
        //             success: function(response) {
        //                 // Update the tbody with the fetched data
        //                 $('#prescriptionData').html(response);
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error(error);
        //             }
        //         });
        //     }

        //     // Example usage: call updatePrescriptionData with the prescription image
        //     var prescriptionImage = 'example_image.jpg'; // Change this to the selected prescription image
        //     updatePrescriptionData(prescriptionImage);
    </script>
  </div>

  <footer>
    <p>&copy; 2024 Guardians Texhnologies (Pvt) Ltd</p>
  </footer>

</div>

</body>
</html>
