<?php

namespace Core;

class Request
{
    /**
     * @param false $input
     * @return array|false|string
     * This function is used to sanitize input fields. It could be called with a specific input
     * or it will obtain all inputs from the global object request and sanitize it.
     */
    public function get($input = false)
    {
        if (!$input) {
            $data = [];
            foreach ($_REQUEST as $field => $value) {
                $data[$field] = self::sanitize($value);
            }
            return $data;
        }
        return array_key_exists($input, $_REQUEST) ? self::sanitize($_REQUEST[$input]) : false;
    }

    /**
     * @param $dirty
     * @return string
     * A function that accepts a string and sanitizes into UTF-8 encoding
     */
    public static function sanitize($dirty): string
    {
        return htmlentities(trim($dirty), ENT_QUOTES, "UTF-8");
    }

    public function isPost(): bool
    {
        return $this->getRequestMethod() === 'POST';
    }

    public function getRequestMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isPut()
    {
        return $this->getRequestMethod() === 'PUT';
    }

    public function isGet()
    {
        return $this->getRequestMethod() === 'GET';
    }

    public function isDelete()
    {
        return $this->getRequestMethod() === 'DELETE';
    }

    public function isPatch()
    {
        return $this->getRequestMethod() === 'PATCH';
    }
}