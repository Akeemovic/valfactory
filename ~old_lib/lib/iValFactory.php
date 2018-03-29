<?php 

interface iValFactory {
	public function notEmpty($input);
	// public function email($input);
	// public function patternMatch($input);
	public function numeric($input);
	public function alpha($input);
	public function alphaNum($input);
	public function noWhiteSpace($input);
}



