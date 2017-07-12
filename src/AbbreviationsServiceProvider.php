<?php

namespace Kbs1\Abbreviations;

use Illuminate\Support\ServiceProvider;

class AbbreviationsServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->singleton(\Kbs1\Abbreviations\AbbreviationsService::class);
	}
}
