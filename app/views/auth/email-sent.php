<?php

use Config\Config;

$this->start('content') ?>
<head>
    <title>Forgot password</title>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version') ?>">
</head>
<body class="flex justify-center font-poppins">
    <div class="container" id="maincontainer">
            <div class="mt-10 flex justify-between items-center" id="headnav">
                <div class="w-40 text-5xl font-bold text-blue-600 2xl:w-80 lg:w-60 sm:w-40" id="tittle">
                    KONNECT
                </div>
                <a href="" class="w-40 flex justify-center items-center bg-blue-600 h-12 rounded-full 2xl:w-80 lg:w-60 md:w-60 sm:w-40" id="button">
                    <div class="text-lg text-white font-bold mx-0.5">Go to portal</div>
                    <div class="material-icons text-white mx-0.5">double_arrow</div>
                </a>
            </div>

            <!-- content part begins here -->
            <div class="flex mt-20 items-center" id="container">
                <div class="w-8/12 mt-28 ml-20" id="left">
                    <div class="text-3xl font-bold" id="paragraph">
                        Please check your email for further instructions.
                    </div>
                    <div class="mt-16 text-3xl w-8/12 h-1/6 border-blue-600 border-4 text-blue-600 p-6 rounded font-bold" id="sent-box">
                        EMAIL SENT!
                    </div>
                </div>
                <div class="mr-20" id="right">
                    <img src="<?= ROOT ?>app/images/forgot-password.png">
                </div>
            </div>
    </div>
</body>
<?php $this->end('content') ?>
