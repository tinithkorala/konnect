<?php

use Config\Config;
use Core\FormHelpers;

$this->start('content') ?>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/admin/admin-users.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
<div class="card" style="margin: 30px;">
    <h1 style="margin: 20px;">Create Research Group</h1>
    <form method="POST">
        <div class="form">
            <?= FormHelpers::csrfField() ?>
            <?= FormHelpers::inputBlock("Research Group Name", "name", "", ["class" => "form-control", "placeholder" => "Enter Research Group name"], ["class" => "form-con"], $this->errors); ?>
            <?= FormHelpers::selectBlock("Head of Group", "group_head", "", $this->options, ['class' => 'form-control'], ['class' => 'form-con'], $this->errors) ?>
        </div>
        <div style="display: flex; justify-content: flex-end">
            <button type="reset" class="btn" style="width: 20%; margin-right: 30px;">Reset</button>
            <button type="submit" class="btn" style="width: 20%">Submit</button>
        </div>
    </form>
</div>
</body>
<?php $this->end() ?>
