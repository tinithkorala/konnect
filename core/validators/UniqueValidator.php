<?php

namespace Core\Validators;

use Core\Helper;
use Core\Validators;

class UniqueValidator extends Validator
{
    public function runValidation(): bool
    {
        $value = $this->_object->{$this->field};
        if ($value == '' || !isset($value)) {
            return true;
        }
        $conditions = "{$this->field} = :{$this->field}";
        $bind = [$this->field => $value];
        foreach ($this->additionalFieldData as $adds) {
            $conditions .= " AND {$adds} = :{$adds}";
            $bind[$adds] = $this->_object->{$adds};
        }
        $queryParams = ['conditions' => $conditions, 'bind' => $bind];
        return !$this->_object->findFirst("user", $queryParams);
    }
}