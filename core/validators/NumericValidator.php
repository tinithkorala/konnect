<?php

namespace Core\Validators;

use Core\Validators;

class NumericValidator extends Validator
{
    public function runValidation(): bool
    {
        $value = $this->_object->{$this->field};
        $passed_validation = true;
        if (!empty($value)) $passed_validation = is_numeric($value);
        return $passed_validation;
    }
}