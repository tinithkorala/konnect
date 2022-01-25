<?php

namespace App\Controllers;

use App\Models\ExternalCompany;
use App\Models\Project;
use App\Models\Users;
use Core\Controller;
use Core\Helper;
use Core\Session;
use Core\Router;
use Exception;

class PdcController extends Controller
{
    public array $sidebar = [


        ["route" => "pdc/home", "name" => "All Companies", "icon" => "domain"],
        ["route" => "pdc/manage_project", "name" => "Manage Projects", "icon" => "backup_table"],
        ["route" => "pdc/analytics", "icon" => "email", "name" => "Analytics"],
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
            $params = [
                'order' => "company_name",
            ];
            $params = Users::mergeWithPagination($params);
            $companies = ExternalCompany::find("external", $params);
            foreach ($companies as $company) {
                $rep_user = Users::findFirst("user", ["conditions" => "user_id = :user_id", "bind" => ["user_id" => $company->user_id]]);
                $company->status = $rep_user->status;
                $company->firstName = $rep_user->firstName;
                $company->lastName = $rep_user->lastName;
                $company->email = $rep_user->email;
            }
            $this->view->companies = $companies;
            $this->view->render("pdc/all_companies");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function manage_project()
    {
        try {
            $projects = Project::find("project", ["conditions" => "type = :type", "bind" => ["type" => "external"]]);
            $this->view->projects = $projects;
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function manage_request()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function analytics()
    {
        try {
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function changeCompanyStatus($userid, $status)
    {
        Router::authGuard("pdc", "/pdc/home");
        $user = Users::findById($userid, "user_id");
        if ($user && $status && in_array($status, array("blocked", "active"))) {
            $user->status = $status;
            $updated = $user->update(["status" => $user->status], ["user_id" => $user->user_id]);
            if ($updated) {
                if ($status == "ative") $message = "User activated";
                else if ($status == "pending") $message = "User blocked";
                Session::message($message, "success", "Success");
            } else {
                Session::message("Updating user account status failed", "warning", "Success");
            }
        }
        Router::redirect("/pdc/home");
    }

}

?>