<?php 
namespace Hublint\ValFactory\Interfaces;

interface ValidatorInterface {
	public function validate($field, $input);
	public function passed();
	public function failed();
	// protected function setErrorMessage($defaultErrorMessage, $customErrorMessage);
	// protected function pushErrorMessage($error, $isCustomErrorMessage);
}



