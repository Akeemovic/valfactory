<?php 
require __DIR__ . '../vendor/autoload.php';
// require_once(dirname(__FILE__) . '/lib/Validator.php');

// use Stackflix\ValFactory\Validator;

$val = new \Stackflix\ValFactory\Validator();

$alphanum = $_POST['alphanum'];
$text = $_POST['text'];
$num = $_POST['number'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password-confirm'];


// var_dump($_POST);
// die();

echo '<p>Alpha Numeric: ' . $alphanum . '</p>';
echo '<p>Alphabet: ' . $text . '</p>';
echo '<p>Numeric: ' . $num . '</p>';
echo '<p>Email: ' . $email . '</p>';
echo '<p>Password: ' . $password . '</p>';
echo '<p>Confirm Password: ' . $passwordConfirm . '</p>';

$existingEmails = ['akeemovic@slackwave.net', 'halayindex@slackwave.net'];

$val->validate('AlphaNumericField', $alphanum)->notEmpty()->alphaNum()->noWhiteSpace();
$val->validate('TextField', $text)->notEmpty()->alpha()->noWhiteSpace();
$val->validate('NumericField', $num)->notEmpty()->numeric();
$val->validate('EmailField', $email)->email()->unique($existingEmails);
$val->validate('Password', $password)->notEmpty()->noWhiteSpace();
$val->validate('Password Confirmation', $passwordConfirm)->sameAs($password);

echo "<pre>";
	var_dump($val->errors);
echo "</pre>";

if($val->failed()){
	foreach($val->errors as $error){
		echo $error . '<br>';
	}
} else { 
	echo "Hurray! There are no errors.";
}

echo "<hr>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<form action="<?php $_SERVER['SCRIPT_NAME']?>" method="post">
		<p><input type="text" name="alphanum" id="" placeholder="Alphanumeric"></p>
		<p><input type="text" name="text" id="" placeholder="Text"></p>
		<p><input type="text" name="number" id="" placeholder="Number"></p>
		<p><input type="password" name="password" id="" placeholder="Password"></p>
		<p><input type="password" name="password-confirm" id="" placeholder="Confirm Password"></p>
		<p><input type="text" name="email" id="" placeholder="Email"></p>
		
		<p><input type="checkbox" name="checkbox" id=""></p>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
