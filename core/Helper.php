<?php

namespace Core;

class Helper
{
    public static function navItem($link, $label, $isDropdown = false)
    {
        $active = self::isCurrentPage($link);
        $class = self::activeClass($link, "nav-item");
        $linkClass = $isDropdown ? "dropdown-item" : "nav-link";
        $linkClass .= $active && $isDropdown ? " active" : "";
        $link = ROOT . $link;
        $html = "<li class=\"{$class}\">";
        $html .= "<a class=\"{$linkClass}\" href=\"{$link}\"> {$label} </a>";
        return $html;
    }

    public static function isCurrentPage($page): bool
    {
        global $url;
        global $currentPage;
        if (!empty($page) && strpos($page, ":id") > -1) {
            $test = str_replace(":id", "", $page);
            return strpos($currentPage, $page) > -1;
        }
        return $page == $currentPage;
    }

    public static function activeClass($page, $class = '')
    {
        $active = self::isCurrentPage($page);
        return $active ? $class . "active" : $class;
    }

    public static function dumpAndDie($data = [], $die = true)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        if ($die) die();
    }
}