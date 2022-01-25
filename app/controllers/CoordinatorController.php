<?php

namespace App\Controllers;

use App\Models\Academic;
use App\Models\Coordinators;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\Supervisor;
use App\Models\UserRole;
use App\Models\Users;
use Core\Controller;
use Core\Helper;
use Core\Session;
use Exception;

class  CoordinatorController extends Controller
{
    const sidebar = [
        ["route" => "coordinator/home", "name" => "Academic Year Projects", "icon" => "edit_calendar"],
        ["route" => "coordinator/manage_supervisors", "name" => "Manage Supervisors", "icon" => "supervised_user_circle"],
        ["route" => "coordinator/manage_requests", "name" => "Analytics", "icon" => "data_usage"]
    ];

    /**
     * @return array
     */
    public static function getSidebar(): array
    {
        return self::sidebar;
    }

    public function onConstruct()
    {
        $this->view->setLayout("dashboard");
        $user = Users::getCurrentUser();
        $sidebar = AcademicController::sidebar;
        if (in_array("academic", $user->roles)) {
            $coordinator_routes = self::sidebar;
            foreach ($coordinator_routes as $route) {
                array_push($sidebar, $route);
            }
        }
        $this->view->sidebar = $sidebar;
        $this->currentUser = Users::getCurrentUser();
    }

    public function analytics()
    {
        try {
            $this->view->render("coordinator/analytics");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function home()
    {
        try {
            $this->view->render("coordinator/academic_year_projects");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function manage_supervisors()
    {
        try {
            $user = Users::getCurrentUser();
            $coordinator = Coordinators::findFirst("coordinators", ["conditions" => "user_id = :user_id", "bind" => ["user_id" => $user->user_id]]);
            $academic_ids = UserRole::find("user_role", ["conditions" => "role = :role AND NOT user_id = :user_id", "bind" => ["role" => "academic", "user_id" => $coordinator->user_id]]);
            $supervisor_ids = Supervisor::find("supervisor", ["conditions" => "year = :year", "bind" => ["year" => $coordinator->year]]);
            $academic_users = [];
            foreach ($academic_ids as $academic){
                $academic_user = Academic::findFirst("academic", ["conditions" => "user_id = :user_id", "bind" => ["user_id" => $academic->user_id]]);
                $user_values = Users::findFirst("user", ["conditions" => "user_id = :user_id", "bind" => ["user_id" => $academic->user_id]]);
                foreach (get_object_vars($user_values) as $property => $value){
                    if(property_exists($academic_user, $property)) $academic_user->$property = $value;
                }
                array_push($academic_users, $academic_user);
            }
            $this->view->academic_users = $academic_users;
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function your_projects()
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

    public function edit_submission_dates()
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

    public function create_groups()
    {
        try {
            $group = new StudentGroup();
            $user = Users::getCurrentUser();
            $coord = Coordinators::findFirst("coordinators", ['conditions' => 'user_id = :user_id', 'bind' => ['user_id' => $user->user_id]]);
            $students = Student::find("student", ['conditions' => 'year = :year', 'bind' => ['year' => $coord->year]]);
            $options = ["" => ""];
            foreach ($students as $student) {
                $options[$student->user_id] = $student->index_number;
            }
            if ($this->request->isPost()) {
                $members = ['member1', 'member2', 'member3', 'member4'];
                $groupMembers = [];
                $fields = $group->getFields();
                foreach ($fields as $field) {
                    $group->{$field} = $this->request->get($field);
                }
                foreach ($members as $member) {
                    $groupMembers[$member] = $this->request->get($member);
                }
                $member5 = $this->request->get("member5");
                if ($member5) $groupMembers["member5"] = $member5;
                $group->year = $coord->year;
                $saved = $group->save();
                $success = true;
                if ($saved) {
                    $groupNo = $group->getId();
                    foreach ($groupMembers as $key => $value) {
                        $student = Student::findFirst("student", ["conditions" => "user_id = :user_id", "bind" => ["user_id" => $value]]);
                        $updated = false;
                        if ($student) $updated = $student->update(["groupNo" => $groupNo], ["user_id" => $student->user_id]);
                        if (!$updated) {
                            $success = false;
                            Session::message("Failed to update students", "warning", "Error");
                            break;
                        }
                    }
                    if (!$success) {
                        $group->delete("studentGroupId", $groupNo);
                    } else Session::message("Successfully created student group", "success", "Success! :)");
                }
            }
            $this->view->group = $group;
            $this->view->errors = $group->getErrors();
            $this->view->options = $options;
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Error!");
        }
    }
}

?>
