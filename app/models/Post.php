<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Exception;

class Post extends Model
{
    protected static string $table = "notices";
    public static array $fields = ['post' => "Post body cannot be empty"];
    public $post_id, $user_id, $createdAt, $type, $research_group_id, $post;

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
    }
}