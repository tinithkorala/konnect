<?php

namespace Core\Validators;

class MatchesValidator extends Validator
{
    public function runValidation(): bool
    {
        $value = $this->_object->{$this->field};
        return $value == $this->rule;
    }
}