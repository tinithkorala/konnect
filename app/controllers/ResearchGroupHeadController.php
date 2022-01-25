<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\ResearchGroup;
use App\Models\Users;
use Core\Controller;
use Core\Session;
use Exception;

class ResearchGroupHeadController extends Controller
{
    public array $sidebar = [
        ["route" => "research_group_head/home", "name" => "Your projects", "icon" => "work_outline"],
        ["route" => "research_group_head/your_research_groups", "name" => "Your research groups", "icon" => "engineering"],
        ["route" => "research_group_head/manage_requests", "name" => "Manage requests", "icon" => "email"],
        ["route" => "academic/research_groups", "icon" => "groups", "name" => "All research groups"],
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
            $projects = Project::find("project", ['conditions' => 'staffId = :staffId', 'bind' => ['staffId' => $user->user_id]]);
            $this->view->project = $projects;
            $this->view->render("academic/your_projects");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function research_groups()
    {
        try {
            $params = ["order" => "name"];
            $this->view->groups = ResearchGroup::find("research_group", $params);
            $this->view->render("researchGroupHead/research_groups");
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

    public function your_research_groups()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function your_group()
    {
        try {
            $this->view->render("researchGroupHead/your_group");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }
}
