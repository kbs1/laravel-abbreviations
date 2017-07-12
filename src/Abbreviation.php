<?php

namespace Kbs1\Abbreviations;

use Illuminate\Support\Facades\Facade;

class Abbreviation extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \Kbs1\Abbreviations\AbbreviationsService::class;
	}
}
