<?php 
namespace Stackflix\ValFactory\Interfaces;

interface ValidationRulesInterface {
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



