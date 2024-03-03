<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <title>Login and Registration Form</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f4f4f4;
    }
    .container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .container h2 {
      text-align: center;
      color: #333;
    }
    .form-group {
      margin-bottom: 20px;
      text-align: center;
      font-family: "Poppins", sans-serif;

    }
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
      font-family: "Poppins", sans-serif;

    }
    .form-group input[type="submit"] {
      width: 95%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #333;
      color: #fff;
      cursor: pointer;
      outline: none;
      font-family: "Poppins", sans-serif;

    }
    .form-group input[type="submit"]:hover {
      background-color: #555;
    }
    .form-group .toggle-form {
      margin-top: 10px;
      text-align: center;
    }
    .form-group .toggle-form a {
      color: #333;
      text-decoration: none;
    }
    .social-login {
      text-align: center;
    }
    .social-login .btn-google,
    .social-login .btn-facebook {
      width: 45%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
      outline: none;
    }
    .social-login .btn-google {
      background-color: #dd4b39;
    }
    .social-login .btn-facebook {
      background-color: #3b5998;
    }
    .social-login .btn-google:hover,
    .social-login .btn-facebook:hover {
      opacity: 0.9;
    }
    .or-separator {
      text-align: center;
      font-size: 18px;
      color: #aaa;
      margin: 20px 0;
      position: relative;
    }
    .or-separator::before,
    .or-separator::after {
      content: "";
      display: inline-block;
      width: 40%;
      height: 1px;
      background-color: #aaa;
      position: absolute;
      top: 50%;
    }
    .or-separator::before {
      right: 5%;
    }
    .or-separator::after {
      left: 5%;
    }
    .social-login,
    .or-separator {
      display: none;
    }
    .show-social-login .social-login,
    .show-social-login .or-separator {
      display: block;
    }

    .alert_container {
        margin-top:30px;
        position: relative;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        font-size:12px;
    }

    .alert_error, .alert_success {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 5px;
        animation: fadeInOut 1s ease-in-out;
    }

    .alert_error {
        background-color: #ffe6e6;
        color: #cc0000;
        border: 1px solid #cc0000;
    }

    .alert_success {
        background-color: #e6ffe6;
        color: #009900;
        border: 1px solid #009900;
    }

    /* Keyframes for fadeInOut animation */
    @keyframes fadeInOut {
        0% { opacity: 0; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }


  </style>
</head>
<body>

<div class="container" id="loginForm">
  <h2>Login</h2>
  <?php
  if (isset($_GET['msg'])) {
      $msg = $_GET['msg'];
      if ($msg === 'error1' || $msg === 'success') {
          echo "<div class='alert_container'>";
          if ($msg === 'error1') {
              $error_msg = "Registratoin Falid. Email Already Exists. Please Login";
              echo "<div class='alert_error'>$error_msg</div>";
          } elseif ($msg === 'success') {
              $success_msg = "Registration Successful. Please Login";
              echo "<div class='alert_success'>$success_msg</div>";
          }
          echo "</div>"; // Close alert_container
      }
  }

  if (isset($_GET['msg_login'])) {
      $msg_login = $_GET['msg_login'];
      if ($msg_login === 'error1' || $msg_login=== 'success' || $msg_login === 'error2' ) {
          echo "<div class='alert_container'>";
          if ($msg_login === 'error1') {
              $error_msg_login = "Incorrect username or password!";
              echo "<div class='alert_error'>$error_msg_login</div>";
          } elseif ($msg_login === 'error2') {
              $success_msg_login = "Incorrect username or password!";
              echo "<div class='alert_error'>$success_msg_login</div>";
          }
          echo "</div>"; // Close alert_container
      }
  }
  ?>
  <form method="POST" action="config/login_register.php">
    <div class="form-group">
      <input name="email" type="email" placeholder="Email" required>
    </div>
    <div class="form-group">
      <input name="password" type="password" placeholder="Password" required>
    </div>
    <div class="form-group">
      <input name="login" type="submit" value="Login">
    </div>
    <div class="form-group toggle-form">
        Don't have an account?<a href="#" onclick="toggleForms()"> Register here</a>
    </div>
  </form>
</div>

<div class="container" id="registerForm" style="display: none;">
  <h2>Register</h2>
  <form method="POST" action="config/login_register.php">
    <div class="form-group">
      <input name="fullname" type="text" placeholder="Full Name" required>
    </div>
    <div class="form-group">
      <input name="email" type="email" placeholder="Email" required>
    </div>
    <div class="form-group">
      <input name="address" type="text" placeholder="Address" required>
    </div>
    <div class="form-group">
      <input name="contact_number" type="text" placeholder="Contact Number" required>
    </div>
    <div class="form-group">
      <input name="password" type="password" placeholder="Password" required>
    </div>
    <div class="form-group">
      <input name="confirm_password" type="password" placeholder="Re Enter Password" required>
    </div>
    <div class="form-group">
      <input type="submit" name="register" value="Register">
    </div>
    <div class="form-group toggle-form">
        Already have an account?<a href="#" onclick="toggleForms()"> Login here</a>
    </div>
  </form>
</div>

<script>
  function toggleForms() {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    loginForm.style.display = loginForm.style.display === "none" ? "block" : "none";
    registerForm.style.display = registerForm.style.display === "none" ? "block" : "none";
    const showSocialLogin = !loginForm.style.display.includes("none");
  }
</script>

</body>
</html>
