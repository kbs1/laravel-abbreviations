<?php

namespace Kbs1\Abbreviations;

class AbbreviationsService
{
	public function make($string)
	{
		if (preg_match_all('/(^|\s)(\p{L})|(^|\p{Ll})(\p{Lu})|(\p{Lu})(\p{Ll})/u', $string, $matches) && count($matches[2]) + count($matches[4]) + count($matches[5]) >= 2) {
			$letters = [];
			foreach ($matches[2] as $key => $letter) {
				if ($letter !== '')
					$letters[] = $letter;
				elseif ($matches[4][$key] !== '')
					$letters[] = $matches[4][$key];
				else
					$letters[] = $matches[5][$key];
			}

			return mb_substr(implode('', $letters), 0, 3);
		}

		$name = trim(preg_replace('/[0-9\s_-]+/siu', ' ', $string));
		if (mb_strlen($name) >= 2)
			return mb_substr($name, 0, 3);

		return mb_substr(trim($string), 0, 3);
	}
}
