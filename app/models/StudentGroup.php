<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Exception;

class StudentGroup extends Model
{
    public static $fields = [
        "name" => "Group name cannot be empty",
        "member1" => "Group member field cannot be empty",
        "member2" => "Group member field cannot be empty",
        "member3" => "Group member field cannot be empty",
        "member4" => "Group member field cannot be empty"];
    protected static string $table = "student_group";
    public $student_group_id, $year, $name, $project_group_id;

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
        $fields = self::$fields;
        foreach ($fields as $field => $message) {
            $this->runValidator(new RequiredValidator($this, ["field" => $field, "message" => $message]));
        }
    }
}