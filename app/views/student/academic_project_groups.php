<?php

use Config\Config;
use Core\Router;

$this->start("content"); ?>


<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/student/academic_project_groups.css?v=<?= Config::get('version'); ?>" />
</head>

<body>
    <div id="main-container-center" class="flex justify-center">
        <div id="main-container" class="container px-10">
            <div id="banner" class="my-10 flex iterm-center">
                <div class="w-full py-6 rounded-2xl bg-blue-300 text-2xl text-center">Hi there! You’re currently in <span class="font-bold">the proposal stage</span></div>
            </div>
            <div id="card-section" class="flex justify-around iterm-center flex-wrap">
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
                <!-- <div id="group-card" class="w-96 h-96 bg-white rounded-md filter drop-shadow-lg mb-10">
                    <div class="h-5/6 flex justify-center items-center">
                        <img src="<?= ROOT ?>app/images/createplus.png">
                    </div>
                    <div class="h-1/6 flex justify-center items-center">
                        <a href="" class="bg-blue-600 rounded-lg w-5/6 py-2 flex justify-center items-center hover:opacity-80">
                            <div class="text-lg font-bold text-white">Create Project</div>
                        </a>
                    </div>
                </div> -->
                <div id="group-card" class="w-96 h-96 bg-white rounded-md filter drop-shadow-lg mb-10">
                    <div class="h-1/6 flex items-center">
                        <div class="text-2xl font-bold pl-4">Group Name</div>
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
                    <div class="h-2/6 px-4 flex items-center">
                        <div class="text-lg">A small description comes here. Lorem ipsum dolor sit amet,</div>
                    </div>
                    <div class="h-1/6 flex justify-end items-center">
                        <a href="" class="bg-blue-600 rounded-lg w-1/3 py-2 flex justify-center items-center hover:opacity-80 mr-4">
                            <div class="text-lg font-bold text-white">View</div>
                        </a>
                    </div>
                </div>
                <!-- <div id="group-card" class="w-96 h-96 bg-white rounded-md filter drop-shadow-lg mb-10">
                    <div class="h-full flex items-center">
                        <div class="text-lg font-bold px-4 text-center">You have not been assigned to a project group yet</div>
                    </div>
                </div> -->
            </div>
            <div id="table-id" class="text-3xl font-bold pb-6">Members</div>
            <div id="table" class="flex flex-col justify-center items-center bg-blue-600 bg-opacity-10 rounded">
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