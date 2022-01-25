<?php

use Config\Config;
use Core\FormHelpers;

$this->start('content') ?>
    <head>
        <link rel="stylesheet" href="<?= ROOT ?>app/css/coordinator/create_groups.css?v=<?= Config::get('version') ?>"/>
    </head>
    <body>
    <div class="body-container">
        <form class="form card" method="POST">
            <h3>Create Student Groups</h3>
            <div class="form-con">
                <label class="file-btn">
                    <span class="material-icons-outlined" style="font-size: 2.3rem !important;">
                        file_upload
                    </span>
                    Browse files..
                    <input type="file" style="display: none" id="file"/>
                </label>
            </div>
            <hr/>
            <?= FormHelpers::csrfField() ?>
            <?= FormHelpers::inputBlock("Group name", "name", "", ["class" => "form-control", "placeholder" => "Enter the group name"], ["class" => "form-con"], $this->errors); ?>
            <h3>Group Members</h3>
            <div class="member-container">
                <?= FormHelpers::selectBlock("Member 1", "member1", $this->group->member1, $this->options, ["class" => "form-control"], ["class" => "form-con"], $this->errors); ?>
                <?= FormHelpers::selectBlock("Member 2", "member2", $this->group->member2, $this->options, ["class" => "form-control"], ["class" => "form-con"], $this->errors); ?>
                <?= FormHelpers::selectBlock("Member 3", "member3", $this->group->member3, $this->options, ["class" => "form-control"], ["class" => "form-con"], $this->errors); ?>
                <?= FormHelpers::selectBlock("Member 4", "member4", $this->group->member4, $this->options, ["class" => "form-control"], ["class" => "form-con"], $this->errors); ?>
                <?= FormHelpers::selectBlock("Member 5", "member5", $this->group->member5, $this->options, ["class" => "form-control"], ["class" => "form-con"], $this->errors); ?>
            </div>
            <div class="button-container">
                <button class="btn" type="reset">Reset</button>
                <button class="btn" type="submit">Submit</button>
            </div>
        </form>
    </div>
    </body>
<?php $this->end() ?>