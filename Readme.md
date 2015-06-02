# ModelValidation bundle

Laravel 5 bundle for validate in models.

It's under development, not recommended for production use!

# Installation

1. add bundle to composer: "hlacos/model_validation": "dev-master"
2. composer install / update
3. add service provider to the providers list: 'Hlacos\ModelValidation\ModelValidationServiceProvider'

# Usage

In the rules array use the laravel validator formats.

<pre>
class CustomModel extends Eloquent {
    use ModelValidationTrait;

    public $rules = array(
        'attribute' => 'required',
    );
}

$customModel = new CustomModel();
$customModel->setAttributes($attributes);

if ($customModel->isValid()) {
    $customModel->save();
} else {
    return $customModel->errors;
}
</pre>
