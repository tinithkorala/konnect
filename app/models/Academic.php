<?php

namespace App\Models;

use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\MinValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\UniqueValidator;
use Exception;

class Academic extends Users
{
    public static array $fields = ['firstName' => "First name cannot be empty", 'lastName' => "Last name cannot be empty", 'position' => "Position cannot be empty", "email" => "Email cannot be empty", 'staff_code' => 'Staff ID cannot be empty'];
    protected static string $table = 'academic';
    public $staff_code, $position, $user_id, $academic_id;

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