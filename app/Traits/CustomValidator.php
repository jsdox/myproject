<?php

namespace App\Traits;

use Validator;

trait CustomValidator
{

    private $errors = [];

    public static function getValidationRules()
    {
        if (isset(static::$_rules) && count(static::$_rules)) {
            return static::$_rules;
        }
        return [];
    }
    public function validateObject($options = [])
    {
        $rules = self::getValidationRules();
        if (count($rules)) {
            foreach ($rules as $key => $value) {
                if ($this->id && is_array($value) === false && strpos($value, 'unique:') !== false) {
                    $tableName = $this->getTable();
                    $newRule = "unique:{$tableName},{$key},{$this->id}";
                    $newValue = str_replace("unique:{$tableName}", $newRule, $value);
                    $rules[$key] = $newValue;
                }
            }
            $validator = Validator::make($options, $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                foreach ($errors as $field_name => $message) {
                    $error_messages[$field_name] = $message[0];
                }
                $this->errors = $error_messages;
                return false;
            }
            
        }
        return true;
    }
 
    public function getErrors()
    {
        return $this->errors;
    }
 
    public function setError($key, $message)
    {
        $this->errors[$key] = $message;
    }
    
//    public function save(array $options = [])
//    {
//        if (!$this->validateObject($options)) {
//            return false;
//        }
//        return parent::save($options);
//    }

    
}