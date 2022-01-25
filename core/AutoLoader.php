<?php

//Auto load classes
spl_autoload_register(function ($className) {
    $parts = explode('\\', $className);
    $class = end($parts);
    array_pop($parts);
    $path = strtolower(implode(DS, $parts));
    $path = PROOT . DS . $path . DS . $class . '.php';
    if (file_exists($path)) {
        include($path);
    }
});