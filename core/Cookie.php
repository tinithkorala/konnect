<?php

namespace Core;

class Cookie
{
    public static function get($name)
    {
        if (self::exists($name)) {
            return $_COOKIE[$name];
        }
        return false;
    }

    public static function exists($name): bool
    {
        return isset($_COOKIE[$name]);
    }

    public static function delete($name): bool
    {
        return self::set($name, '', -1);
    }

    public static function set($name, $value, $expiry): bool
    {
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }
}