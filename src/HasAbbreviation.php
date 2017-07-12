<?php

namespace Kbs1\Abbreviations;

trait HasAbbreviation
{
	// override this method to use different attribute than 'name'
	protected function abbreviationAttribute()
	{
		return 'name';
	}

	public function getAbbreviationAttribute()
	{
		return Abbreviation::make($this->{$this->abbreviationAttribute()});
	}
}
