<?php

namespace App\Models;

use Core\Model;
use Core\Validators\RequiredValidator;
use Exception;

class Coordinators extends Model
{
    public static array $fields = ['year' => 'Year cannot be empty', 'user_id' => 'User cannot be empty'];
    protected static string $table = 'coordinators';
    public $coordinator_id, $user_id, $year;

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