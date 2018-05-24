<?php
namespace Stackflix\ValFactory;

/**
 *  include other ValFactory class files
 */

use Stackflix\ValFactory\iValidator;

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

class Validator implements iValidator {
	public $fieldName;
	public $input;
	public $errors = array();

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
	 * Verify if Input is empty or not.
	 * @return self
	 */
	public function notEmpty()
	{
		$input = trim($this->input); 
		
		if ($input === "") {
			$this->errors[$this->fieldName] = $this->fieldName . ' cannot be empty.';
		}
		
		return $this;
	}

	/**
	 * Verify if Input is String.
	 * @return self
	 */
	public function alpha()
	{
		$input = trim($this->input); 
		
		// if $inputs matches anyhting other than Alphabets the condition is FALSE
		if (preg_match('/[^a-zA-Z\s]/', $input)) {
			$this->errors[$this->fieldName] = $this->fieldName . ' contain string only.';
		}
		
		return $this;
	}
	
	/**
	 * Verify if Input is Number.
	 * @return current object for further chaining
	 */
	public function numeric()
	{
		$input = trim($this->input); 
		
		// if $inputs matches anything other than numbers the condition is FALSE
		if (preg_match('/\D/', $input)) {
			$this->errors[$this->fieldName] = $this->fieldName . ' must be number.';
		}

		return $this;
	}

	/**
	 * Verify if Input is the combination of Alphabets and Numbers.
	 * @return self
	 */
	public function alphaNum()
	{
		$input = trim($this->input); 
		
		// if $inputs matches anyhting other than alphanumeric characters, the condition is FALSE
		if (preg_match('/[^\w\s]/', $input)) {
			$this->errors[$this->fieldName] = $this->fieldName . ' can only contain alpha numeric characters A-Z and 0-9.';
		}

		return $this;
	}

	/**
	 * Verify if Input has whitespace.
	 * @return self
	 */
	public function noWhiteSpace()
	{
		$input = trim($this->input); 
		
		if (preg_match('/\s/', $input) || strpos($input, " ")) {
			$this->errors[$this->fieldName] = $this->fieldName . ' must not contain white space characters.';
		}

		return $this;
	}

	/**
	 * Verify if Input is a valid email.
	 * @return self
	 */
	public function email()
	{
		$input = trim($this->input); 
		
		if (filter_var($input, FILTER_VALIDATE_EMAIL) == false) {
			$this->errors[$this->fieldName] = $this->fieldName . ' is invalid. Please enter a valid email address.';
		}

		return $this;
	}

	/**
	 * Verify if Input is unique among array of existing values.
	 * @param Array $haystack 
	 * @return self
	 */
	public function unique($haystack)
	{
		$input = trim($this->input); 
		
		if (in_array($input, $haystack)) {
			$this->errors[$this->fieldName] = $this->fieldName . ' already exists, enter another one.';
		}

		return $this;
	}

	/**
	 * Verify if Input matches a spacified pattern.
	 * @param Array $customPattern
	 * @return self
	 */
	public function matchPattern($customPattern)
	{
		$input = $this->input; 
		
		if (preg_match($customPattern, $input)) {
			$this->errors[$this->fieldName] = $this->fieldName . ' does not match pattern.';
		}

		return $this;
	}

	/**
	 * Check if Input is same as a specified value.
	 * @param mixed $matchingValue
	 * @return self
	 */
	public function sameAs($matchingValue)
	{
		$input = $this->input; 
		
		if ($input != $matchingValue) {
			$this->errors[$this->fieldName] = $this->fieldName . ' not match.';
		}

		return $this;
	}

	/**
	 * Destroy $errrors array after each validation session
	 */
	public function __destruct()
	{
		unset($this->errors);
	}
}
