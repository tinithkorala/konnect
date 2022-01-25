<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Exception;

class GroupController extends Controller
{
    public function view()
    {
        try {
            $this->view->render("common/view_group");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}
