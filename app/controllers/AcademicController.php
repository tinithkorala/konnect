<?php

namespace App\Controllers;

use App\Models\Users;
use Core\Controller;
use Core\Helper;
use Core\Router;
use Core\Session;
use Exception;

class AcademicController extends Controller
{
    const sidebar = [
        ["route" => "academic/home", "icon" => "source", "name" => "Your Projects"],
        ["route" => "academic/your_groups", "icon" => "groups", "name" => "Your Groups"],
        ["route" => "academic/manage_requests", "icon" => "email", "name" => "Manage Requests"],
    ];

    public function onConstruct()
    {
        Router::authGuard("academic", "/home/wall");
        $this->view->setLayout("dashboard");
        $user = Users::getCurrentUser();
        $sidebar = self::sidebar;
        if (in_array("coordinator", $user->roles)) {
            $coordinator_routes = CoordinatorController::sidebar;
            foreach ($coordinator_routes as $route) {
                array_push($sidebar, $route);
            }
        }
        $this->view->sidebar = $sidebar;
    }


    public function home()
    {
        try {
            // $user = Users::getCurrentUser();
            // $projects = Project::find("project", ['conditions' => 'staffId = :staffId', 'bind' => ['staffId' => $user->user_id]]);
            // $this->view->project = $projects;
            $this->view->render("academic/your_projects");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function your_groups()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }


    public function manage_requests()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function view_group()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}
