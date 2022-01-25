<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Exception;

class ResearchGroup extends Model
{
    public static array $fields = ["name" => "Research group name cannot be empty", "group_head" => "Group head cannot be empty"];
    protected static string $table = "research_group";
    public $name, $description, $status, $group_head, $research_group_id;

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