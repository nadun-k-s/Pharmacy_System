<script src="navbar.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<header class="header">
    <div class="logo">
        <h3>PHARMACY</h3>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="help.php">Help</a></li>
        </ul>
    </nav>

    <div class="logout">
        <span style="color:white; margin-right:5px;">Welcome <b><?php echo $_SESSION['name']?></b></span>
        <a href="../config/logout.php">Logout</a>
    </div>
</header>