<?php

namespace App\Controllers;

use App\Models\Users;
use Core\Controller;
use Core\Session;
use Exception;

class StudentController extends Controller
{
    public array $sidebar = [
        ["route" => "student/home", "name" => "Academic Project Groups", "icon" => "groups"],
        ["route" => "student/supervisors", "name" => "Supervisors", "icon" => "supervisor_account"],
        ["route" => "student/other_project_groups", "name" => "Other Project Groups", "icon" => "groups"],
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
            $this->view->render("student/academic_project_groups");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function supervisors()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function other_project_groups()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}