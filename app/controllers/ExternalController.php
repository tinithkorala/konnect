<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Users;
use Core\Controller;
use Core\Helper;
use Core\Session;
use Exception;

class ExternalController extends Controller
{
    public array $sidebar = [
        ["route" => "external/home", "icon" => "speed", "name" => "Your Projects"],
        ["route" => "external/your_group", "icon" => "groups", "name" => "Your Groups"],
       
    ];

    public function onConstruct()
    {
        $this->view->setLayout("dashboard");
        $this->view->sidebar = $this->sidebar;
        $this->currentUser = Users::getCurrentUser();
    }

    public function home()
    {
        try {
           // $user = Users::getCurrentUser();
            //$projects = Project::find("project", ['conditions' => 'externalId = :externalId', 'bind' => ['externalId' => $user->user_id]]);
           //$this->view->projects = $projects;
            $this->view->render("external/your_project");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function your_group()
    {
        try {
           // $user = Users::getCurrentUser();
           // $projects = Project::find("project", ['conditions' => 'externalId = :externalId', 'bind' => ['externalId' => $user->user_id]]);
            //$this->view->projects = $projects;
            $this->view->render("external/your_group");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}