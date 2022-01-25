<?php

use Config\Config;
use Core\Router;

$this->start("content"); ?>

<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/student/other_project_groups.css?v=<?= Config::get('version'); ?>" />
</head>

<body>
    <div id="main-container-center" class="flex justify-center">
        <div id="main-container" class="container px-10">
            <div id="card-section" class="mt-10 flex justify-around iterm-center flex-wrap">
                <div id="group-card" class="w-96 h-96 bg-white rounded-md filter drop-shadow-lg mb-10">
                    <div class="h-1/6 flex items-center">
                        <div class="text-2xl font-bold pl-4">Project Alpha</div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Status:</div>
                        <div class="text-lg">
                            <div id="tag" class="text-lg px-4 m-2 text-center bg-green-500 rounded-full text-white">Active</div>
                        </div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Type:</div>
                        <div class="text-lg w-2/3 px-2">Academic</div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Interest:</div>
                        <div class="text-lg w-2/3 flex">
                            <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#Python</div>
                            <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#Python</div>
                        </div>
                    </div>
                    <div class="h-1/6 px-4">
                        <div class="text-lg">A small description comes here. Lorem ipsum dolor sit amet,</div>
                    </div>
                    <div class="h-1/6 flex justify-end items-center">
                        <a href="" class="bg-blue-600 rounded-lg w-1/3 py-2 flex justify-center items-center hover:opacity-80 mr-4">
                            <div class="text-lg font-bold text-white">View</div>
                        </a>
                    </div>
                </div>
                <div id="group-card" class="w-96 h-96 bg-white rounded-md filter drop-shadow-lg mb-10">
                    <div class="h-1/6 flex items-center">
                        <div class="text-2xl font-bold pl-4">Project Alpha</div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Status:</div>
                        <div class="text-lg">
                            <div id="tag" class="text-lg px-4 m-2 text-center bg-green-500 rounded-full text-white">Active</div>
                        </div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Type:</div>
                        <div class="text-lg w-2/3 px-2">Academic</div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Interest:</div>
                        <div class="text-lg w-2/3 flex">
                            <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#Python</div>
                            <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#Python</div>
                        </div>
                    </div>
                    <div class="h-1/6 px-4">
                        <div class="text-lg">A small description comes here. Lorem ipsum dolor sit amet,</div>
                    </div>
                    <div class="h-1/6 flex justify-end items-center">
                        <a href="" class="bg-blue-600 rounded-lg w-1/3 py-2 flex justify-center items-center hover:opacity-80 mr-4">
                            <div class="text-lg font-bold text-white">View</div>
                        </a>
                    </div>
                </div>
                <div id="group-card" class="w-96 h-96 bg-white rounded-md filter drop-shadow-lg mb-10">
                    <div class="h-1/6 flex items-center">
                        <div class="text-2xl font-bold pl-4">Project Alpha</div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Status:</div>
                        <div class="text-lg">
                            <div id="tag" class="text-lg px-4 m-2 text-center bg-green-500 rounded-full text-white">Active</div>
                        </div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Type:</div>
                        <div class="text-lg w-2/3 px-2">Academic</div>
                    </div>
                    <div class="h-1/6 flex items-center">
                        <div class="text-lg w-1/3 pl-8">Interest:</div>
                        <div class="text-lg w-2/3 flex">
                            <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#Python</div>
                            <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#Python</div>
                        </div>
                    </div>
                    <div class="h-1/6 px-4">
                        <div class="text-lg">A small description comes here. Lorem ipsum dolor sit amet,</div>
                    </div>
                    <div class="h-1/6 flex justify-end items-center">
                        <a href="" class="bg-blue-600 rounded-lg w-1/3 py-2 flex justify-center items-center hover:opacity-80 mr-4">
                            <div class="text-lg font-bold text-white">View</div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="table" class="my-10 flex flex-col justify-center items-center bg-blue-600 bg-opacity-10 rounded">
                <div id="table-header" class="border-b-2 border-blue-600 flex w-full">
                    <div class="w-1/5 flex justify-center items-center">
                        <div class="text-lg font-bold py-4">Project Name</div>
                    </div>
                    <div class="w-1/5 flex justify-center items-center">
                        <div class="text-lg font-bold py-4">Status</div>
                    </div>
                    <div class="w-1/5 flex justify-center items-center">
                        <div class="text-lg font-bold py-4">Type</div>
                    </div>
                    <div class="w-1/5 flex justify-center items-center">
                        <div class="text-lg font-bold py-4">Interests</div>
                    </div>
                    <div class="w-1/5 flex justify-center items-center">
                        <div class="text-lg font-bold py-4"></div>
                    </div>
                </div>
                <div id="table-content" class="w-full">
                    <div id="row" class="flex w-full">
                        <div class="w-1/5 flex justify-start items-center">
                            <div class="text-lg ml-10 py-4">Lorem ipsum dolor sit.</div>
                        </div>
                        <div class="w-1/5 flex justify-center items-center">
                            <div id="tag" class="text-lg px-4 m-2 text-center bg-green-500 rounded-full text-white">Active</div>
                        </div>
                        <div class="w-1/5 flex justify-center items-center">
                            <div class="text-lg py-4">Lorem ipsum dolor sit.</div>
                        </div>
                        <div class="w-1/5 flex justify-start items-center flex-wrap">
                            <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#Python</div>
                        </div>
                        <div class="w-1/5 flex justify-center items-center">
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