<?php
/**
*	ValVactory Class
*/

/**
* Autoloads classes
* @param $class_name
*/
spl_autoload_register(function ($class_name){
	include __DIR__ .'/'. $class_name . '.php';
});

class ValFactory implements iValFactory {
	public $fieldName;
	public $input;
	public $errors = array();

	public function __destruct(){
		// Destroys errrors array after each validation session
		unset($this->errors);
	}

	/**
	 * Initializes Validation
	 * @param String $fieldName, mixed $input
	 * @return current object for further chaining
	 */
	public function validate($fieldName, $input){
		$this->input = $input;
		$this->fieldName = $fieldName;
		return $this;
	}

	/**
	 * Checks whether validations passed
	 * by checking if the $this->errors array is empty or not...
	 * @return boolean
	 */
	public function passed(){
		if(empty($this->errors)){
			// Validations Passed
			return true;
		} else {
			// Validations Failed
			return false;
		}
	}

	/**
	 * Checks whether validations failed
	 * by checking if the $this->errors array is empty or not...
	 * @return boolean
	 */
	public function failed(){
		if(empty($this->errors)){
			// Validations Passed
			return false;
		} else {
			// Validations Failed
			return true;
		}
	}

	/**
	 * Verifies if Input is Empty or not.
	 * @return current object for further chaining 
	 */
	public function notEmpty(){
		$input = trim($this->input); 
		
		if ($input === ""){
			$this->errors[$this->fieldName] = $this->fieldName . ' cannot be empty.';
		}
		
		return $this;
	}

	/**
	 * Verifies if Input is String.
	 * @return current object for further chaining 
	 */
	public function alpha(){
		$input = trim($this->input); 
		
		// if $inputs matches anyhting other than Alphabets the condition is FALSE
		if (preg_match('/[^a-zA-Z\s]/', $input)){
			$this->errors[$this->fieldName] = $this->fieldName . ' contain string only.';
		}
		
		return $this;
	}
	
	/**
	 * Verifies if Input is Number.
	 * @return current object for further chaining
	 */
	public function numeric(){
		$input = trim($this->input); 
		
		// if $inputs matches anything other than numbers the condition is FALSE
		if (preg_match('/\D/', $input)){
			$this->errors[$this->fieldName] = $this->fieldName . ' must be number.';
		}

		return $this;
	}

	/**
	 * Verifies if Input is the combination of Alphabets and Numbers.
	 * @return current object for further chaining 
	 */
	public function alphaNum(){
		$input = trim($this->input); 
		
		// if $inputs matches anyhting other than alphanumeric characters, the condition is FALSE
		if (preg_match('/[^\w\s]/', $input)){
			$this->errors[$this->fieldName] = $this->fieldName . ' can only contain alpha numeric characters A-Z and 0-9.';
		}

		return $this;
	}

	/**
	 * Verifies if Input has whitespace.
	 * @return current object for further chaining 
	 */
	public function noWhiteSpace(){
		$input = trim($this->input); 
		
		if (preg_match('/\s/', $input) || strpos($input, " ")){
			$this->errors[$this->fieldName] = $this->fieldName . ' must not contain white space characters.';
		}

		return $this;
	}

	/**
	 * Verifies if Input is a valid email.
	 * @return current object for further chaining 
	 */
	public function email(){
		$input = trim($this->input); 
		
		if (filter_var($input, FILTER_VALIDATE_EMAIL) == false){
			$this->errors[$this->fieldName] = $this->fieldName . ' is invalid. Please enter a valid email address.';
		}

		return $this;
	}

	/**
	 * Verifies if Input is unique among array of existing values.
	 * @param Array $haystack 
	 * @return current object for further chaining 
	 */
	public function unique($haystack){
		$input = trim($this->input); 
		
		if (in_array($input, $haystack)){
			$this->errors[$this->fieldName] = $this->fieldName . ' already exists, enter another one.';
		}

		return $this;
	}

	/**
	 * Verifies if Input matches a spacified pattern.
	 * @param Array $customPattern
	 * @return current object for further chaining 
	 */
	public function matchPattern($customPattern){
		$input = trim($this->input); 
		
		if (preg_match($customPattern, $input)){
			$this->errors[$this->fieldName] = $this->fieldName . ' does not match pattern.';
		}

		return $this;
	}

}
