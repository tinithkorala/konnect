<?php use Config\Config;

$this->start("content") ?>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/admin/admin-users.css?v=<?= Config::get('version'); ?>"/>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/studentfourth/researchgroups.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
<div class="grid-container cols-3" style="padding: 50px;">
    <div style="display: flex; justify-content: center; align-content: center;">
        <div class="card create-user-card">
            <i class="material-icons-outlined" style="font-size: 5rem;">
                add
            </i>
            <button class="btn create-user-btn" onclick="window.location.href='/admin/create_group';">Create Group
            </button>
        </div>
    </div>
    <?php foreach ($this->groups as $group): ?>
        <div class="card" style="display: flex; flex-direction: column;  width: 100%; padding: 10px; max-width: 350px; margin-bottom: 30px;">
            <div style="margin: 10px;">
                <h4> <?= $group->name ?> </h4>
            </div>
            <div style="display: flex; flex-direction: row; width: 100%; justify-content: space-between; padding: 20px;">
                <p>Status</p>
                <p style="text-transform: capitalize; color: limegreen; font-weight: bold;"> <?= $group->status ?> </p>
            </div>
            <div style="display: flex; flex-direction: row; width: 100%; justify-content: space-between; padding: 20px;">
                <p style="display: flex; justify-content: center; align-items: center;">
                    <span class="material-icons-outlined">
                        local_offer
                    </span>Type
                </p>
                <p style="text-transform: capitalize; font-weight: bold;"> Research </p>
            </div>
            <div style="overflow: hidden; padding: 10px;">
                <p><?php if (isset($group->description)): echo $group->description; else: echo "This group does not have a description yet"; ?><?php endif; ?> </p>
            </div>
            <div>
                <button class="btn" onclick="window.location.href='/researchgroup/view';">View Group</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
<?php $this->end(); ?>
</html>
