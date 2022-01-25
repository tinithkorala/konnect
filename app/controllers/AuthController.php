<?php

namespace App\Controllers;

use App\Models\ExternalCompany;
use App\Models\Users;
use App\Models\UserRole;
use Core\{Controller, Helper, Router, Session};
use Exception;

class AuthController extends Controller
{
    /**
     * @var string[]
     */

    /**
     * @throws Exception
     */
    public function register()
    {
        $user = new ExternalCompany();

        if ($this->request->isPost()) {
            $fields = $user->getFields();
            foreach ($fields as $field) {
                $user->{$field} = $this->request->get($field);
            }
            $user->status = 'pending';
            $user_created = $user->createUser("external");
            if ($user_created) {
                $user_role = new UserRole();
                $user_role->role = "external";
                $user_role->user_id = $user_created;
                $user_created = $user_role->save();
                if($user_created) {
                    $message = "Your registration has been sent for approval and you will be notified when your account is approved.";
                    Session::message($message, "success", "Registration successful!");
                }
            }
        }
        $this->view->user = $user;
        $this->view->errors = $user->getErrors();
        $this->view->render();
    }

    /**
     * @throws Exception
     */
    public function pending()
    {
        $this->view->render();
    }

    /**
     * @throws Exception
     */
    public function login()
    {
        $user = new Users();
        $isError = true;
        if ($this->request->isPost()) {
            Session::csrfCheck();
            $user->email = $this->request->get("email");
            $user->password = $this->request->get("password");
            $user->validateLogin();
            if (empty($user->getErrors())) {
                $foundUser = Users::findFirst("user", ["conditions" => "email = :email", "bind" => ["email" => $this->request->get("email")]]);
                if ($foundUser) {
                    $verified = password_verify($this->request->get("password"), $foundUser->password);
                    if ($verified) {
                        $isError = false;
                        $logged = $foundUser->login(true);
                        if($logged) Router::route("/home/wall");
                        else Session::message("Something went wrong", "warning", "Error");
                    }
                }
            }
            if ($isError) {
                $user->setErrors("email", "Something is wrong with the email or password. Please try again");
                $user->setErrors("password", "");
            }
        }
        $this->view->errors = $user->getErrors();
        $this->view->user = $user;
        $this->view->render();
    }

    /**
     * @throws Exception
     */
    public function logout()
    {
        $currentUser = Users::getCurrentUser();
        if ($currentUser) $currentUser->logout();
        Router::redirect("/home");
    }

    public function forgot_password(){
        try{
            $this->view->render("auth/forgot-password");
        }
        catch(Exception $exception){
            Session::message($exception->getMessage(), "warning", "Error");
        }
    }

    public function email_sent(){
        try{
            $this->view->render("auth/email-sent");
        }
        catch(Exception $exception){
            Session::message($exception->getMessage(), "warning", "Error");
        }
    }
}