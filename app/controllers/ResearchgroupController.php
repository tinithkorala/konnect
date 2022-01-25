<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Exception;

class ResearchgroupController extends Controller
{
    public function view()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}