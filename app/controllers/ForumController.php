<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Exception;

class ForumController extends Controller{
    public function view()
    {
        try {
            $this->view->render("common/forum");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}
