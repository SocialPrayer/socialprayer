<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Form::component('bsInput', 'components.form.input', ['type' => 'text', 'name', 'label' => null, 'value' => null, 'attributes' => [], 'default' => null]);

		Blade::extend(function($value) {
		    return preg_replace('/\@var(.+)/', '<?php ${1}; ?>', $value);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
