<?php use Config\Config;
use Core\Router;

$this->start("content") ?>
<head>
  <link rel="stylesheet" href="<?= ROOT ?>app/css/coordinator/edit_submission_dates.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
  <div class="main-container" style="margin: 20px">
    <div class="content-container">
      <div class="event">
        <p>Find supervisors phase</p>
      </div>
      <div class="dates">
        <input type="date" class="edit-date">
      </div>
      <div class="event">
        <p>Project Proposal</p>
      </div>
      <div class="dates">
        <input type="date" class="edit-date">
      </div>
      <div class="event">
        <p>SRS Documentation</p>
      </div>
      <div class="dates">
        <input type="date" class="edit-date">
      </div>
      <div class="event">
        <p>Interim Presentation</p>
      </div>
      <div class="dates">
        <input type="date" class="edit-date">
      </div>
      <div class="event">
        <p>Final Presentation</p>
      </div>
      <div class="dates">
        <input type="date" class="edit-date">
      </div>
      <div class="save-button">
        <button type="button" class="sv-button">save</button>
      </div>
    </div>
  </div>
</body>
<?php $this->end() ?>
