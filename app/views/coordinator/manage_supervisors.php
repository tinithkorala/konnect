<?php

$this->start("content") ?>
<div class="container  mx-auto w-full">
    <!-- table 1 -->
    <div class="mt-10">
        <div class="text-2xl font-bold">
            Currently assigned
        </div>
        <!-- projects table -->
        <div id="table">
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
                </tbody>
            </table>
        </div>
    </div>

    <!-- table 2 -->
    <div class="mt-20">
        <div class="text-2xl font-bold">
            Assign new supervisor
        </div>
        <!-- Academic users table -->
        <div id="table">
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
                    </td>
                </tr>
                <tr class="table-body-tr">
                    <th colspan="2" class="th">Name</th>
                    <th colspan="2" class="th">Position</th>
                    <th class="th">Email</th>
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
                foreach ($this->academic_users as $user): ?>
                    <tr class="border-none <?= $counter % 2 == 0 ? 'bg-blue-100' : 'bg-gray-100' ?>">
                        <td colspan="2" class="border-none text-center"><?= $user->firstName ?> <?= $user->lastName ?></td>
                        <td colspan="2" class="border-none items-center text-center">
                            <div class="label-blue">
                                <?= $user->position ?>
                            </div>
                        </td>
                        <td class="border-none normal-case"><?= $user->email ?></td>
                        <td class="border-none">
                            <div class="flex justify-center">
                        <span class="material-icons-outlined text-green-500">
                        assignment_turned_in
                        </span>
                            </div>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                <?php endforeach; ?>
                <?php if ($counter == 1): ?>
                    <tr class="bg-gray-100">
                        <td colspan="5" class="text-normal text-sm text-center normal-case"> No users found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $this->end() ?>
