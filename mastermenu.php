<?php

$menuItems = array(
    array(
        'title' => 'Dashboard',
        'url' => 'home.php'
    ),
    array(
        'title' => 'Quotations',
        'url' => 'quotatoin_list.php'
    ),
    array(
        'title' => 'Reports',
        'url' => 'reports.php'
    ),
    array(
        'title' => 'Analytics',
        'url' => '#'
    ),
    array(
        'title' => 'Settings',
        'url' => '#'
    )
);
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<ul>
    <?php foreach ($menuItems as $menuItem): ?>
        <li <?php if (basename($_SERVER['PHP_SELF']) == $menuItem['url']) echo 'class="active"'; ?>>
            <a href="<?php echo $menuItem['url']; ?>"><?php echo $menuItem['title']; ?></a>
        </li>
    <?php endforeach; ?>
</ul>
