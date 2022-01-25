<?php

use Config\Config;

$this->start('content') ?>

<?php $this->partial('partials/navbar') ?>

<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version') ?>">
</head>

<body class="font-poppins">
    <div id="container-center" class="flex justify-center items-center">
        <div id="main-container" class="container">
            <div id="white-box" class="bg-white my-14 px-14 rounded-3xl filter drop-shadow-lg pb-10">
                <div id="Project-titele" class="text-5xl font-semibold py-10">Project Alpha</div>
                <div id="Project-content" class="flex flex-col pb-10">
                    <div class="flex py-2">
                        <div class="w-1/5 text-xl">Project Description</div>
                        <div class="w-4/5 text-xl">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente repudiandae ipsam eius aliquam impedit. Soluta, corporis et! Illo veritatis, rerum aliquam excepturi neque possimus magnam at saepe quo nemo? Inventore, facilis iusto voluptatem eaque possimus fugit aliquid atque reprehenderit deserunt, placeat quasi explicabo! Fugiat laborum fugit autem velit, error facilis!</div>
                    </div>
                    <div class="flex py-2">
                        <div class="text-xl w-1/5 mt-2">Interests</div>
                        <div class="w-4/5 flex flex-wrap">
                            <div id="tag" class="px-4 text-lg m-2 text-center bg-gray-300 rounded-lg">#Python</div>
                            <div id="tag" class="px-4 text-lg m-2 text-center bg-gray-300 rounded-lg">#Lorem-ipsum.</div>
                            <div id="tag" class="px-4 text-lg m-2 text-center bg-gray-300 rounded-lg">#Lorem-ipsum-dolor.</div>
                            <div id="tag" class="px-4 text-lg m-2 text-center bg-gray-300 rounded-lg">#Python Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, ducimus!</div>
                            <div id="tag" class="px-4 text-lg m-2 text-center bg-gray-300 rounded-lg">#Python</div>
                            <div id="tag" class="px-4 text-lg m-2 text-center bg-gray-300 rounded-lg">#Python</div>
                            <div id="tag" class="px-4 text-lg m-2 text-center bg-gray-300 rounded-lg">#Python</div>
                        </div>
                    </div>
                </div>
                <div id="table-id" class="text-3xl font-medium pb-10">Members</div>
                <div id="table" class="flex flex-col justify-center items-center bg-blue-600 bg-opacity-10 rounded">
                    <div id="table-header" class="border-b-2 border-blue-600 flex w-full">
                        <div class="w-1/4 flex justify-center items-center">
                            <div class="text-lg font-bold py-4">Name</div>
                        </div>
                        <div class="w-1/4 flex justify-center items-center">
                            <div class="text-lg font-bold py-4">Role</div>
                        </div>
                        <div class="w-2/4 flex justify-center items-center">
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
                            <div class="w-2/4 flex justify-center items-center">
                                <a href="" class="bg-blue-600 rounded-xl w-1/3 py-2 flex justify-center items-center hover:opacity-80">
                                    <div class="text-lg font-bold text-white">View</div>
                                </a>
                            </div>
                        </div>
                        <div id="row" class="flex w-full">
                            <div class="w-1/4 flex justify-start items-center">
                                <div class="text-lg ml-10 py-4">Lorem ipsum dolor sit.</div>
                            </div>
                            <div class="w-1/4 flex justify-start items-center">
                                <div class="text-lg ml-10 py-4">Lorem ipsum dolor sit.</div>
                            </div>
                            <div class="w-2/4 flex justify-center items-center">
                                <a href="" class="bg-blue-600 rounded-xl w-1/3 py-2 flex justify-center items-center hover:opacity-80">
                                    <div class="text-lg font-bold text-white">View</div>
                                </a>
                            </div>
                        </div>
                        <div id="row" class="flex w-full">
                            <div class="w-1/4 flex justify-start items-center">
                                <div class="text-lg ml-10 py-4">Lorem ipsum dolor sit.</div>
                            </div>
                            <div class="w-1/4 flex justify-start items-center">
                                <div class="text-lg ml-10 py-4">Lorem ipsum dolor sit.</div>
                            </div>
                            <div class="w-2/4 flex justify-center items-center">
                                <a href="" class="bg-blue-600 rounded-xl w-1/3 py-2 flex justify-center items-center hover:opacity-80">
                                    <div class="text-lg font-bold text-white">View</div>
                                </a>
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