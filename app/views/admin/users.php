<?php

$this->start("content") ?>
<script type="text/javascript" src="<?=ROOT?>app/js/modal.js"></script>
<div class="grid-container cols-3" style="padding: 50px;">
    <div class="card create-user-card">
        <i class="material-icons-outlined" style="font-size: 5rem;">
            add
        </i>
        <button class="btn create-user-btn" onclick="window.location.href='/admin/create_user';">Create User
        </button>
    </div>
    <div class="card create-user-card">
        <i class="material-icons-outlined" style="font-size: 5rem;">
            add
        </i>
        <button class="btn create-user-btn" onclick="window.location.href='/admin/assign_coordinators';">Assign
            Coordinators
        </button>
    </div>
</div>
<div class="mx-5">
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
                <div class="table-add-button-container">
                    <button class="btn table-add-button" onclick="window.location.href='/admin/create_user'">
                        <span class="pr-2 material-icons-outlined">
                        add_circle_outline
                        </span>
                        Add User
                    </button>
                </div>
            </td>
        </tr>
        <tr class="table-body-tr">
            <th class="th">Name</th>
            <th colspan="2" class="th">Email</th>
            <th class="th">Roles</th>
            <th class="th">Status</th>
            <th>
                <span class="material-icons-outlined table-actions-icon">
                more_horiz
                </span>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        $counter = 1;
        foreach ($this->users as $user): ?>
            <tr class="border-none <?= $counter % 2 == 0 ? 'bg-blue-100' : 'bg-gray-100' ?>">
                <td class="border-none"><?= $user->firstName ?> <?= $user->lastName ?></td>
                <td colspan="2" class="normal-case border-none"><?= $user->email ?></td>
                <td class="flex items-center border-none">
                    <?php foreach ($user->roles as $role): ?>
                        <div class="label-blue">
                            <?= $role ?>
                        </div>
                    <?php endforeach; ?>
                </td>
                <td class="border-none">
                    <div class="<?php if ($user->status === 'blocked'): ?>label-yellow<?php elseif ($user->status == 'active'): ?>label-blue<?php else: ?>label-red<?php endif; ?>">
                        <?= $user->status ?>
                    </div>
                </td>
                <td class="border-none">
                    <div class="flex justify-center">
                        <span class="material-icons-outlined table-edit-button">
                        edit
                        </span>
                        <a href="<?= ROOT ?>admin/toggleBlockUser/<?= $user->user_id ?>">
                            <span class="material-icons-outlined table-block-button">
                                block
                            </span>
                        </a>
                        <span class="material-icons-outlined table-delete-button" onclick="confirmDelete(<?=$user->user_id?>)">
                            delete
                        </span>
                    </div>
                </td>
            </tr>
            <?php $counter++; ?>
        <?php endforeach; ?>
        <?php if ($counter == 1): ?>
            <tr class="bg-gray-100">
                <td colspan="5" class="text-sm text-center normal-case text-normal"> No users found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php $this->partial('partials/pager'); ?>
</div>
<script>
    function confirmDelete(userid){
        triggerModal("Are you sure you want to delete this user?", "This action will delete the user and cannot be reversed. If you want to stop activity on this account, consider blocking it instead", `/admin/deleteUser/${userid}`);
    }
</script>
<?php $this->end(); ?>
