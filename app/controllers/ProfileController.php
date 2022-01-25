<?php

namespace App\Controllers;

use App\Models\Users;
use Core\Controller;
use Core\Helper;
use Core\Session;
use Exception;

class ProfileController extends Controller
{
    public function view(string $userid = '')
    {
        try {
            $user = new Users();
            if(empty($userid)) $user = Users::getCurrentUser();
            else $user = Users::findById($user, "user_id");
            $this->view->render("common/user");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function edit()
    {
        try {
            $this->view->render("common/edit-profile");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}