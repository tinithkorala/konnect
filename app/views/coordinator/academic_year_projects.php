<?php use Config\Config;

$this->start("content") ?>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
<!-- card section -->
<div class="flex">
    <div class="flex flex-col items-center justify-between bg-white rounded-lg shadow w-1/5 mt-10 ml-10 p-5 h-56">
        <div class="h-3/4 flex justify-center items-center">
            <span class="text-6xl material-icons-outlined">add</span>
        </div>
        <a href="/coordinator/create_groups">
            <div class="bg-blue-600 rounded p-2 text-white cursor-pointer hover:bg-blue-400 hover:font-bold">Create
                Student
                Groups
            </div>
        </a>
    </div>
    <div class="flex flex-col items-center justify-between bg-white rounded-lg shadow w-1/5 mt-10 ml-10 p-5 h-56">
        <div class="h-3/4 flex justify-center items-center">
            <span class="text-6xl material-icons-outlined">add</span>
        </div>
        <div class="bg-blue-600 rounded p-2 text-white cursor-pointer hover:bg-blue-400 hover:font-bold">Add/Edit
            Milestones
        </div>
    </div>
</div>


<!-- table section -->

<div class="container  mx-auto w-full mt-20">
    <h2 class="font-bold text-xl mb-2">All Student Groups</h2>
    <!-- student groups table -->
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
                <th colspan="2" class="th">Year</th>
                <th class="th">Project</th>
                <th class="th">Type</th>
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

</body>
<?php $this->end() ?>
