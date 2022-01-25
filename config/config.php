<?php

namespace Config;

class Config
{
    private static array $config = [
        'version' => '0.0.1',
        'root_dir' => '/',
        'default_controller' => 'Home',  // The default home controller
        'default_layout' => 'default', // Default layout that is used
        'default_site_title' => 'Konnect', // Default Site title
        'db_host' => '127.0.0.1', // DB host please use IP address not domain
        'db_name' => 'konnect', // DB name
        'db_user' => 'root', // DB user
        'db_password' => '', // DB password
        'login_cookie_name' => 'Konnect', // Login cookie (rn it's random)
        'smtp-port' => 587,
        'smtp-host'=> 'smtp.gmail.com',
        'smtp-email' => 'konnect.sysup@gmail.com',
        'smtp-app-password' => ''
    ];

    public static function get($key): ?string
    {
        return array_key_exists($key, self::$config) ? self::$config[$key] : NULL;
    }
}