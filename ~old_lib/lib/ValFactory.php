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

	/**
	 * Verifies if Input is Empty or not.
	 * @param mixed $input
	 * @return boolean 
	 */
	public function notEmpty($input){
		$input = trim($input); 
		
		if ($input === ""){
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Verifies if Input is String.
	 * @param mixed $input
	 * @return boolean 
	 */
	public function alpha($input){
		$input = trim($input); 
		// if $inputs matches anyhting other than Alphabets the condition is FALSE
		if (preg_match('/[^a-zA-Z]/', $input)){
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * Verifies if Input is Number.
	 * @param mixed $input
	 * @return boolean 
	 */
	public function numeric($input){
		$input = trim($input); 
		// if $inputs matches anyhting other than digits the condition is FALSE
		if (preg_match('/[^\d]/', $input)){
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Verifies if Input is the combination of Alphabets and Numbers.
	 * @param mixed $input
	 * @return boolean 
	 */
	public function alphaNum($input){
		$input = trim($input); 
		// if $inputs matches anyhting other than alphanumeric characters, the condition is FALSE
		if (preg_match('/[^\d\w]/', $input)){
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Verifies if Input has whitespace.
	 * @param mixed $input
	 * @return boolean 
	 */
	public function noWhiteSpace($input){
		$input = trim($input); 
		
		if (strpos($input, " ")){
			return false;
		} else {
			return true;
		}
	}

}
