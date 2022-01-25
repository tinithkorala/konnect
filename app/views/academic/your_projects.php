<?php use Config\Config;
use Core\Router;

$this->start("content") ?>
<head>
  <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version'); ?>"/>
</head>
<body class="font-poppins">
<div class="container  mx-auto w-full mt-20">
  <div id="table">
      <table class="table">
          <thead>
          <tr class="table-top-bar">
              <td colspan="3" class="td">
                  <div class="table-search-container">
                     <span class="material-icons-outlined table-search-icon">
                        search
                     </span>
                      <input type="text" placeholder="Search" class="table-search-input"/>
                  </div>
              </td>
              <td colspan="2" class="border-none">
                  <div class="bg-blue-600 flex items-center justify-center p-3 rounded text-xl text-white">
                      <img src="<?= ROOT ?>app/images/plus.png" class="w-8">
                      <button class="ml-3" onclick="window.location.href='/project/create';"> Add project
                      </button>
                  </div>
              </td>
          </tr>
          <tr class="table-body-tr">
              <th class="th">Project Name</th>
              <th colspan="2" class="th">Status</th>
              <th class="th">Type</th>
              <th>
                <span class="material-icons-outlined table-actions-icon">
                more_horiz
                </span>
              </th>
          </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>
</div>
</body>
<?php $this->end() ?>
