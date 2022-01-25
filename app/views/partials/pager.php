<?php

use Core\Request;

$request = new Request();
$page = $request->get('p');
if (!$page || $page < 1) $page = 1;
$limit = $request->get('limit') ? $request->get('limit') : 25;
$totalPages = ceil($this->total / $limit);
$canGoBack = $page > 1;
$canGoForward = $page < $totalPages;
?>

<form action="" method="get" id="pagerform" onsubmit="return false;">
    <div class="flex justify-center items-center my-5">
        <input type="hidden" id="p" name="p" value="<?= $page ?>"/>
        <input type="hidden" name="limit" value="<?= $limit ?>"/>
        <button class="bg-blue-600 rounded text-white flex justify-center items-center p-1 <?= $canGoBack ? "" : "disabled" ?> "
                onclick="pager(<?= $page - 1 ?>)" disabled="<?=!$canGoBack ?>">
            <span class="material-icons-outlined">
            arrow_back_ios
            </span>
        </button>
        <div class="mx-3">
            <?= $page ?> / <?= $totalPages ?>
        </div>
        <button class="bg-blue-600 rounded text-white flex justify-center items-center p-1 <?= $canGoForward ? "" : "disabled" ?> "
                onclick="pager(<?= $page + 1 ?>)" disabled="<?= !$canGoForward ?>">
            <span class="material-icons-outlined">
            arrow_forward_ios
            </span>
        </button>
    </div>
</form>
<script>
    function pager(page) {
        document.getElementById('p').value = page;
        var form = document.getElementById('pagerform');
        form.submit();
    }
</script>