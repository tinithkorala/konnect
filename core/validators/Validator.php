<?php

namespace Core\Validators;

use Core\Helper;
use Exception;

abstract class Validator
{
    public $field, $rule;
    public bool $includeDeleted = false;
    public array $additionalFieldData = [];
    public string $message = "";
    public bool $success = true;
    protected $_object;

    /**
     * @param $obj
     * @param $params
     * @throws Exception
     */
    public function __construct($obj, $params)
    {
        $this->_object = $obj;
        if (!array_key_exists('field', $params)) {
            throw new Exception("Params array is missing fields");
        }
        $this->field = $params['field'];
        if (is_array($params['field'])) {
            $this->field = $params['field'][0];
            array_shift($params['field']);
            $this->additionalFieldData = $params['field'];
        }
        if (!property_exists($this->_object, $this->field)) {
            throw new Exception("Field does not exist on the model object");
        }
        if (!array_key_exists('message', $params)) {
            throw new Exception("Params array is missing the message field");
        }
        $this->message = $params['message'];
        if (array_key_exists('rule', $params)) $this->rule = $params['rule'];
        if (array_key_exists('includeDeleted', $params)) $this->includeDeleted = $params['includeDeleted'];
        try {
            $this->success = $this->runValidation();
        } catch (Exception $exception) {
            echo "Validation exception on " . get_class() . ":" . $exception->getMessage() . "<br/>";
        }
    }

    abstract public function runValidation();
}