<?php namespace Hlacos\ModelValidation\Traits;

use Illuminate\Support\Facades\Validator;

trait ModelValidationTrait {

    public $errors;

    public function save(array $options = array())
    {
        if ($this->isValid()) {
            return parent::save($options);
        } else {
            return false;
        }
    }

    public function isValid() {
        $validator = Validator::make($this->attributes, $this->rules());

        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        } else {
            return true;
        }
    }

    private function rules() {
        $id = $this->id ?: 0;
        return array_map(function($rule) use ($id) {
            return str_replace('{id}', $id, $rule);
        }, $this->rules);
    }
}
