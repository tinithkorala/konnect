<?php

use Config\Config;

$this->start("content"); ?>
    <head>
        <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version'); ?>">
    </head>
    <?php $this->partial('partials/navbar'); ?>
    <body>

     <div class="container  mx-auto w-full h-screen">
       <div class="bg-white h-3/4 mt-20 rounded-xl filter drop-shadow-lg">

        <div class="w-full flex inline mb-20">
        <div class="h-full w-1/5">
            <div class="h-3/5 w-3/5 mx-16 mt-36">
            <img class="rounded-full h-34 w-34 filter drop-shadow-lg" src="<?= ROOT ?>app/images/person.png">
            </div>
        </div>
        <div class="h-full w-2/5">
            <div class="pt-20">
            <lable class="text-xl w-full pt-11">First Name</lable><br>
            <input class="text-xl p-4 w-4/5 filter drop-shadow-lg " type="text" placeholder="first name">
            </div>
            <div class="pt-20">
            <lable class="text-xl w-full pt-11">Email</lable><br>
            <input class="text-xl p-4 w-4/5 filter drop-shadow-lg " type="email" placeholder="Email">
            </div>
        </div>
        <div class="h-full w-2/5">
        <div class="pt-20">
            <lable class="text-xl w-full pt-11">Last Name</lable><br>
            <input class="text-xl p-4 w-4/5 filter drop-shadow-lg " type="text" placeholder="last name">
            </div>
            <div class="pt-20">
            <lable class="text-xl w-full pt-11">Position</lable><br>
            <input class="text-xl p-4 w-4/5 filter drop-shadow-lg " type="text" placeholder="position">
            </div>
        </div>
        </div>
        <div class="w-full h-1/6 mb-20">
          <div class="font-bold text-xl mx-20 mb-10">
            Security
          </div>
          <lable class="text-xl mx-24">Password</lable><br>
          <input class="text-xl p-4 w-1/5  mx-24 filter drop-shadow-lg" type="password" placeholder="password">
        </div>
        <div class="flex justify-end">
          <button type="reset" class="w-1/6 bg-blue-600 p-2.5 text-white text-2xl rounded-md mr-12">Reset</button>
          <button type="submit" class="w-1/6 bg-blue-600 p-2.5 text-white text-2xl rounded-md mr-12">Submit</button>
        </div>
        </div>
     </div>

    </body>
    <?php $this->partial('partials/footer')?>
    <?php $this->end() ?>
