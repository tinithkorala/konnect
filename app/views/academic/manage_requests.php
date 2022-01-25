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
            <tr class="table-body-tr">
                <th class="th">Name</th>
                <th colspan="2" class="th">Year</th>
                <th class="th">Project</th>
                <th>
                <span class="material-icons-outlined table-actions-icon">
                more_horiz
                </span>
                </th>
                <th>
                <span class="material-icons-outlined table-actions-icon">
                more_horiz
                </span>
                </th>
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
<?php $this->end(); ?>
