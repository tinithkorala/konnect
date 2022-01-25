<?php use Config\Config;
use Core\FormHelpers;

?>
<?php $this->start('content') ?>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/admin/admin-users.css?v=<?= Config::get('version'); ?>"/>
</head>
<body>
<div class="container mx-auto mt-10">
    <h1 class="font-bold text-xl">Add User</h1>
    <div class="mt-5 py-5 px-10 bg-white drop-shadow-lg rounded-lg">
        <div class="mt-2">
            <h3 class="text-lg font-semibold tracking-wide border-b-2 border-gray-300">Upload a file containing user
                details</h3>
            <form method="post" enctype="multipart/form-data">
                <?=FormHelpers::csrfField()?>
                <div class="flex flex-row mt-4 mb-8">
                    <div class="max-w-2xl rounded-lg bg-gray-50">
                        <div class="m-4">
                            <label class="inline-block mb-2 text-gray-500">File Upload</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col w-full h-32 border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300 cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                            Attach a file</p>
                                    </div>
                                    <?=FormHelpers::fileUpload("userDetails", ['class' => 'opacity-0', 'onchange' => 'onInput()', 'accept' => '.csv'], $this->uploadErrors)?>
                                    <div class="hidden flex flex-row justify-center items-center text-gray-400" id="uploaded_file">
                                        <span class="material-icons-outlined"> description </span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="ml-5 flex flex-col justify-start">
                        <?= FormHelpers::selectBlock("User Type", "type", "", ['' => '', 'academic' => 'Academic', 'student' => 'Student'], ['class' => 'form-control font-normal focus:outline-none', 'onchange' => 'onSelect(this)'], ['class' => 'mt-2'], $this->uploadErrors) ?>
                        <?= FormHelpers::selectBlock("Year", "student_year", '', $this->years, ['class' => 'form-control font-normal focus:outline-none', 'id' => 'student_year'], ['class' => 'mt-2 hidden', 'id' => 'student_year'], $this->uploadErrors) ?>
                        <button type="submit" class="bg-blue-600 text-white w-fit mt-3 p-2 rounded shadow-md hover:bg-blue-300" name="user_upload">Submit</button>
                        <p class="text-red-500 text-xs mt-2"> *If uploading student details, please ensure that the columns
                            in the file are in the order
                            -> Registration Number, Index Number, First Name, Last Name, Email</p>
                    </div>
                </div>
            </form>
        </div>
        <div class="mt-12">
            <h3 class="text-lg font-semibold tracking-wide border-b-2 border-gray-300">Create a new user</h3>
            <form method="POST">
                <div class="grid grid-cols-2">
                    <?= FormHelpers::csrfField(); ?>
                    <?= FormHelpers::inputBlock('First Name', 'firstName', $this->user->firstName, ['class' => 'form-control', 'placeholder' => 'First Name'], ['class' => 'form-con'], $this->errors) ?>
                    <?= FormHelpers::inputBlock('Last Name', 'lastName', $this->user->lastName, ['class' => 'form-control', 'placeholder' => 'Last Name'], ['class' => 'form-con'], $this->errors) ?>
                    <?= FormHelpers::inputBlock('Email Address', 'email', $this->user->email, ['class' => 'form-control', 'placeholder' => 'Email Address', 'type' => 'email'], ['class' => 'form-con'], $this->errors) ?>
                    <?= FormHelpers::selectBlock("User Type", "user_type", $this->user->user_type, $this->role_options, ['class' => 'form-control', 'onchange' => 'onChange(event.target.value)'], ['class' => 'form-con'], $this->errors) ?>
                </div>
                <div class="sub-forms mt-30" id="student-form">
                    <hr class="mb-30"/>
                    <h3>Student Details</h3>
                    <div class="form mt-30">
                        <?= FormHelpers::inputBlock('Index Number', 'index_number', '', ['class' => 'form-control', 'placeholder' => 'Index Number'], ['class' => 'form-con'], $this->errors) ?>
                        <?= FormHelpers::inputBlock('Registration Number', 'reg_number', '', ['class' => 'form-control', 'placeholder' => 'Registration Number'], ['class' => 'form-con'], $this->errors) ?>
                        <?= FormHelpers::selectBlock("Year", "year", '', $this->years, ['class' => 'form-control'], ['class' => 'form-con'], $this->errors) ?>
                        <?= FormHelpers::selectBlock("Stream", "stream", '', $this->streams, ['class' => 'form-control'], ['class' => 'form-con'], $this->errors) ?>
                    </div>
                </div>
                <div class="sub-forms mt-30" id="academic-form">
                    <hr class="mb-30"/>
                    <h3>Academic Staff Details</h3>
                    <div class="form mt-30">
                        <?= FormHelpers::inputBlock('Position', 'position', '', ['class' => 'form-control', 'placeholder' => 'Position'], ['class' => 'form-con'], $this->errors) ?>
                        <?= FormHelpers::inputBlock('Staff Code', 'staff_code', '', ['class' => 'form-control', 'placeholder' => 'Staff Id'], ['class' => 'form-con'], $this->errors) ?>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end">
                    <button type="reset" class="bg-blue-600 text-white w-fit mt-3 p-2 rounded shadow-md hover:bg-blue-300 mr-1">Reset</button>
                    <button type="submit" class="bg-blue-600 text-white w-fit mt-3 p-2 rounded shadow-md hover:bg-blue-300" name="create_user">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', () => {
        let selectedValue = document.getElementById('user_type').value;
        if (selectedValue) onChange(selectedValue);
    });

    function onChange(e) {
        let forms = document.querySelectorAll("div.sub-forms");
        forms.forEach(form => {
            form.style.display = "none";
        });
        let form = document.getElementById(e + '-form');
        if (form) form.style.display = 'grid';
    }

    function onInput(){
        const file = document.getElementById("userDetails").files[0].name;
        const fileDiv = document.getElementById("uploaded_file");
        if(fileDiv.childNodes.length > 2) fileDiv.removeChild(fileDiv.childNodes[fileDiv.childNodes.length-1]);
        const filename = document.createElement("p");
        filename.classList.add("text-sm")
        filename.innerHTML += file;
        fileDiv.appendChild(filename);
        fileDiv.classList.remove("hidden");
    }

    function onSelect(e){
        const dropdown = document.getElementById("student_year");
        if(e.value === 'student'){
            dropdown.classList.remove("hidden");
        }
        else if(e.value === 'academic' && !dropdown.classList.contains("hidden")) dropdown.classList.add("hidden");
    }
</script>
</body>
<?php $this->end(); ?>
