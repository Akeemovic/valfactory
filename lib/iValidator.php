<?php 
namespace Stackflix\ValFactory;

interface iValidator {
	public function validate($field, $input);
	public function passed();
	public function failed();
	public function notEmpty();
	public function email();
	public function numeric();
	public function alpha();
	public function alphaNum();
	public function noWhiteSpace();
	public function unique($haystack);
	public function matchPattern($customPattern);
	public function sameAs($matchingValue);
	// public function limit($min, $max);
	// public function limitMin($min);
	// public function limitMax($max);
}



