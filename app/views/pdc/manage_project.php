<?php

$this->start("content"); ?>
    <div class="container  mx-auto w-full mt-20">
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
                <th colspan="2" class="th">Project Name</th>
                <th class="th">Status</th>
                <th colspan="2" class="th">project</th>
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
            foreach ($this->projects as $project): ?>
                <tr class="border-none <?= $counter % 2 == 0 ? 'bg-blue-100' : 'bg-gray-100' ?>">
                    <td class="border-none"><?= $project->project_name ?></td>
                    <td class="border-none">
                        <div class="<?php if ($project->status === 'closed'): ?>label-yellow<?php elseif ($project->status == 'ongoing'): ?>label-blue<?php else: ?>label-red<?php endif; ?>">
                            <?= $project->status ?>
                        </div>
                    </td>
                    <td  class="border-none"></td>
                    <td class="border-none">
                        <div class="flex justify-center">
                        <span class="material-icons-outlined table-edit-button">
                        edit
                        </span>
                            <a href="#">
                            <span class="material-icons-outlined table-block-button">
                                block
                            </span>
                            </a>
                            <span class="material-icons-outlined table-delete-button"
                                >
                        delete
                        </span>
                        </div>
                    </td>
                </tr>
                <?php $counter++; ?>
            <?php endforeach; ?>
            <?php if ($counter == 1): ?>
                <tr class="bg-gray-100">
                    <td colspan="6" class="text-normal text-sm text-center normal-case"> No projects found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $this->end() ?>