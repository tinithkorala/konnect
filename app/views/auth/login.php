<?php use App\Models\Users;
use Config\Config;
use Core\FormHelpers;
use Core\Router;

$user = Users::getCurrentUser();
if($user) Router::redirect('/home/wall');
$this->start('content') ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version'); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ultra&display=swap"
              rel="stylesheet">
        <title>Login to Konnect</title>
    </head>
    <body style="font-family: 'Poppins', 'sans-serif';" class="overflow-x-hidden h-screen m-0 p-0">
    <div class="flex h-full w-full">
        <div class="w-1/2 flex flex-col">
            <header class="navbar bg-transparent p-10">
                <h1 class="logo">Konnect</h1>
            </header>
            <div class="flex flex-col items-center mt-32">
                <p class="uppercase font-bold text-3xl tracking-widest mb-32"> We have a plethora of <br/>opportunities
                </p>
                <img src="<?= ROOT ?>app/images/login.png" alt="login"/>
            </div>
        </div>
        <div class="w-1/2 h-full flex flex-col items-center justify-center bg-blue-600 rounded-l-3xl">
            <div>
                <h2 class="text-white uppercase tracking-widest font-bold text-5xl mb-32">Welcome Back</h2>
            </div>
            <form method="post" class="w-2/5">
                <?= FormHelpers::csrfField() ?>
                <?= FormHelpers::inputBlock("Username (email): ", "email", $this->user->email, ['class' => 'text-black focus:outline-none rounded p-2 w-full mt-2', 'placeholder' => 'Enter username/email'], ['class' => 'flex flex-col text-white'], $this->errors); ?>
                <?= FormHelpers::inputBlock("Password: ", "password", $this->user->password, ['type' => 'password', 'class' => 'text-black focus:outline-none rounded p-2 w-full mt-2', 'placeholder' => 'Enter password'], ['class' => 'flex flex-col text-white mt-5'], $this->errors); ?>
                <div class="text-right mt-5">
                    <a class="text-white font-bold cursor-pointer">Forgot Password?</a>
                </div>
                <div class="text-center mt-10">
                    <button type="submit"
                            class="bg-white text-blue-600 w-2/5 text-center font-bold rounded p-2 shadow transform hover:scale-105">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    </body>
<?php $this->end(); ?>