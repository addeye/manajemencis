<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
		$this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);

		Relation::morphMap([
			'koperasi' => 'App\Koperasi',
			'kumkm' => 'App\Kumkm',
		]);
	}
}
