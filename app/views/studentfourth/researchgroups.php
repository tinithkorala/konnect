<?php

use Config\Config;
use Core\Router;

$this->start("content"); ?>

<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/studentfourth/researchgroups.css?v=<?= Config::get('version'); ?>"/> 
</head>
<body>
    <div class="pagecontainer">
        <div class="head">
            <h1>Your Research Groups</h1>
        </div>
        <div class="sectiongrid">
            <div class="Dcard">
                <div class="Dcardcontainer">
                    <div class="head">
                        <p>Group Name</p>
                    </div>
                    <div class="content">
                        <div class="row1col1">
                            <p>Status</p>
                        </div>
                        <div class="row1col2">
                            <p>Active</p>
                        </div>
                        <div class="row2col1">
                            <p>Type</p>
                        </div>
                        <div class="row2col2">
                            <p>Research</p>
                        </div>
                        <div class="row3">
                            <p>A discription of project Recusandae veritatis repellat eum exercitationem unde, dignissimos doloribus magni</p>
                        </div>
                    </div>
                    <div class="foot">
                        <button onclick="window.location.href='/researchgroup/view'">View Group</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php $this->end() ?>
