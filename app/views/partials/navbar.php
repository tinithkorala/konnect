<?php

use App\Models\Users;
use Config\Config;

$user = Users::getCurrentUser();
$role = $user->roles[0];
?>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ultra&display=swap"
          rel="stylesheet">
    <title>Konnect</title>
</head>
<body>
<header class="navbar py-4 pl-10" style="font-family: 'Poppins', 'sans-serif';">
    <a href="/home/wall">
        <h1 class="logo cursor-pointer">
            Konnect
        </h1>
    </a>
    <div class="navbar-sect">
        <div class="search-bar">
            <input type="search" name="search" placeholder="Search" class="no-outline"/>
            <button class="search-btn">
              <span>
                <i class="material-icons-outlined">search</i>
              </span>
            </button>
        </div>
        <span class="material-icons-outlined icon">
            mark_chat_unread
        </span>
        <button class="dashboard-btn">
            <span class="material-icons-outlined">dashboard</span>
            <a href="/<?=$role?>/home"><p class="ml-2">Dashboard</p></a>
        </button>
        <div class="navbar-user pl-5 border-l-2">
            <span class="material-icons-outlined icon">account_circle</span>
            <p class="text-gray-600 ml-2"> <?=$user->firstName?> <?=$user->lastName?> </p>
        </div>
        <button class="dashboard-btn" onclick="window.location.href='/auth/logout'">
            <span class="material-icons-outlined">logout</span>
            <p class="ml-2">Logout</p>
        </button>
    </div>
</header>
</body>
