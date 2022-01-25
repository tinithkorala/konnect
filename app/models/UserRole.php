<?php

namespace App\Models;

use Core\Model;

class UserRole extends Model
{
    protected static string $table = "user_role";
    public $user_id, $role, $year;

    public static function getUserRoles($userid = ''){
        if(empty($userid)){
            $user = Users::getCurrentUser();
            $userid = $user->user_id;
        }
        $user_roles = UserRole::find("user_role", ['conditions' => 'user_id = :user_id', 'bind' => ['user_id' => $userid]]);
        $roles = [];
        foreach ($user_roles as $value){
            array_push($roles, $value->role);
        }
        return $roles;
    }

    public static function deleteUserRolesOfAUser($userid){
        $roles = UserRole::getUserRoles($userid);
        $success = false;
        foreach ($roles as $role){
            $success = UserRole::delete("user_id", $userid);
        }
        return $success;
    }
}