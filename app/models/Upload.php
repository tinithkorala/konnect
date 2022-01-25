<?php

namespace App\Models;

use Core\Helper;

class Upload
{
    public $file, $field, $errors = [];
    public $temp, $extension, $size;
    public $maxSize = 2000000;
    public $allowedFileTypes = ['csv' => 'application/csv', 'csv2' => 'text/csv'];
    public $required = true;

    public function __construct($field)
    {
        $this->field = $field;
        $this->checkInitialError();
        $this->file = $_FILES[$field];
        $this->size = $this->file['size'];
        $this->temp = $this->file['tmp_name'];
        $this->extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
    }

    private function checkInitialError()
    {
        if (!isset($_FILES[$this->field]) || is_array($_FILES[$this->field]['error'])) {
            throw new \RuntimeException('Something is wrong with the file');
        }
    }

    public function validate(): array
    {
        $this->errors = [];
        if (empty($this->temp) && $this->required) $this->errors[$this->field] = "*File is required";
        //check size
        if ($this->size > $this->maxSize) $this->errors[$this->field] = "*Exceeded file size limit of " . $this->formatBytes($this->maxSize);

        //check if the file is the allowed type
        if(empty($this->errors)){
            $info = new \finfo(FILEINFO_MIME_TYPE);
            $type = $info->file($this->temp);
            if (array_search($type, $this->allowedFileTypes) === false) {
                $this->errors[$this->field] = "*Not an allowed file type";
            }
        }
        return $this->errors;
    }

    private function formatBytes($bytes)
    {
        $precision = 2;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $power = floor(($bytes ? log($bytes) : 0) / log(1024));
        $power = min($power, count($units) - 1);
        return round($bytes, $precision) . $units[$power];
    }

}