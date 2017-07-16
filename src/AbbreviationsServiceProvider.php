<?php

namespace Kbs1\Abbreviations;

use Illuminate\Support\ServiceProvider;

class AbbreviationsServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../config/abbreviations.php' => config_path('abbreviations.php'),
		], 'abbreviations');

		$this->registerHelpers();
	}

	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../config/abbreviations.php', 'abbreviations'
		);

		$this->app->singleton(AbbreviationsService::class, function ($app) {
			return new AbbreviationsService(config('abbreviations.maximum_length'), config('abbreviations.case'), config('abbreviations.digits'), config('abbreviations.remove_abbreviations'));
		});
	}

	public function registerHelpers()
	{
		require_once __DIR__ . '/helpers.php';
	}
}
