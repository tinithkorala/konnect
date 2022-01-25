<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Users;
use Core\Controller;
use Core\Session;
use Exception;

class StudentfourthController extends Controller
{
    public array $sidebar = [
        ["route" => "studentfourth/home", "name" => "Projects", "icon" => "source"],
        ["route" => "studentfourth/supervisors", "name" => "Supervisors", "icon" => "supervisor_account"],
        ["route" => "studentfourth/researchgroups", "name" => "Reseach Groups", "icon" => "groups"],
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
            $user = Users::getCurrentUser();
            $projects = Project::find("project", ['conditions' => 'student_id = :student_id', 'bind' => ['student_id' => $user->user_id ]]);
            $this->view->projects = $projects;
            $this->view->render("studentfourth/projects");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function supervisors()
    {
        try {
            $this->view->render("student/supervisors");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function researchgroups()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}