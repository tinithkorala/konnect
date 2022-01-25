<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Exception;

class SearchController extends Controller
{
    public function index()
    {
        try {
            $this->view->render("common/search_home");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}
