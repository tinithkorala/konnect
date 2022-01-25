<?php

use Config\Config;
use Core\FormHelpers;

$this->start('content') ?>
<?php $this->partial('partials/navbar') ?>

    <head>
        <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version') ?>">
    </head>

    <body class="font-poppins">
    <div class="flex items-center justify-center">
        <div class="container flex flex-col items-center">
            <div class="w-full text-4xl font-bold mt-20">
                CREATE A PROJECT
            </div>
            <form class="bg-white mt-20 w-11/12 p-16 filter drop-shadow-lg rounded-3xl" method="post">
                <?= FormHelpers::csrfField(); ?>
                <?= FormHelpers::inputBlock('Project Name', 'name', '', ['class' => 'w-1/2 p-4 border-gray-300 border-2 rounded-xl'], ['class' => 'flex flex-row justify-around mb-12 text-2xl'], $this->errors) ?>
                <?= FormHelpers::inputBlock('Project Description', 'description', '', ['class' => 'w-1/2 p-4 border-gray-300 border-2 rounded-xl'], ['class' => 'flex flex-row justify-around mb-12 text-2xl'], $this->errors) ?>
                <div class="flex flex-row justify-around text-2xl mb-24">
                    <div class="w-1/5">Interests:</div>
                    <div class="w-1/2 flex justify-between">
                        <button type="button"><span class="material-icons-outlined text-5xl text-gray-400">add_box</span></button>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="reset" class="w-1/6 bg-blue-600 p-2.5 text-white text-2xl rounded-md mr-12">Reset</button>
                    <button type="submit" class="w-1/6 bg-blue-600 p-2.5 text-white text-2xl rounded-md">Submit</button>
                </div>
            </form>
        </div>
    </div>

    </body>
<?php $this->partial('partials/footer')?>
<?php $this->end() ?>