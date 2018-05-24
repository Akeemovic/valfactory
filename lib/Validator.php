<?php
namespace Stackflix\ValFactory;

use Stackflix\ValFactory\Interfaces\ValidatorInterface;
use Stackflix\ValFactory\ValidationRules;

/**
* Validator Class
*
* ValFactory Entry Point	
*/

/**
* Autoload classes
* @param $class_name
*/
// spl_autoload_register(function ($class_name){
// 	include __DIR__ .'/'. $class_name . '.php';
// });

class Validator extends ValidationRules implements ValidatorInterface {
	public $fieldName = '';
	public $input = '';
	public $errors = [];

	/**
	 * Initialize Validation
	 * @param String $fieldName
	 * @param mixed $input
	 * @return self
	 */
	public function validate($fieldName, $input)
	{
		$this->input = $input;
		$this->fieldName = $fieldName;
		return $this;
	}

	/**
	 * Check if all validations passed
	 * by checking if the $this->errors array is empty or not...
	 * @return boolean
	 */
	public function passed()
	{
		if (empty($this->errors)) {
			// Validations Passed
			return true;
		} else {
			// Validations Failed
			return false;
		}
	}

	/**
	 * Checks if all validations failed
	 * by checking if the $this->errors array is empty or not...
	 * @return boolean
	 */
	public function failed()
	{
		if (empty($this->errors)) {
			// Validations Passed
			return false;
		} else {
			// Validations Failed
			return true;
		}
	}


	/**
	 * Destroy $errrors array after each validation session
	 */
	public function __destruct()
	{
		unset($this->errors);
	}

	/**
	 * Set Error to either Default or Custom
	 * @param string $defaultErrorMessage, string $customErrorMessage
	 * @return self
	 */
	protected function setErrorMessage($defaultErrorMessage, $customErrorMessage)
	{
		if ((isset($customErrorMessage))) {
			// Add customErrorMessage if it is set
			$this->pushErrorMessage($customErrorMessage, true);
		} else {
			// Add default error message
			$this->pushErrorMessage($defaultErrorMessage);
		}
	}


	/**
	 * Push errors into $errors array
	 * @return self
	 */
	protected function pushErrorMessage($error, $isCustomErrorMessage = false)
	{
		if ($isCustomErrorMessage === true) {
			$this->errors[$this->fieldName] = $error;
		} else {
			$this->errors[$this->fieldName] = $this->fieldName . ' ' . $error;
		}
	}

}
