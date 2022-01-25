<?php use Config\Config;
use Core\FormHelpers;

?>
<?php $this->start('content'); ?>
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Register external company</title>
        <link rel="stylesheet" href="<?= ROOT ?>app/css/auth/register.css?v=<?= Config::get('version'); ?>"/>
        <link rel="stylesheet" href="<?= ROOT ?>app/css/styles.css?v=<?= Config::get('version'); ?>"/>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ultra&display=swap"
              rel="stylesheet">
    </head>
    <body style="font-family: 'Poppins', 'sans-serif';" >
        <div>
            <div class="relative grid min-h-screen">
                <div
                class="flex flex-col items-center flex-auto min-w-0 sm:flex-row md:items-start sm:justify-center md:justify-start"
                >
                    <div
                        class="relative items-center justify-center flex-auto hidden h-full p-10 overflow-hidden text-white bg-no-repeat bg-cover sm:w-1/2 md:flex"
                    >
                        <div class="absolute inset-0 z-0">
                            <h1 class="pt-8 pl-10 logo">Konnect</h1>
                            <p class="pt-20 pl-10 mb-32 text-3xl font-bold tracking-widest text-black uppercase">We have a plethora of <br /> opportunities</p>
                        </div>
                        <div class="mt-60">
                            <img src="<?= ROOT ?>app/images/login.png" />
                            <p class="pt-20 pl-10 mb-32 text-xl font-bold tracking-widest text-right text-blue-600">Collaborate with us</p>
                        </div>
                        
                    </div>
                <div
                    class="w-full h-full p-8 bg-blue-600 rounded-corners md:flex md:items-center md:justify-left sm:w-auto md:h-full xl:w-3/5 md:p-10 lg:p-14"
                >
                    <form method="POST" class="w-full">
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <?= FormHelpers::csrfField() ?>
                            <?= FormHelpers::inputBlock("Company Name: ", "company_name", $this->user->company_name, ['class' => 'text-black focus:outline-none rounded p-2 w-full ', 'placeholder' => 'Enter company name'], ['class' => 'flex flex-col text-white px-8 my-3'], $this->errors); ?>                    
                            <?= FormHelpers::inputBlock("Contact Number: ", "contact_number", $this->user->contact_number, ['class' => 'text-black focus:outline-none rounded p-2 w-full', 'placeholder' => 'Enter contact number'], ['class' => 'flex flex-col text-white px-8 my-3'], $this->errors); ?>
                            <?= FormHelpers::inputBlock("Company Representative's First Name: ", "firstName", $this->user->firstName, ['class' => 'text-black focus:outline-none rounded p-2 w-full', 'placeholder' => 'Enter first name'], ['class' => 'flex flex-col text-white px-8 my-3'], $this->errors); ?>
                            <?= FormHelpers::inputBlock("Last Name: ", "lastName", $this->user->lastName, ['class' => 'text-black focus:outline-none rounded p-2 w-full', 'placeholder' => 'Enter last name'], ['class' => 'flex flex-col text-white px-8 my-3'], $this->errors); ?>
                            <?= FormHelpers::inputBlock("Email Address: ", "email", $this->user->email, ['class' => 'text-black focus:outline-none rounded p-2 w-full', 'placeholder' => 'Enter email address'], ['class' => 'flex flex-col text-white px-8 my-3'], $this->errors); ?>
                            <?= FormHelpers::inputBlock("Website: ", "website", $this->user->website, ['class' => 'text-black focus:outline-none rounded p-2 w-full', 'placeholder' => 'Enter website'], ['class' => 'flex flex-col text-white px-8 my-3'], $this->errors); ?>
                            <?= FormHelpers::inputBlock("Password: ", "password", $this->user->password, ['type' => 'password', 'class' => 'text-black focus:outline-none rounded p-2 w-full', 'placeholder' => 'Enter password'], ['class' => 'flex flex-col text-white px-8 my-3'], $this->errors); ?>
                            <?= FormHelpers::inputBlock("Confirm Password: ", "confirmPassword", $this->user->confirmPassword, ['type' => 'password', 'class' => 'text-black focus:outline-none rounded p-2 w-full', 'placeholder' => 'Enter password again'], ['class' => 'flex flex-col text-white px-8 my-3'], $this->errors); ?>
                        </div>
                        <div class="mt-10 text-center">
                            <button type="submit"
                                    class="w-2/5 p-2 font-bold text-center text-blue-600 transform bg-white rounded shadow hover:scale-105">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
<?php $this->end(); ?>
