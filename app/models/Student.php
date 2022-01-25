<?php

namespace App\Models;

use Core\Helper;
use Core\Validators\EmailValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\UniqueValidator;
use Exception;

class Student extends Users
{
    public static array $fields = ['firstName' => "First name cannot be empty", 'lastName' => "Last name cannot be empty", 'index_number' => 'Index number cannot be empty', 'reg_number' => 'Registration number cannot be empty', 'year' => 'Year cannot be empty', 'email' => "Email cannot be empty", 'stream' => 'Stream cannot be empty'];
    protected static string $table = "student";
    public $index_number, $reg_number, $year, $user_id, $student_group_id, $stream;

    /**
     * @return array|string[]
     */
    public static function getFields(): array
    {
        $fields = [];
        foreach (self::$fields as $key => $value) {
            $fields[] = $key;
        }
        return $fields;
    }

    /**
     * @throws Exception
     */
    public function beforeSave()
    {
        $this->timeStamp();
        $fields = self::$fields;
        foreach ($fields as $field => $message) {
            $this->runValidator(new RequiredValidator($this, ["field" => $field, "message" => $message]));
        }
        $this->runValidator(new EmailValidator($this, ["field" => "email", "message" => "Email is not valid"]));
        $this->runValidator(new UniqueValidator($this, ["field" => "email", "message" => "This email is already in use."]));
    }
}