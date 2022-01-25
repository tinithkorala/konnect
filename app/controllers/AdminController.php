<?php

namespace App\Controllers;

use App\Models\Academic;
use App\Models\Coordinators;
use App\Models\ResearchGroup;
use App\Models\Student;
use App\Models\Upload;
use App\Models\UserRole;
use App\Models\Users;
use App\Models\UserSessions;
use Core\Controller;
use Core\Helper;
use Core\Mailer;
use Core\Router;
use Core\Session;
use Exception;

class AdminController extends Controller
{
    public Users $currentUser;
    public array $sidebar = [
        ["route" => "admin/home", "name" => "User Management", "icon" => "manage_accounts"],
        ["route" => "admin/research_groups", "name" => "Research Group", "icon" => "groups"],
        ["route" => "admin/analytics", "name" => "Analytics", "icon" => "analytics"],
    ];

    public function onConstruct()
    {
        Router::authGuard("admin", "/home/wall");
        $this->view->setLayout("dashboard");
        $this->view->sidebar = $this->sidebar;
    }

    public function home()
    {
        $params = [
            'order' => "lastName, firstName",
        ];
        $params = Users::mergeWithPagination($params);
        $users = Users::find("user", $params);
        foreach ($users as $user) {
            $user->roles = UserRole::getUserRoles($user->user_id);
        }
        $this->view->users = $users;
        $this->view->total = Users::findTotal($params);
        try {
            $this->view->render("admin/users");
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function create_user()
    {
        try {
            $this->view->role_options = ['' => '', 'student' => 'Student', 'academic' => 'Academic Staff', 'pdc' => 'PDC'];
            $this->view->years = ['' => '', '2' => 'Year 2', '3' => 'Year 3', '4' => 'Year 4'];
            $this->view->streams = ['' => '', 'cs' => 'CS', 'is' => 'IS'];
            $user = new Users();
            $newUser = $user;
            $errors = [];

            //When a user is created using the form
            if ($this->request->isPost() && isset($_POST['create_user'])) {
                Session::csrfCheck();
                $user_type = $this->request->get('user_type');
                if (isset($user_type)) {
                    if ($user_type == 'student') $newUser = new Student();
                    elseif ($user_type == 'academic') {
                        $newUser = new Academic();
                    }
                }
                array_push($newUser->roles, $user_type);
                $fields = $newUser->getFields();
                foreach ($fields as $field) {
                    $newUser->{$field} = $this->request->get($field);
                }
                $newUser->status = 'active';
                $newUser->password = "password";
                $newUser->confirmPassword = "password";
                if ($user_type == 'pdc') {
                    $newUser->password = password_hash("password", PASSWORD_DEFAULT);
                    $newUser->confirmPassword = password_hash("password", PASSWORD_DEFAULT);
                    $user_created = $newUser->save();
                } else {
                    $user_created = $newUser->createUser($user_type);
                }
                if ($user_created) {
                    foreach ($newUser->roles as $role) {
                        $user_role = new UserRole();
                        $user_role->user_id = $newUser->getId();
                        $user_role->role = $role;
                        $user_created = $user_role->save();
                    }
                }

                if ($user_created) {
                    $message = "Successfully created user account";
                    Session::message($message, "success", "Registration successful!");
                } else {
                    $message = "Something went wrong";
                    Session::message($message, "warning", "Registration unsuccessful!");
                }
            } //File upload handler
            else if ($this->request->isPost() && isset($_POST['user_upload'])) {
                Session::csrfCheck();
                $upload = new Upload('userDetails');
                $uploadErrors = $upload->validate();
                if (!empty($uploadErrors)) {
                    foreach ($uploadErrors as $field => $value) {
                        $errors[$field] = $value;
                    }
                }
                $type = $this->request->get('type');
                $year = $this->request->get('student_year');
                if (empty($type)) $errors['type'] = '*Required';
                if (empty($year)) {
                    $errors['student_year'] = '*Required';
                    Session::message("Year is required", "warning", "Error");
                } else {
                    $file = $upload->temp;
                    $csv_data = array_map('str_getcsv', file($file));
                    array_walk($csv_data, function (&$x) use ($csv_data) {
                        $x = array_combine($csv_data[0], $x);
                    });
                    array_shift($csv_data);
                    $successful = 0;
                    $email_successful = 0;
                    $recipients = [];
                    if ($type === 'student') {
                        $student = new Student();
                        foreach ($csv_data as $element) {
                            $student->year = $year;
                            $element = array_change_key_case($element, CASE_LOWER);
                            $keys = array_keys($element);

                            //Finding the registration number
                            $key = preg_grep("/reg/i", $keys);
                            $reg_no = $element[array_shift($key)];
                            $student->reg_number = $reg_no;

                            //Finding the index number
                            $key_of_index = preg_grep("/index/i", $keys);
                            $index_no = $element[array_shift($key_of_index)];
                            $student->index_number = $index_no;

                            //Set the stream
                            if (str_contains(strtolower($reg_no), "cs")) $student->stream = "cs";
                            else $student->stream = "is";

                            //Find the first name
                            $key_of_first_name = preg_grep("/first/i", $keys);
                            $firstName = $element[array_shift($key_of_first_name)];
                            $student->firstName = $firstName;

                            //Find the last name
                            $key_of_last_name = preg_grep("/last/i", $keys);
                            $lastName = $element[array_shift($key_of_last_name)];
                            $student->lastName = $lastName;

                            //Find the email
                            $key_of_email = preg_grep("/email/i", $keys);
                            $email = $element[array_shift($key_of_email)];
                            $student->email = $email;

                            //Set the password to index number
                            $student->password = password_hash($index_no, PASSWORD_DEFAULT);
                            $student->confirmPassword = password_hash($index_no, PASSWORD_DEFAULT);

                            $student->status = 'active';

                            //Save the student in the database
                            $created = $student->createUser("student");
                            if ($created) {
                                $role = new UserRole();
                                $role->user_id = $created;
                                $role->role = "student";
                                $saved = $role->save();
                                if ($saved) {
                                    array_push($recipients, [
                                        "email" => $student->email,
                                        "name" => "{$student->firstName} {$student->lastName}"
                                    ]);
                                    $successful = $successful + 1;
                                } else break;
                            } else break;
                        }
                    }
                    if ($successful > 0) {
                        $mailer = Mailer::getMailInstance();
                        $email_successful = $mailer?->sendMail("Invitation to join Konnect", "Your account has been created on Konnect and your password is your index number", $recipients);
                    }
                    if (!$email_successful) Session::message("Failed to send emails", "warning", "Emails failed");
                    if ($email_successful > 0) Session::message("{$email_successful} number of emails were sent out", "success", "Processing complete");
                    Session::message("{$successful} number of students were created", "success", "Processing complete");
                }
            }

            $this->view->uploadErrors = $errors;
            $this->view->user = $user;
            $this->view->errors = $newUser->getErrors();
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", "Something went wrong :(");
        }
    }

    public function research_groups()
    {
        try {
            $params = ["order" => "name"];
            $this->view->groups = ResearchGroup::find("research_group", $params);
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", ":(");
        }
    }

    public function create_group()
    {
        try {
            $academic_users = Users::find("user", ['conditions' => 'user_type = :user_type', 'bind' => ['user_type' => 'academic']]);
            $options = ['' => ''];
            foreach ($academic_users as $user) {
                $key = "{$user->user_id}";
                $value = "{$user->firstName} {$user->lastName}";
                $options[$key] = $value;
            }
            $group = new ResearchGroup();
            if ($this->request->isPost()) {
                $fields = $group->getFields();
                foreach ($fields as $field) {
                    $group->{$field} = $this->request->get($field);
                }
                $group->status = "active";
                $saved = $group->save();
                if ($saved) {
                    $user = Users::findFirst("user", ["user_id" => $group->group_head]);
                    $updated = $user->update(['user_type' => 'research_group_head'], ['user_id' => $group->group_head]);
                    if ($updated) Session::message("Research group has been created and user has been assigned as head.", "success", "Group created successfully!");
                    else {
                        $group->delete($group->group_head, "group_head");
                        Session::message("Something went wrong", "warning", "Error");
                    }
                }
            }
            $this->view->options = $options;
            $this->view->group = $group;
            $this->view->errors = $group->getErrors();
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", ":(");
        }
    }

    public function assign_coordinators()
    {
        try {
            $coordinators = Coordinators::find("coordinators", ['conditions' => 'year = :year OR year = :year2 OR year = :year3', 'bind' => ['year' => '2', 'year2' => '3', 'year3' => '4']]);
            $user_ids = UserRole::find("user_role", ["conditions" => "role = :role1 OR role = :role2", "bind" => ["role1" => "academic", "role2" => "supervisor"]]);
            $users = [];
            $coordinator_ids = [];
            $all_user_ids = [];
            $coordinator_dataTable = [];
            foreach ($user_ids as $user) {
                array_push($all_user_ids, $user->user_id);
            }
            if (!empty($coordinators)) {
                foreach ($coordinators as $coordinator) {
                    $fetchedUser = Users::findFirst("user", ["conditions" => "user_id = :user_id", "bind" => ["user_id" => $coordinator->user_id]]);
                    $fetchedUser->roles = UserRole::getUserRoles($fetchedUser->user_id);
                    $fetchedUser->year = $coordinator->year;
                    array_push($coordinator_dataTable, $fetchedUser);
                    array_push($coordinator_ids, $fetchedUser->user_id);
                }
            }
            $filtered_users = array_diff($all_user_ids, $coordinator_ids);
            foreach ($filtered_users as $user) {
                $fetchedUser = Users::findFirst("user", ["conditions" => "user_id = :user_id", "bind" => ["user_id" => $user]]);
                $fetchedUser->roles = UserRole::getUserRoles($fetchedUser->user_id);
                array_push($users, $fetchedUser);
            }
            $options = ['' => '', '2' => 'Year 2', '3' => 'Year 3', '4' => 'Year 4'];
            $this->view->options = $options;
            $this->view->users = $users;
            $this->view->coordinators = $coordinator_dataTable;
            $this->view->render();
        } catch (Exception $exception) {
            Session::message($exception->getMessage(), "warning", ":(");
        }
    }

    public function toggleBlockUser($userid)
    {
        Router::authGuard("admin", "/admin/home");
        $user = Users::findById($userid, "user_id");
        if ($user) {
            $user->status = $user->status === "blocked" ? "active" : "blocked";
            $updated = $user->update(["status" => $user->status], ["user_id" => $user->user_id]);
            if ($updated) {
                $message = $user->status === "blocked" ? "User blocked" : "User unblocked";
                Session::message($message, "success", "Success");
            } else {
                Session::message("Updating user account status failed", "warning", "Success");
            }
        }
        Router::redirect("/admin/home");
    }

    public function assignUserAsCoordinator($userid, $year)
    {
        //add coordinator role to user
        $role = new UserRole();
        $role->user_id = $userid;
        $role->role = 'coordinator';
        $role->year = $year;
        $saved = $role->save();

        //add coordinator to coordinator list
        if ($saved) {
            $coordinator = new Coordinators();
            $coordinator->year = $year;
            $coordinator->user_id = $userid;
            $saved = $coordinator->save();
        }
        $message = "";
        $type = '';
        if ($saved) {
            $message = "Successfully assigned coordinator to year $year";
            $type = "success";
        } else {
            $message = "Failed to assign user as a coordinator";
            $type = "warning";
        }
        Session::message($message, $type, "Notice");

        Router::redirect("/admin/assign_coordinators");
    }

    public function deleteUser($userid)
    {
        $user = Users::findById($userid, "user_id");
        $user->roles = UserRole::getUserRoles($userid);
        $success = false;
        foreach ($user->roles as $role) {
            if ($role === 'admin') {
                Session::message("You are not authorized to delete an admin", "warning", "Error");
                Router::redirect("/admin/home");
            } else {
                if ($role === 'academic') {
                    $new = new Academic();
                    $success = $new->delete("user_id", $userid);
                }
                if ($role === 'student') {
                    $new = new Student();
                    $success = $new->delete("user_id", $userid);
                }
            }
        }
        if ($success) {
            $success = UserRole::delete("user_id", $userid);
            if ($success) {
                UserSessions::deleteAllSessions($userid);
                $success = $user->delete("user_id", $userid);
                if ($success) {
                    Session::message("Successfully deleted user", "success", "Success");
                }
            }
        }
        Router::redirect("/admin/home");
    }

    public function updateCoordinator($userid, $year)
    {
        $role = new UserRole();
        $updated = $role->update(["year" => $year], ["user_id" => $userid]);
        $coordinator = new Coordinators();
        $updated = $coordinator->update(["year" => $year], ["user_id" => $userid]);
        $message = "";
        $type = '';
        if ($updated) {
            $message = "Successfully assigned coordinator to year $year";
            $type = "success";
        } else {
            $message = "Failed to assign user as a coordinator";
            $type = "warning";
        }
        Session::message($message, $type, "Notice");

        Router::redirect("/admin/assign_coordinators");
    }

    public function removeCoordinator($userid, $year)
    {
        $coordinator = new Coordinators();
        $deleted = $coordinator->delete("user_id", $userid);
        $role = new UserRole();
        $deleted = $role->deleteWhere(["user_id" => $userid, "role" => "coordinator", $year => $year], "user_id = :user_id AND role = :role AND year = :year");
        $message = "";
        $type = '';
        if ($deleted) {
            $message = "Successfully removed coordinator from $year";
            $type = "success";
        } else {
            $message = "Failed to remove coordinator";
            $type = "warning";
        }
        Session::message($message, $type, "Notice");

        Router::redirect("/admin/assign_coordinators");
    }

}