<?php use App\Models\Users;
use Core\Helper;

$user = Users::getCurrentUser(); ?>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= \Config\Config::get('version') ?>">
</head>
<body>
<nav class="sidebar">
    <div class="my-5">
        <h2 class="text-white font-bold text-2xl">Hello <?=$user->lastName?> </h2>
    </div>
    <ul class="sidebar-options">
        <?php foreach ($this->sidebar as $value):
            $route = $value['route'] ?>
            <li class="text-sm pb-4 p-5 <?php if (Helper::isCurrentPage("/{$route}")): ?>active <?php endif; ?> hover:bg-blue-300 hover:text-white cursor-pointer">
                <a href="/<?= $route ?>"
                   class='flex items-center'>
                    <i class="material-icons-outlined mr-2">
                        <?= $value['icon'] ?>
                    </i>
                    <div class="link"><?= $value['name'] ?></div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
</body>
</html>