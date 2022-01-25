<?php

use Core\FormHelpers;

$this->start('content') ?>
<script type="text/javascript" src="<?=ROOT?>app/js/modal.js"></script>
<body>
<div class="container mx-auto my-5 p-5">
    <h2 class="text-xl font-bold">Manage Coordinators</h2>
    <table class="table mt-5">
        <thead>
        <tr class="table-top-bar">
            <td colspan="3" class="td">
                <div class="table-search-container">
                     <span class="material-icons-outlined table-search-icon">
                        search
                     </span>
                    <input type="text" placeholder="Search" class="table-search-input w-full"/>
                </div>
            </td>
            <td class="border-none"></td>
        </tr>
        <tr class="table-body-tr">
            <th class="th">Name</th>
            <th class="th">Year</th>
            <th class="th">Role</th>
            <th class="th">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($this->coordinators)): ?>
            <?php
            $counter = 1;
            foreach ($this->coordinators as $user): ?>
                <tr class="border-none <?= $counter % 2 == 0 ? 'bg-blue-100' : 'bg-gray-100' ?>">
                    <td class="border-none"><?= $user->firstName ?> <?= $user->lastName ?></td>
                    <td class="border-none">Year <?= $user->year ?></td>
                    <td class="flex border-none items-center">
                        <?php foreach ($user->roles as $role): ?>
                            <div class="label-blue">
                                <?= $role ?>
                            </div>
                        <?php endforeach; ?>
                    </td>
                    <td class="border-none">
                        <div class="flex justify-center items-center">
                            <?= FormHelpers::selectBlock("", $user->user_id, $user->year, $this->options, ['class' => 'bg-gray-200 text-black p-2 rounded focus:outline-none mr-2'], ['class' => 'form-con'], []) ?>
                            <button class="ml-2 flex items-center bg-blue-600 text-sm rounded py-1 px-2 hover:bg-blue-300 text-white cursor-pointer" onclick="updateCoordinator(<?=$user->user_id?>)">
                                 <span class="material-icons-outlined">
                                edit
                                </span>
                                Change year
                            </button>
                            <button class="ml-2 flex items-center rounded py-1 px-2 text-sm bg-red-600 hover:bg-red-300 text-white cursor-pointer" onclick="confirmRemoveCoordinator(<?= $user->user_id ?>, <?=$user->year?>)">
                                <span class="material-icons-outlined">
                                delete
                                </span>
                                Remove
                            </button>
                        </div>
                    </td>
                </tr>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="border-none bg-gray-100 text-center text-sm normal-case font-bold">No results
                    found
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <h2 class="text-xl font-bold">Assign Coordinators</h2>
    <table class="table mt-5">
        <thead>
        <tr class="table-top-bar">
            <td colspan="3" class="td">
                <div class="table-search-container">
                     <span class="material-icons-outlined table-search-icon">
                        search
                     </span>
                    <input type="text" placeholder="Search" class="table-search-input w-full"/>
                </div>
            </td>
            <td class="border-none"></td>
        </tr>
        <tr class="table-body-tr">
            <th class="th">Name</th>
            <th class="th">Email</th>
            <th class="th">Role</th>
            <th class="th">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($this->users)): ?>
            <?php
            $counter = 1;
            foreach ($this->users as $user): ?>
                <tr class="border-none <?= $counter % 2 == 0 ? 'bg-blue-100' : 'bg-gray-100' ?>">
                    <td class="border-none"><?= $user->firstName ?> <?= $user->lastName ?></td>
                    <td class="border-none normal-case"><?= $user->email ?></td>
                    <td class="flex border-none items-center">
                        <?php foreach ($user->roles as $role): ?>
                            <div class="label-blue">
                                <?= $role ?>
                            </div>
                        <?php endforeach; ?>
                    </td>
                    <td class="border-none">
                        <div class="flex justify-center items-center">
                            <?= FormHelpers::selectBlock("", $user->user_id, '', $this->options, ['class' => 'bg-gray-200 text-black p-2 rounded focus:outline-none mr-2'], ['class' => 'form-con'], []) ?>
                            <button class="bg-red-600 rounded w-fit cursor-pointer py-1 px-2 text-sm text-white hover:bg-red-300"
                                    onclick="onAssign(<?= $user->user_id ?>)">Assign
                            </button>
                            <button class="bg-blue-600 rounded w-fit cursor-pointer py-1 px-2 text-sm text-white ml-3 hover:bg-blue-300">
                                View
                            </button>
                        </div>
                    </td>
                </tr>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="border-none bg-gray-100 text-center text-sm normal-case font-bold">No results
                    found
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
<script>
    function onAssign(user_id) {
        const year = document.getElementById(user_id).value;
        window.location.href = `<?=ROOT?>admin/assignUserAsCoordinator/${user_id}/${year}`;
    }
    function updateCoordinator(userid){
        const year = document.getElementById(userid).value;
        window.location.href = `<?=ROOT?>admin/updateCoordinator/${userid}/${year}`;
    }
    function confirmRemoveCoordinator(userid, year){
        triggerModal("Are you sure you want to remove this user as a coordinator", "This action will remove all coordinator privileges from this user and cannot be reversed.", "/admin/removeCoordinator/" + userid + "/" + year);
    }
</script>
<?php $this->end() ?>
