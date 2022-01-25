<?php
session_start();

use App\Models\Users;
use Config\Config;
use Core\Helper;
use Core\Router;
use Core\Session;

//Defining the constants
const DS = DIRECTORY_SEPARATOR;
const PROOT = __DIR__;
$url = $_SERVER['REQUEST_URI'];

//Importing the auto-loader
require_once(PROOT . DS . 'core' . DS . 'AutoLoader.php');

define("ROOT", Config::get('root_dir'));

//Cleaning up the route
$url = preg_replace('/(\?.+)/', '', $url);
$currentPage = $url;

//Check for logged-in user
$currentUser = Users::getCurrentUser();

try {
    Router::route($url);
} catch (Exception $e) {
    Session::message($e->getMessage(), "warning", ":(");
    Router::redirect("/");
}