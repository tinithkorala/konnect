<?php

namespace App\Models;

use Core\Helper;
use Core\Model;

class UserSessions extends Model
{
    protected static string $table = "session";
    public $session_id, $user_id, $hash;

    public static function findByUserId($user_id)
    {
        $user_session = UserSessions::findFirst("session", [
            "conditions" => "user_id = :user_id",
            "bind" => ["user_id" => $user_id]
        ]);
        if (isset($user_session->session_id)) return $user_session;
        else return false;
    }

    public static function findByHash($hash)
    {
        return UserSessions::findFirst("session", [
            "conditions" => "hash = :hash",
            "bind" => ["hash" => $hash]
        ]);
    }

    public static function deleteAllSessions($userid)
    {
        $sessions = UserSessions::find("session", [
            "conditions" => "user_id = :user_id",
            "bind" => ["user_id" => $userid]
        ]);
        $success = false;
        foreach ($sessions as $session) {
            $success = UserSessions::delete("user_id", $userid);
        }
        return $success;
    }
}