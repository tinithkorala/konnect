<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Exception;

class Project extends Model
{
    public static array $fields = ['name' => 'Project name cannot be empty', 'description' => 'Project description cannot be empty'];
    protected static string $table = "project";
    public $project_id, $description, $name, $status, $type, $research_title, $user_id;

    /**
     * @return array
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