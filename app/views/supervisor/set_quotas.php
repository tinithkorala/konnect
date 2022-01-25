<?php

use Config\Config;

$this->start("content"); ?>
<head>
  <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version'); ?>">
</head>
<body class="font-poppins">
  <div class="container  mx-auto w-full h-screen">
    <div class="bg-white h-3/4 mt-20 rounded-xl filter drop-shadow-lg">
      <!-- content -->
      <div class="h-full pl-10">
        <!-- title -->
        <div class="font-bold text-3xl pt-20">
          Set undertaking project quota per academic year
        </div>
        <!-- select area -->
          <div class="flex items-center">
            <!-- year -->
            <div class="text-2xl">
              Year
            </div>
            <!-- dropdown -->
            <div class="w-96">
              <button class="relative flex jutify-center items-center bg-white text-gray-600 rounded focus:outline-none focus:ring ring-gray-200 border shadow group w-full">
                <div class="px-4 w-80">Select the year</div>
                <span class="border-l hover:bg-gray-100 w-10 h-10">
                  <embed src="<?=ROOT?>app/images/dropdown-arrow.svg"/>
                </span>
                <div class="absolute top-full hidden group-focus:block min-w-full w-max bg-white shadow-md mt-1 rounded">
                  <ul class="text-left border rounded">
                    <li class="px-4 py-1 hover:bg-gray-100 border-b">
                      Year 2
                    </li>
                    <li class="px-4 py-1 hover:bg-gray-100 border-b">
                      Year 3
                    </li>
                    <li class="px-4 py-1 hover:bg-gray-100 border-b">
                      Year 4
                    </li>
                  </ul>
                </div>
              </button>
            </div>
          </div>
          <!-- quota -->
          <div class="flex items-center">
            <div class="text-2xl">
              Quota
            </div>
          </div>
      </div>
    </div>
  </div>
</body>

<?php $this->end() ?>
