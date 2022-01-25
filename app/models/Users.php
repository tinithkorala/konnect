<?php

namespace App\Models;

use Config\Config;
use Core\Cookie;
use Core\Helper;
use Core\Model;
use Core\Router;
use Core\Session;
use Core\Validators\EmailValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\UniqueValidator;
use Exception;

class Users extends Model
{
    public static array $fields = ['firstName' => 'First name cannot be empty', 'lastName' => 'Last name cannot be empty', 'email' => 'Email cannot be empty'];
    protected static string $table = "user";
    protected static $_current_user = false;
    public $user_id, $firstName, $lastName, $email, $password, $user_type, $createdAt, $updatedAt, $remember = '', $confirmPassword, $roles = [], $first_login = 0, $status, $year;
    /**
     * @return array|string[]
     */
    public static function getFields(): array
    {
        $fields = [];
        foreach (self::$fields as $key => $value) {
            $fields[] = $key;
        }
        return $fields;
    }

    public static function getCurrentUser()
    {
        if (!self::$_current_user && Session::exists("logged_in_user")) {
            $user_id = Session::get("logged_in_user");
            self::$_current_user = self::findFirst("user", [
                "conditions" => "user_id = :user_id",
                "bind" => ["user_id" => $user_id]
            ]);
        }
        if (!self::$_current_user) self::loginFromCookie();
        if (self::$_current_user) self::$_current_user->roles = UserRole::getUserRoles(self::$_current_user->user_id);
        if(self::$_current_user && self::$_current_user->status === 'blocked') {
            self::$_current_user->logout();
            Session::message("Your account has been suspended. Please talk to an administrator.", "warning", "Account suspended");
            Router::redirect("/");
        }
        return self::$_current_user;
    }

    public static function loginFromCookie()
    {
        $cookieName = Config::get("login_cookie_name");
        if (!Cookie::exists($cookieName)) return false;
        $hash = Cookie::get($cookieName);
        $session = UserSessions::findByHash($hash);
        if (!$session) return false;
        $user = self::findFirst("user", [
            "conditions" => "user_id = :user_id",
            "bind" => ["user_id" => $session->user_id]
        ]);
        if ($user) $user->login(true);
    }

    public function login($remember = true): bool
    {
        Session::set("logged_in_user", $this->user_id);
        self::$_current_user = $this;
        $success = true;
        if ($remember) {
            $now = time();
            $newHash = md5("{$this->user_id}_{$now}");
            $session = new UserSessions();
            $sessionFound = UserSessions::findByUserId($this->user_id);
            if ($sessionFound) $session = $sessionFound;
            $session->user_id = $this->user_id;
            $session->hash = $newHash;
            if ($sessionFound) $success = $session->update(["hash" => $newHash], ["user_id" => $this->user_id]);
            else $success = $session->save();
            $set = Cookie::set(Config::get("login_cookie_name"), $newHash, 60 * 60);
            if (!$set) {
                $success = false;
                Session::message("Error setting up cookie", "warning", "Cookie alert");
            }
        }
        return $success;
    }

    /**
     * @throws Exception
     */
    public function beforeSave()
    {
        $this->timeStamp();
        $fields = self::$fields;
        foreach ($fields as $field => $message) {
            $this->runValidator(new RequiredValidator($this, ["field" => $field, "message" => $message]));
        }
        $this->runValidator(new EmailValidator($this, ["field" => "email", "message" => "Email is not valid"]));
        $this->runValidator(new UniqueValidator($this, ["field" => "email", "message" => "This email is already in use."]));
    }

    /**
     * @throws Exception
     */
    public function validateLogin()
    {
        $this->runValidator(new RequiredValidator($this, ["field" => "email", "message" => "Email cannot be empty"]));
        $this->runValidator(new RequiredValidator($this, ["field" => "password", "message" => "Password cannot be empty"]));
    }

    public function logout()
    {
        Session::delete("logged_in_user");
        self::$_current_user = false;
        $session = UserSessions::findByUserId($this->user_id);
        if ($session) $session->delete("user_id", $this->user_id);
        Cookie::delete(Config::get("login_cookie_name"));
    }

    public function hasPermission($role): bool
    {
        return in_array($role, $this->roles);
    }

    public static function deleteUser($userid){
        $success = false;
        $statements = [];

        //delete all roles of user
        $statement = ["sql" => "DELETE * FROM user_role WHERE user_id :user_id", "bind" => ["user_id" => $userid]];
        array_push($statements, $statement);

        //delete all sessions of user
        $statement = ["sql" => "DELETE * FROM session WHERE user_id :user_id", "bind" => ["user_id" => $userid]];
        array_push($statements, $statement);

        //delete all interests of user
        $statement = ["sql" => "DELETE * FROM user_interests WHERE user_id :user_id", "bind" => ["user_id" => $userid]];
        array_push($statements, $statement);

        //delete all notifications of user
        $statement = ["sql" => "DELETE * FROM notifications WHERE user_id :user_id", "bind" => ["user_id" => $userid]];
        array_push($statements, $statement);

        //delete project memberships of user
        $statement = ["sql" => "DELETE * FROM project_members WHERE user_id :user_id", "bind" => ["user_id" => $userid]];
        array_push($statements, $statement);

        //delete project requests of user
        $statement = ["sql" => "DELETE * FROM requests WHERE supervisor_id :supervisor_id OR student_id :user_id", "bind" => ["supervisor_id" => $userid, "user_id" => $userid]];
        array_push($statements, $statement);
    }
}