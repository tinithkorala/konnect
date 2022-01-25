<?php

namespace Core;

use App\Models\Users;
use Config\Config;
use Exception;

class Router
{
    /**
     * @throws Exception
     */
    public static function route($url)
    {
        $urlParts = explode('/', $url);
        array_shift($urlParts);
        if($urlParts) $urlParts[0] = str_replace('_', '', ucwords($urlParts[0], '_'));

        //Set controller
        $controllerName = !empty($urlParts[0]) ? ucwords($urlParts[0]) : Config::get('default_controller');
        $controller = '\App\Controllers\\' . ucwords($controllerName) . 'Controller';
        //Set Action
        array_shift($urlParts);
        $action = !empty($urlParts[0]) ? $urlParts[0] : 'index';

        //Get parameters
        array_shift($urlParts);
        //Instantiate the relevant controller class and call the respective method

        //Check if class exists
        if (!class_exists($controller)) {
            throw new \Exception('The controller "' . $controller . '" does not exist.');
        }
        $controllerClass = new $controller($controllerName, $action);
        //Check if method exists in that class
        if (!method_exists($controllerClass, $action)) {
            throw new \Exception('The method "' . $action . '"does not exist in"' . $controller . '"');
        }
        call_user_func_array([$controllerClass, $action], $urlParts);
    }

    public static function redirect($location)
    {
        if (!headers_sent()) {
            header('Location: ' . $location);
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "' . $location . '"';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
            echo '</noscript>';
        }
        exit();
    }

    public static function authGuard($role, $redirect, $message = "You do not have permission to view this page" ){
        $user = Users::getCurrentUser();
        $allowed = $user && $user->hasPermission($role);
        if(!$allowed){
            Session::message($message, "warning", "Unauthorized");
            self::redirect($redirect);
        }
    }

}