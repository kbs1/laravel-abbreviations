<?php

return [
	// defines maximum length of generated abbreviations
	'maximum_length' => 3,

	// should generated abbreviations be strictly uppercase, lowercase, or original case in picked letters?
	// one of 'lower', 'upper', 'original'
	'case' => 'upper',

	// allow digits in generated abbreviations? If false, library will try to aviod this, but for strings like "987",
	// generated abbreviations will still contain digits.
	'digits' => false,

	// remove abbreviations from source string? Removes phrases like "incl." or "w/" before processing.
	'remove_abbreviations' => true,
];
