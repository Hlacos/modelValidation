<?php namespace Hlacos\ModelValidation\Validator;

use \Illuminate\Validation\Validator;

class ModelValidationValidator extends Validator
{
    public static function validateRelates($relation, $value, $parameters)
    {
        if ($parameters) {
            if ($value) {
                $allRequiredExists = true;
                foreach ($parameters as $parameter) {
                    $allRequiredExists = $allRequiredExists && isset($value[$parameter]);
                }
                return $allRequiredExists;
            }
            return false;
        } else {
            return $value;
        }
    }
}
