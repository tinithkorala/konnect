<?php use Config\Config;
use Core\Router;

$this->start("content") ?>
<head>
  <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
<div class="container  mx-auto w-full mt-20">
    <div id="table">
        <table class="table">
            <thead>
            <tr class="table-top-bar">
                <td colspan="4" class="td">
                    <div class="table-search-container">
                     <span class="material-icons-outlined table-search-icon">
                        search
                     </span>
                        <input type="text" placeholder="Search" class="table-search-input"/>
                    </div>
                </td>
                <td colspan="2" class="border-none">
                </td>
            </tr>
            <tr class="table-body-tr">
                <th class="th">Name</th>
                <th colspan="2" class="th">Year</th>
                <th class="th">Project</th>
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
