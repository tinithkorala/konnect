<?php

namespace App\Controllers;

use App\Models\Coordinators;
use App\Models\Post;
use App\Models\Student;
use App\Models\Users;
use Core\{Controller, Helper, Session};
use Exception;

class HomeController extends Controller
{
    /**
     * @throws Exception
     * Default method when routed to this controller
     */
    public function index()
    {
        $this->view->render();
    }

    /**
     * @throws Exception
     */
    public function wall()
    {
        $this->view->setSiteTitle('Konnect');
        $post = new Post();
        $user = Users::getCurrentUser();
        try{
            $this->view->errors = $post->getErrors();
            $this->view->render("home/home");
        }
        catch (Exception $exception){
            Session::message($exception->getMessage(), "warning", "Error :(");
        }
    }
}