<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\ProjectMembers;
use App\Models\Student;
use App\Models\Users;
use App\Models\ProjectGroup;
use App\Models\StudentGroup;
use Core\Controller;
use DateTime;
use DateTimeZone;
use Core\Helper;
use Core\Session;
use Exception;

class ProjectController extends Controller
{
    public function create()
    {
        try {
            $project = new Project();
            $save = true;
            if ($this->request->isPost()) {
                Session::csrfCheck();
                $fields = $project->getFields();
                foreach ($fields as $field) {
                    $project->{$field} = $this->request->get($field);
                }

                $project->status = "accepting";
                $user = Users::getCurrentUser();
                if (in_array("academic", $user->roles)) {
                    $project->type = 'internal';
                } else if (in_array("external", $user->roles)) {
                    $project->type = 'external';
                }else if (in_array('student',$user->roles)){
                    $student = Student::findFirst("student", ['conditions' => 'user_id = :user_id', 'bind' => ['user_id' => $user->user_id]]);
                    if (isset($student->student_group_id)) {
                        $project->type = 'academic';
                    }else {
                        Session::message("Please wait to be assigned to a group", "warning", "Error");
                    }
                }
                $project->user_id = $user->user_id;
                $success = $project->save();
                if (!$success) {
                    Session::message("Project could not be created successfully", "warning", "Error");
                } else {
                    $group = new ProjectGroup();
                    $group->project_id = $project->getId();
                    $success = $group->save();

                    if (!$success) {
                        Session::message("Project group could not be created successfully", "warning", "Error");
                    } else {
                        $members = new ProjectMembers();
                        $members->user_id = $user->user_id;
                        $members->project_group_id = $group->getId();
                        $dateTime = new DateTime("now", new DateTimeZone("UTC"));
                        $now = $dateTime->format('Y-m-d H:i:s');
                        $members->joinedAt = $now;
                        $members->project_id = $project->getId();
                        if(in_array("academic", $user->roles)) {
                            $members->role = 'supervisor';
                        } else if(in_array("external", $user->roles)) {
                            $members->role = 'external';
                        } else if(in_array('student',$user->roles)) {
                            $student = Student::findFirst("student", ['conditions' => 'user_id = :user_id', 'bind' => ['user_id' => $user->user_id]]);
                            $updated = $user->update(["project_group_id" => $group->getId()], ["student_group_id" => $student->student_group_id]);
                            if(!$updated) {
                                Session::message("Project members could not be created successfully", "warning", "Error");
                            } else {
                                $members->role = 'member';
                                $group_id = $student->student_group_id;
                                $group_member = Student::find("student", ['conditions' => 'student_group_id = :student_group_id', 'bind' => ['student_group_id' => $group_id]]);
                                foreach ($group_member as $group_members) {
                                    $group_members = new ProjectMembers();
                                    $group_members->role = 'member';
                                    $group_members->user_id = $group_member->user_id;
                                    $group_members->project_group_id = $group->getId();
                                    $group_members->project_id = $project->getId();
                                    $group_members->save();
                            }

                            }
                        }
                        $success = $members->save();
                        if($success) {
                            Session::message("Project created successfully!", "success", "Project creation successful!");
                        }
                    }

                }
            }
            $this->view->errors = $project->getErrors();
            $this->view->render("common/create_project");
        }
        catch
            (Exception $exception) {
                Session::message($exception->getMessage(), "warning", ":(");
            }
    }

    public function view()
    {
        try {
            $this->view->render("common/project");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", ":(");
        }
    }
}

