<?php use Config\Config;

$this->start("content") ?>
<head>
    <link rel="stylesheet"
          href="<?= ROOT ?>app/css/research-head/research_groups.css?v=<?= Config::get('version'); ?>"/>
    <link rel="stylesheet"
          href="<?= ROOT ?>app/css/academicstaff/research_groups.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
<div class="main-container">
    <div class="title">
        <h3>Groups you manage</h3>
    </div>
    <div class="top">
        <div class="card view-group">
            <div class="cardtitle">
                <p>Group Name</p>
            </div>
            <div class="content-container">
                <div class="row1col1">
                    <p>Status</p>
                </div>
                <div class="row1col2">
                    <p>Ongoing</p>
                </div>
                <div class="row2col1">
                    <p>Research area</p>
                </div>
                <div class="row2col2">
                    <p>Artificial Intelligence</p>
                </div>
                <div class="row3">
                    <p class="description">A small description about the group comes here.</p>
                </div>
            </div>
            <div class="view-button">
                <button class="button1" onclick="window.location.href='/researchGroupHead/your_group';">View Group
                </button>
            </div>
        </div>
    </div>
    <div class="title">
        <h3>Groups you've joined</h3>
    </div>
    <div class="bottom">
        <div class="card view-group">
            <div class="cardtitle">
                <p>Group Name</p>
            </div>
            <div class="content-container">
                <div class="row1col1">
                    <p>Status</p>
                </div>
                <div class="row1col2">
                    <p>Ongoing</p>
                </div>
                <div class="row2col1">
                    <p>Research area</p>
                </div>
                <div class="row2col2">
                    <p>Artificial Intelligence</p>
                </div>
                <div class="row3">
                    <p class="description">A small description about the group comes here.</p>
                </div>
            </div>
            <div class="view-button">
                <button class="button1">View Group</a></button>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->end() ?>
