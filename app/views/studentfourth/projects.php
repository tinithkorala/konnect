<?php

use Config\Config;

$this->start("content"); ?>

<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/studentfourth/projects.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
<div class="pagecontainer">
    <div class="Dsection">
        <h1>Your Projects</h1>
        <div class="sectiongrid">
            <div class="Dcard">
                <div class="Dbutton-cardcontainer">
                    <div class="content">
                        <p class="material-icons-outlined">add</p>
                    </div>
                    <div class="foot">
                        <button onclick="window.location.href='/project/create'">Create Project</button>
                    </div>
                </div>
            </div>

            <?php if (isset($this->projects)): ?>
                <?php foreach ($this->projects as $project): ?>
                    <div class="Dcard">
                        <div class="Dcardcontainer">
                            <div class="head">
                                <p> <?= $project->name ?> </p>
                                <span class="material-icons" id="icon1">delete_forever</span>
                            </div>
                            <div class="content">
                                <div class="row1col1">
                                    <p>Status</p>
                                </div>
                                <div class="row1col2" style="text-transform: capitalize">
                                    <p><?= $project->status ?></p>
                                </div>
                                <div class="row2col1">
                                    <p>Type</p>
                                </div>
                                <div class="row2col2">
                                    <p>External</p>
                                </div>
                                <div class="row3">
                                    <p><?= $project->description ?></p>
                                </div>
                            </div>
                            <div class="foot">
                                <button onclick="window.location.href='/project/view'">View Project</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
    <hr/>
    <div class="Dsection">
        <h1>Your Academic Project Groups</h1>
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
                            <p>Academic</p>
                        </div>
                        <div class="row3">
                            <p>A discription of project Recusandae veritatis repellat eum exercitationem unde,
                                dignissimos doloribus magni</p>
                        </div>
                    </div>
                    <div class="foot">
                        <button>View Group</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="Dsection">
        <h1>Your Research Project Groups</h1>
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
                            <p>A discription of project Recusandae veritatis repellat eum exercitationem unde,
                                dignissimos doloribus magni</p>
                        </div>
                    </div>
                    <div class="foot">
                        <button>View Group</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>
</body>

<?php $this->end() ?>
