<?php

namespace Core\Validators;

use Core\Validators\Validator;

class EmailValidator extends Validator
{
    public function runValidation()
    {
        $email = $this->_object->{$this->field};
        $passed_validation = true;
        if (!empty($email)) $passed_validation = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $passed_validation;
    }
}
