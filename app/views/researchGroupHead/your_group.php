<?php use Config\Config;
use Core\Router;

$this->start("content") ?>
<head>
  <link rel="stylesheet" href="<?= ROOT ?>app/css/research-head/your_group.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
  <div class="main-container">
  <div class="left">
    <div class="title">
      <h3>Group Name</h3>
    </div>
    <div class="your_projects">
          <!-- create project card -->
      <div class="card create-project">
        <span class="material-icons-outlined" style="font-size:6rem;">
          add
        </span>
        <button class="btn create-user-btn" onclick="window.location.href='#';">Create Project</button>
      </div>
          <!-- view project card -->
        <div class="card view-project">
            <div class="row1">
              <div class="cardtitle">
                      <p>Project Alpha</p>
              </div>
              <button type="button" class="delete-button">
                <span class="material-icons-outlined" style="font-size: 1.8rem;" id="icon">
                delete_forever
                </span>
              </button>
            </div>
            <div class="content-container">
              <div class="row1col1">
                  <p>Status</p>
              </div>
              <div class="row1col2">
                  <p>Ongoing</p>
              </div>
              <div class="row2col1">
                  <p>Type</p>
              </div>
              <div class="row2col2">
                <p>External</p>
              </div>
              <div class="row3">
                <p class="description">A small description about the project comes here.</p>
              </div>
            </div>
            <div class="view-button">
              <button class="button1">View Project</a></button>
            </div>
        </div>
  </div>
</div>

<!-- right side -->
<div class="right">
  <h3>Members</h3>
</div>
</div>
  </body>
<?php $this->end() ?>
