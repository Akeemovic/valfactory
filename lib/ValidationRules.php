<?php 
namespace Hublint\ValFactory;

use Hublint\ValFactory\Interfaces\ValidationRulesInterface;

/**
* Validation Rules
*/
class ValidationRules implements ValidationRulesInterface {

	/**
	 * Verify if Input is empty or not.
	 * @return self
	 */
	public function notEmpty($customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		if ($input === "") {
			$this->setErrorMessage('cannot be blank.', $customErrorMessage);
		}
		
		return $this;
	}

	/**
	 * Verify if Input is String.
	 * @return self
	 */
	public function alpha($customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		// if $inputs matches anyhting other than Alphabets the condition is FALSE
		if (preg_match('/[^a-zA-Z\s]/', $input)) {
			$this->setErrorMessage('can only conatin plain text (Aa-Zz).', $customErrorMessage);
		}
		
		return $this;
	}
	
	/**
	 * Verify if Input is Number.
	 * @return self object for further chaining
	 */
	public function numeric($customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		// if $inputs matches anything other than numbers the condition is FALSE
		if (preg_match('/\D/', $input)) {
			$this->setErrorMessage('must be number.', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Verify if Input is the combination of Alphabets and Numbers.
	 * @return self
	 */
	public function alphaNum($customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		// if $inputs matches anyhting other than alphanumeric characters, the condition is FALSE
		if (preg_match('/[^\w\s]/', $input)) {
			$this->setErrorMessage('can only contain alpha numeric characters A-Z and/or 0-9.', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Verify if Input has whitespace.
	 * @return self
	 */
	public function noWhiteSpace($customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		if (preg_match('/\s/', $input) || strpos($input, " ")) {
			$this->setErrorMessage('must not contain white space characters.', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Verify if Input is a valid email.
	 * @return self
	 */
	public function email($customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		if (filter_var($input, FILTER_VALIDATE_EMAIL) == false) {
			$this->setErrorMessage('is invalid. Please enter a valid email address.', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Verify if Input is unique among array of existing values.
	 * @param Array $haystack 
	 * @return self
	 */
	public function unique($haystack, $customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		if (in_array($input, $haystack)) {
			$this->setErrorMessage('already exists, enter another one.', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Verify if Input matches a spacified pattern.
	 * @param string $customPattern
	 * @return self
	 */
	public function matchPattern($customPattern, $customErrorMessage = null)
	{
		$input = $this->input; 
		
		if (preg_match($customPattern, $input)) {
			$this->setErrorMessage('does not match pattern.', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Check if Input is same as a specified value.
	 * @param mixed $matchingValue
	 * @return self
	 */
	public function sameAs($matchingValue, $customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		if ($input == '' || !isset($input)) {
			$this->setErrorMessage('invalid match.', $customErrorMessage);
		} elseif ($input !== $matchingValue) {
			$this->setErrorMessage('not match.', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Verify both Minimum and Maximum Limits
	 * @return self
	 */
	public function limit($minCount, $maxCount, $customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		if (strlen($input) < $minCount || strlen($input) > $maxCount) {
			$this->setErrorMessage('cannot be less than ' . $minCount . ' or more than ' . $maxCount . ' characters', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Verify Minimum Limits
	 * @return self
	 */
	public function limitMin($minCount, $customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		if (strlen($input) < $minCount ) {
			$this->setErrorMessage('cannot be less than ' . $minCount . ' characters', $customErrorMessage);
		}

		return $this;
	}

	/**
	 * Verify Maximum Limits
	 * @return self
	 */
	public function limitMax($maxCount, $customErrorMessage = null)
	{
		$input = trim($this->input); 
		
		if (strlen($input) > $maxCount) {
			$this->setErrorMessage('cannot be or more than ' . $maxCount . ' characters', $customErrorMessage);
		}

		return $this;
	}
	
}

