<?php

namespace Hlacos\ModelValidation;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Validator;
use \Hlacos\ModelValidation\Validator\ModelValidationValidator;

class ModelValidationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

	public function boot()
	{
		Validator::extendImplicit('relates', function($attribute, $value, $parameters) {
			return ModelValidationValidator::validateRelates($attribute, $value, $parameters);
		});
	}

}
