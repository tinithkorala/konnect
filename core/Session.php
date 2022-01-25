<?php

namespace Core;

use Core\Request;

class Session
{
    public static function csrfCheck()
    {
        $request = new Request();
        $check = $request->get("csrfToken");
        if (self::exists("csrfToken") && self::get("csrfToken") == $check) return true;
        Router::redirect("auth/badToken");
    }

    public static function exists($name): bool
    {
        return isset($_SESSION[$name]);
    }

    public static function get($name)
    {
        if (self::exists($name) && !empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return false;
    }

    public static function createCsrfToken(): string
    {
        $token = md5('csrf' . time());
        self::set("csrfToken", $token);
        return $token;
    }

    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function message($message, $type, $title)
    {
        $alerts = self::exists('session_alerts') ? self::get('session_alerts') : [];
        $alerts["type"] = $type;
        $alerts["message"] = $message;
        $alerts["title"] = $title;
        self::set('session_alerts', $alerts);
    }

    public static function displaySessionAlerts(): bool
    {
        return self::exists('session_alerts');
    }

    public static function delete($name)
    {
        unset($_SESSION[$name]);
    }

}