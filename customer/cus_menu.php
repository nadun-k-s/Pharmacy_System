<?php

$menuItems = array(
    array(
        'title' => 'Dashboard',
        'url' => 'home.php'
    ),
    array(
        'title' => 'Quotations',
        'url' => 'quotation.php'
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

<ul>
    <?php foreach ($menuItems as $menuItem): ?>
        <li <?php if (basename($_SERVER['PHP_SELF']) == $menuItem['url']) echo 'class="active"'; ?>>
            <a href="<?php echo $menuItem['url']; ?>"><?php echo $menuItem['title']; ?></a>
        </li>
    <?php endforeach; ?>
</ul>
