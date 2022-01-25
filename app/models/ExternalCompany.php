<?php

namespace App\Models;

use Core\Validators\{EmailValidator, RequiredValidator, MatchesValidator, MinValidator, UniqueValidator};
use Exception;

class ExternalCompany extends Users
{
    public static array $fields = ['company_name' => "Company name cannot be empty", 'contact_number' => "Contact number cannot be empty", 'firstName' => "First name cannot be empty", 'lastName' => "Last name cannot be empty", 'password' => "Password cannot be empty", 'confirmPassword' => "Confirm password cannot be empty", 'email' => "Email cannot be empty", 'website' => "Website cannot be empty"];
    protected static string $table = "external";
    public $company_name, $contact_number, $status, $user_id, $external_id, $website, $description;

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
        $this->timeStamp();
        $fields = self::$fields;
        foreach ($fields as $field => $message) {
            $this->runValidator(new RequiredValidator($this, ["field" => $field, "message" => $message]));
        }
        $this->runValidator(new EmailValidator($this, ["field" => "email", "message" => "Email is not valid"]));
        $this->runValidator(new MatchesValidator($this, ["field" => "confirmPassword", "rule" => $this->password, "message" => "Passwords do not match"]));
        $this->runValidator(new MinValidator($this, ["field" => "password", "rule" => 8, "message" => "Password must be at least 8 characters"]));
        $this->runValidator(new UniqueValidator($this, ["field" => "email", "message" => "This email is already in use."]));
    }
}