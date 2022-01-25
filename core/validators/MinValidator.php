<?php

namespace Core\Validators;

use Core\Validators;

class MinValidator extends Validator
{
    public function runValidation(): bool
    {
        $value = $this->_object->{$this->field};
        return strlen($value) >= $this->rule;
    }
}