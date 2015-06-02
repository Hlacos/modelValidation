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
        $validateable = $this->attributes;
        if ($this->validateableRelationMethods) {
            foreach ($this->validateableRelationMethods as $relation) {
                if (isset($this->validateableRelations[$relation])) {
                    if (is_array($this->validateableRelations[$relation])) {
                        foreach ($this->validateableRelations[$relation] as $key => $relation2) {
                            $validateable[$relation][$key] = $relation2->isValid() ? $relation2 : null;
                        }
                    } else {
                        $validateable[$relation] = $this->validateableRelations[$relation]->isValid() ? $this->validateableRelations[$relation] : null;
                    }
                } else {
                    $validateable[$relation] = null;
                }
            }
        }

        $validator = Validator::make($validateable, $this->rules());

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
