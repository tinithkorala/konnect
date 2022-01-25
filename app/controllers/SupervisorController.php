<?php

namespace App\Controllers;

use App\Models\ResearchGroup;
use App\Models\Users;
use Core\Controller;
use Core\Session;
use Exception;
use App\Models\Project;

class SupervisorController extends Controller
{
    public array $sidebar = [
        ["route" => "supervisor/home", "icon" => "source", "name" => "Your Projects"],
        ["route" => "supervisor/groups", "name" => "Your Groups", "icon" => "groups"],
        ["route" => "supervisor/manage_requests", "name" => "Manage requests", "icon" => "email"],
        ["route" => "supervisor/set_quotas", "name" => "Set quotas", "icon" => "dialpad"],
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
          // $projects = Project::find("project", ['conditions' => 'staffId = :staffId', 'bind' => ['staffId' => $user -> user_id]]);
          // $this -> view -> project = $projects;
            $this->view->render("academic/your_projects");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function groups()
    {
        try {
            $this->view->render("academic/your_groups");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }


    public function manage_requests()
    {
        try {
            $this->view->render("academic/manage_requests");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function set_quotas()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    // public function view_group()
    // {
    //     try {
    //         $this->view->render("academic/research_groups");
    //     } catch (Exception $exception) {
    //         Session::message($exception->getMessage(), "warning", "Something went wrong :(");
    //     }
    // }

}
