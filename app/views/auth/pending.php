<?php use Config\Config;

$this->start('content'); ?>
<head>
    <title>Registration pending</title>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/auth/pending.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
<div class="main-container">
    <div class="right">
        <h2>KONNECT</h2>
        <img src="<?= ROOT ?>app/images/pending.jpg" class="image"/>
    </div>

    <div class="left">
        <div class="container">
            <p>Your registration request has been sent and you will be notified when it is approved :)
            </p>
        </div>
    </div>
</div>
</body>