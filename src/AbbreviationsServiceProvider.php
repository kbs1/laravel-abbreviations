<?php

namespace Kbs1\Abbreviations;

use Illuminate\Support\ServiceProvider;

class AbbreviationsServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('Abbreviation', function() {
			return new \Kbs1\Abbreviation;
		});
	}
}
