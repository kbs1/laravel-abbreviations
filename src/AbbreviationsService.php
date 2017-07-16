<?php

namespace Kbs1\Abbreviations;

class AbbreviationsService
{
	protected $maximum_length, $case, $digits, $remove_abbreviations;

	public function __construct($maximum_length, $case, $digits, $remove_abbreviations)
	{
		if ($maximum_length < 1)
			throw new \InvalidArgumentException('Abbreviations maximum length must be greater than 0.');

		if (!in_array($case, ['lower', 'upper', 'original']))
			throw new \InvalidArgumentException('Abbreviations case must be either "lower", "upper" or "original".');

		$this->maximum_length = intval($maximum_length);
		$this->case = $case;
		$this->digits = $digits ? true : false;
		$this->remove_abbreviations = $remove_abbreviations ? true : false;
	}

	public function make($string)
	{
		if ($this->remove_abbreviations)
			$string = $this->removeAbbreviations($string);

		if (preg_match_all('/(^|\s)(\p{L})|(^|\p{Ll})(\p{Lu})|(\p{Lu})(\p{Ll})/u', $string, $matches) && $this->countNonEmpty($matches[2]) + $this->countNonEmpty($matches[4]) + $this->countNonEmpty($matches[5]) >= 2) {
			$letters = [];
			foreach ($matches[2] as $key => $letter) {
				if ($letter !== '')
					$letters[] = $letter;
				elseif ($matches[4][$key] !== '')
					$letters[] = $matches[4][$key];
				else
					$letters[] = $matches[5][$key];
			}

			return $this->finishAbbreviation(implode('', $letters));
		}

		$clean_string = trim(preg_replace($this->digits ? '/[\s\W]+/siu' : '/[0-9\s\W]+/siu', ' ', $string));
		$parts = explode(' ', $clean_string);
		if (count($parts) >= 2) {
			$abbreviation = '';
			foreach ($parts as $part)
				$abbreviation .= mb_substr($part, 0, 1);

			return $this->finishAbbreviation($abbreviation);
		}

		if (mb_strlen($clean_string) >= 2)
			return $this->finishAbbreviation($clean_string);

		return $this->finishAbbreviation($string);
	}

	protected function removeAbbreviations($string)
	{
		// tries to remove abbreviations from source string, if the resulting string is still suitable for abbreviation, returns the result,
		// otherwise returns original string

		$clean_string = trim($string);
		$clean_string = preg_replace('/\w+\/+\w+/siu', '', $clean_string);
		$clean_string = preg_replace('/\w+[.\/]+/siu', '', $clean_string);
		$clean_string = preg_replace('/\s+/siu', ' ', $clean_string);

		if (trim($clean_string) !== '')
			return $clean_string;

		return $string;
	}

	protected function countNonEmpty($array)
	{
		return count(array_filter($array));
	}

	protected function finishAbbreviation($string)
	{
		return $this->makeCase(mb_substr($string, 0, $this->maximum_length));
	}

	protected function makeCase($abbreviation)
	{
		if ($this->case == 'lower')
			return mb_strtolower($abbreviation);

		if ($this->case == 'upper')
			return mb_strtoupper($abbreviation);

		return $abbreviation;
	}
}
