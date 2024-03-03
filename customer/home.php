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
    <div class="container">
        <h2 style="margin-top:0">Place an Order</h2>
        <form action="cus_config/order.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="lable">Name</div>
                <input type="text" name="fullname" value="<?php echo $_SESSION['name']?>" placeholder="Full Name" required>
            </div>
            <div class="input-group">
                <div class="lable">Shipping Address</div>
                <input type="text" name="address" placeholder="Shipping Address" required>
            </div>
            <div class="input-group">
                <div class="lable">Contact Number</div>
                <input type="text" name="phone" placeholder="Phone Number" required>
            </div>

            <div class="input-group" style="color:red; font-size:12px">* Upload upto 5 prescriptions using '+' icon</div>

            <div class="input-box" id="inputGroup1">
                <div class="input-group">
                    <label class="file-input">
                        Upload Your Prescription
                        <input id="fileInput1" onchange="previewImage(event, 'previewContainer1')" type="file" name="picture1" accept="image/*" required multiple>
                        <div class="preview" style="display: none;" id="previewContainer1"></div>
                    </label>
                    <textarea name="note1" placeholder="Note" required></textarea>
                </div>
                <button id="addInput" class="add-btn" onclick="addInputGroup()">+</button>
            </div>

            <div>
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>

    <script>

        function previewImage(event, containerId) {
            const container = document.getElementById(containerId);
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                container.style.display = 'inline-block';
                
                reader.onload = function(e) {
                    const image = new Image();
                    image.src = e.target.result;
                    image.onload = function() {
                        const maxWidth = container.offsetWidth;
                        const maxHeight = container.offsetHeight;
                        const widthRatio = maxWidth / image.width;
                        const heightRatio = maxHeight / image.height;
                        const scale = Math.min(widthRatio, heightRatio);
                        
                        const previewImage = new Image();
                        previewImage.src = e.target.result;
                        previewImage.style.width = image.width * scale + 'px';
                        previewImage.style.height = image.height * scale + 'px';
                        container.innerHTML = ''; // Clear previous content
                        container.appendChild(previewImage);
                    };
                };
                
                reader.readAsDataURL(file);
                

            } 
        }
    </script>

<script>
    var inputGroupCount = 1;

    function addInputGroup() {
        if (inputGroupCount < 5) { // Check if the maximum limit is reached
            inputGroupCount++;

            var newInputGroup = document.createElement("div");
            newInputGroup.className = "input-box";
            newInputGroup.id = "inputGroup" + inputGroupCount;

            var inputGroupInner = document.createElement("div");
            inputGroupInner.className = "input-group";

            var label = document.createElement("label");
            label.className = "file-input";
            label.textContent = "Upload Your Prescription";

            var input = document.createElement("input");
            input.id = "fileInput" + inputGroupCount;
            input.setAttribute("onchange", "previewImage(event, 'previewContainer" + inputGroupCount + "')");
            input.type = "file";
            input.name = "picture" + inputGroupCount;
            input.accept = "image/*";
            input.required = true;
            input.multiple = true;

            var preview = document.createElement("div");
            preview.className = "preview";
            preview.style.display = "none";
            preview.id = "previewContainer" + inputGroupCount;

            var textarea = document.createElement("textarea");
            textarea.name = "note" + inputGroupCount;
            textarea.placeholder = "Note";
            textarea.required = true;

            label.appendChild(input);
            label.appendChild(preview);
            inputGroupInner.appendChild(label);
            inputGroupInner.appendChild(textarea);
            newInputGroup.appendChild(inputGroupInner);

            var addButton = document.createElement("button");
            addButton.className = "add-btn";
            addButton.textContent = "+";
            addButton.onclick = addInputGroup;

            newInputGroup.appendChild(addButton);

            var form = document.querySelector("form");
            form.insertBefore(newInputGroup, form.lastElementChild);

            // Hide "+" button in the previous input group
            if (inputGroupCount > 1) {
                var prevInputGroup = document.getElementById("inputGroup" + (inputGroupCount - 1));
                var prevAddButton = prevInputGroup.querySelector(".add-btn");
                prevAddButton.style.display = "none";
            }
        }

        // Hide "+" button if maximum limit reached
        if (inputGroupCount >= 5) {
            document.querySelectorAll(".add-btn").forEach(function(button) {
                button.style.display = "none";
            });
        }
    }
</script>

<script src="navbar.js"></script>

<script>
    console.log("Current URL:", currentURL);
</script>


<footer>
    <p>&copy; 2024 Guardians Texhnologies (Pvt) Ltd</p>
</footer>

</body>
</html>
