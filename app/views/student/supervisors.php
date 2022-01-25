<?php

use Config\Config;
use Core\Router;

$this->start("content"); ?>

<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/student/supervisors.css?v=<?= Config::get('version'); ?>" />
</head>

<body>
    <div id="main-container-center" class="flex justify-center">
        <div id="main-container" class="container px-10">
            <div id="table-id" class="mt-10 text-3xl font-bold pb-6">Supervisors available to you</div>
            <div id="table" class="mb-10 flex flex-col justify-center items-center bg-blue-600 bg-opacity-10 rounded">
                <div id="table-header" class="border-b-2 border-blue-600 flex w-full">
                    <div class="w-1/4 flex justify-center items-center">
                        <div class="text-lg font-bold py-4">Name</div>
                    </div>
                    <div class="w-1/4 flex justify-center items-center">
                        <div class="text-lg font-bold py-4">Position</div>
                    </div>
                    <div class="w-1/4 flex justify-center items-center">
                        <div class="text-lg font-bold py-4">Email</div>
                    </div>
                    <div class="w-1/4 flex justify-center items-center">
                        <div class="text-lg font-bold py-4"></div>
                    </div>
                </div>
                <div id="table-content" class="w-full">
                    <div id="row" class="flex w-full">
                        <div class="w-1/4 flex justify-start items-center">
                            <div class="text-lg ml-10 py-4">Lorem ipsum dolor sit.</div>
                        </div>
                        <div class="w-1/4 flex justify-start items-center">
                            <div class="text-lg ml-10 py-4">Lorem ipsum dolor sit.</div>
                        </div>
                        <div class="w-1/4 flex justify-start items-center">
                            <div class="text-lg ml-10 py-4">Lorem ipsum dolor sit.</div>
                        </div>
                        <div class="w-1/4 flex justify-center items-center">
                            <a href="" class="bg-blue-600 rounded-xl w-2/3 py-2 flex justify-center items-center hover:opacity-80">
                                <div class="text-lg font-bold text-white">View</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php $this->end() ?>