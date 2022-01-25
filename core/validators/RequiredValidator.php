<?php

namespace Core\Validators;

class RequiredValidator extends Validator
{
    /**
     * @return bool
     */
    public function runValidation(): bool
    {
        $value = trim($this->_object->{$this->field});
        return $value != '' && isset($value);
    }
}