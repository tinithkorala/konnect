<?php

$this->start("content"); ?>
<script type="text/javascript" src="<?=ROOT?>app/js/modal.js"></script>
    <div class="container w-full mx-auto mt-20">
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
                <th class="th">Company Name</th>
                <th class="th">Representative Name</th>
                <th class="th">Email</th>
                <th class="th">Website</th>
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
            foreach ($this->companies as $company): ?>
                <tr class="border-none <?= $counter % 2 == 0 ? 'bg-blue-100' : 'bg-gray-100' ?>">
                    <td class="border-none"><?= $company->company_name ?></td>
                    <td class="border-none"><?= $company->firstName ?> <?= $company->lastName ?>  </td>
                    <td class="normal-case border-none"><?= $company->email ?></td>
                    <td class="flex normal-case border-none">
                        <?= $company->website ?>
                    </td>
                    <td class="border-none">
                        <div class="<?php if ($company->status === 'blocked'): ?>label-yellow<?php elseif ($company->status == 'active'): ?>label-blue<?php else: ?>label-red<?php endif; ?>">
                            <?= $company->status ?>
                        </div>
                    </td>
                    <td class="border-none">
                        <div class="flex justify-center">
                            <span class="material-icons-outlined table-edit-button">
                                edit
                            </span>
                            <?php if (in_array($company->status, array("blocked", "pending"))): ?>
                            <span class="material-icons-outlined table-accept-button" onclick="confirmVerify(<?=$company->user_id?>)">
                                check_circle
                            </span>
                            <?php endif; 
                            if (in_array($company->status, array("active", "pending"))): ?>
                            <span class="material-icons-outlined table-block-button" onclick="confirmBlock(<?=$company->user_id?>)">
                                block
                            </span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php $counter++; ?>
            <?php endforeach; ?>
            <?php if ($counter == 1): ?>
                <tr class="bg-gray-100">
                    <td colspan="5" class="text-sm text-center normal-case text-normal"> No companies found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>


<script>
    function confirmVerify(userid){
        triggerModal("Are you sure you want to verify this company?", "This action will verify the selected company", `/pdc/changeCompanyStatus/${userid}/active`);
    }

    function confirmBlock(userid){
        triggerModal("Are you sure you want to block this company?", "This action will block the selected company", `/pdc/changeCompanyStatus/${userid}/blocked`);
    }
</script>

<?php $this->end() ?>