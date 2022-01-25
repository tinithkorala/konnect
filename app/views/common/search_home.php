<?php

use Config\Config;
use Core\FormHelpers;

$this->start('content') ?>
<?php $this->partial('partials/navbar') ?>

<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version') ?>">
</head>

<body class="font-poppins">
    <div id="top-section-blue " class="bg-blue-600 py-28 px-80 flex justify-center items-center flex-col">
        <div class="mb-10 text-white text-3xl font-bold">What is the fuck you here for ?</div>
        <div id="search-box" class="bg-white rounded-lg py-2 px-10 flex justify-center items-center flex-row-reverse">
            <input type="text" placeholder="Search for projects, users, . . ." class="text-lg rounded-lg p-2">
            <button type="submit" class="block rounded-lg bg-white text-gray-500 hover:text-blue-600 mr-4"><span class="material-icons-outlined block text-5xl">search</span></button>
        </div>
        <div id="popular" class="flex items-center py-2 flex justify-start items-center">
            <div class="text-lg text-white font-bold my-2 pr-2">Popular:</div>
            <div class="text-lg flex flex-wrap">
                <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#Python</div>
                <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#machine learning</div>
                <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#AI</div>
                <div id="tag" class="px-4 text-lg m-2 bg-gray-300 rounded-lg">#BigData</div>
            </div>
        </div>
    </div>
    <div id="container-center" class="flex justify-center items-center">
        <div id="main-container" class="container">
            <div id="bottom-section" class="flex justify-between">
                <div id="bottom-left" class="w-1/2 m-6">
                    <div id="table-id" class="text-4xl font-bold text-blue-600 py-4">Users</div>
                    <div id="white-box" class="bg-white filter drop-shadow-lg rounded-xl p-2">
                        <div id="table" class="flex flex-col justify-center items-center bg-blue-600 bg-opacity-10 rounded-xl">
                            <div id="table-header" class="border-b-2 border-blue-600 flex w-full justify-center">
                                <div class="w-1/6 flex justify-center items-center">
                                    <div class="text-lg font-bold my-4"></div>
                                </div>
                                <div class="w-1/3 flex justify-center items-center">
                                    <div class="text-lg font-bold my-4">Name</div>
                                </div>
                                <div class="w-1/3 flex justify-center items-center">
                                    <div class="text-lg font-bold my-4">Type</div>
                                </div>
                                <div class="w-1/3 flex justify-center items-center">
                                    <div class="text-lg font-bold my-4"></div>
                                </div>
                            </div>
                            <div id="table-content" class="w-full">
                                <div id="row-blue" class="flex w-full justify-center">
                                    <div class="w-1/6 flex justify-center items-center">
                                        <div class="material-icons-outlined text-6xl text-gray-400">account_circle</div>
                                    </div>
                                    <div class="w-1/3 flex justify-start items-center">
                                        <div class="text-lg ml-10 my-4">Lorem ipsum dolor sit.</div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <div href="" class="bg-blue-600 rounded-full w-2/3 py-2 flex justify-center items-center">
                                            <div class="text-lg font-medium text-white">Supervisor</div>
                                        </div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <a href="" class="bg-white rounded-md w-2/3 py-2 border-2 border-gray-400 text-gray-400 flex justify-center items-center hover:text-white hover:border-transparent hover:bg-blue-600">
                                            <div class="text-lg font-medium">View</div>
                                        </a>
                                    </div>
                                </div>
                                <div id="row-blue" class="flex w-full justify-center">
                                    <div class="w-1/6 flex justify-center items-center">
                                        <div class="material-icons-outlined text-6xl text-gray-400">account_circle</div>
                                    </div>
                                    <div class="w-1/3 flex justify-start items-center">
                                        <div class="text-lg ml-10 my-4">Lorem ipsum dolor sit.</div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <div href="" class="bg-blue-600 rounded-full w-2/3 py-2 flex justify-center items-center">
                                            <div class="text-lg font-medium text-white">Supervisor</div>
                                        </div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <a href="" class="bg-white rounded-md w-2/3 py-2 border-2 border-gray-400 text-gray-400 flex justify-center items-center hover:text-white hover:border-transparent hover:bg-blue-600">
                                            <div class="text-lg font-medium">View</div>
                                        </a>
                                    </div>
                                </div>
                                <div id="row-blue" class="flex w-full justify-center">
                                    <div class="w-1/6 flex justify-center items-center">
                                        <div class="material-icons-outlined text-6xl text-gray-400">account_circle</div>
                                    </div>
                                    <div class="w-1/3 flex justify-start items-center">
                                        <div class="text-lg ml-10 my-4">Lorem ipsum dolor sit.</div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <div href="" class="bg-blue-600 rounded-full w-2/3 py-2 flex justify-center items-center">
                                            <div class="text-lg font-medium text-white">Supervisor</div>
                                        </div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <a href="" class="bg-white rounded-md w-2/3 py-2 border-2 border-gray-400 text-gray-400 flex justify-center items-center hover:text-white hover:border-transparent hover:bg-blue-600">
                                            <div class="text-lg font-medium">View</div>
                                        </a>
                                    </div>
                                </div>
                                <div id="row-blue" class="flex w-full justify-center">
                                    <div class="w-1/6 flex justify-center items-center">
                                        <div class="material-icons-outlined text-6xl text-gray-400">account_circle</div>
                                    </div>
                                    <div class="w-1/3 flex justify-start items-center">
                                        <div class="text-lg ml-10 my-4">Lorem ipsum dolor sit.</div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <div href="" class="bg-blue-600 rounded-full w-2/3 py-2 flex justify-center items-center">
                                            <div class="text-lg font-medium text-white">Supervisor</div>
                                        </div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <a href="" class="bg-white rounded-md w-2/3 py-2 border-2 border-gray-400 text-gray-400 flex justify-center items-center hover:text-white hover:border-transparent hover:bg-blue-600">
                                            <div class="text-lg font-medium">View</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="bottom-right" class="w-1/2 m-6">
                    <div id="table-id" class="text-4xl font-bold text-blue-600 py-4">Projects</div>
                    <div id="white-box" class="bg-white filter drop-shadow-lg rounded-xl p-2">
                        <div id="table" class="flex flex-col justify-center items-center bg-blue-600 bg-opacity-10 rounded-xl">
                            <div id="table-header" class="border-b-2 border-blue-600 flex w-full">
                                <div class="w-1/3 flex justify-center items-center">
                                    <div class="text-lg font-bold my-4">Name</div>
                                </div>
                                <div class="w-1/3 flex justify-center items-center">
                                    <div class="text-lg font-bold my-4">Type</div>
                                </div>
                                <div class="w-1/3 flex justify-center items-center">
                                    <div class="text-lg font-bold"></div>
                                </div>
                            </div>
                            <div id="table-content" class="w-full">
                                <div id="row" class="flex w-full">
                                    <div class="w-1/3 flex justify-start items-center">
                                        <div class="text-lg ml-10 my-4">Lorem ipsum dolor sit.</div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <div href="" class="bg-blue-600 rounded-full w-2/3 py-2 flex justify-center items-center">
                                            <div class="text-lg font-medium text-white">Internal</div>
                                        </div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <a href="" class="bg-white rounded-md w-2/3 py-2 border-2 border-gray-400 text-gray-400 flex justify-center items-center hover:text-white hover:border-transparent hover:bg-blue-600">
                                            <div class="text-lg font-medium">View</div>
                                        </a>
                                    </div>
                                </div>
                                <div id="row" class="flex w-full">
                                    <div class="w-1/3 flex justify-start items-center">
                                        <div class="text-lg ml-10 my-4">Lorem ipsum dolor sit.</div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <div href="" class="bg-blue-600 rounded-full w-2/3 py-2 flex justify-center items-center">
                                            <div class="text-lg font-medium text-white">Internal</div>
                                        </div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <a href="" class="bg-white rounded-md w-2/3 py-2 border-2 border-gray-400 text-gray-400 flex justify-center items-center hover:text-white hover:border-transparent hover:bg-blue-600">
                                            <div class="text-lg font-medium">View</div>
                                        </a>
                                    </div>
                                </div>
                                <div id="row" class="flex w-full">
                                    <div class="w-1/3 flex justify-start items-center">
                                        <div class="text-lg ml-10 my-4">Lorem ipsum dolor sit.</div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <div href="" class="bg-blue-600 rounded-full w-2/3 py-2 flex justify-center items-center">
                                            <div class="text-lg font-medium text-white">Internal</div>
                                        </div>
                                    </div>
                                    <div class="w-1/3 flex justify-center items-center">
                                        <a href="" class="bg-white rounded-md w-2/3 py-2 border-2 border-gray-400 text-gray-400 flex justify-center items-center hover:text-white hover:border-transparent hover:bg-blue-600">
                                            <div class="text-lg font-medium">View</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

<?php $this->partial('partials/footer') ?>
<?php $this->end(); ?>