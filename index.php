<?php 
require __DIR__ . '../vendor/autoload.php';
// require_once(dirname(__FILE__) . '/lib/Validator.php');

// use Hublint\ValFactory\Validator;

$val = new \Hublint\ValFactory\Validator();

$alphanum = '';
$text = '';
$num = '';
$email = '';
$password = '';
$passwordConfirm = '';

if ((isset($_POST['submit'])) && ($_POST['submit'] === 'submitted')){
	
	$alphanum = $_POST['alphanum'];
	$text = $_POST['text'];
	$num = $_POST['number'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordConfirm = $_POST['passwordConfirm'];

	// echo '<p>Alpha Numeric: ' . $alphanum . '</p>';
	// echo '<p>Alphabet: ' . $text . '</p>';
	// echo '<p>Numeric: ' . $num . '</p>';
	// echo '<p>Email: ' . $email . '</p>';
	// echo '<p>Password: ' . $password . '</p>';
	// echo '<p>Confirm Password: ' . $passwordConfirm . '</p>';

	$existingEmails = ['akeemovic@slackwave.net', 'halayindex@slackwave.net'];

	$val->validate('alphanum', $alphanum)->notEmpty()->alphaNum()->noWhiteSpace()->limitMin(10);
	$val->validate('text', $text)->notEmpty()->alpha()->noWhiteSpace()->limitMax(10);
	$val->validate('number', $num)->notEmpty()->numeric()->limit(5, 10);
	$val->validate('email', $email)->email()->unique($existingEmails, "We won't take that Email");
	$val->validate('password', $password)->notEmpty()->noWhiteSpace();
	$val->validate('password confirmation', $passwordConfirm)->sameAs($password);
}

// echo "<pre>";
// 	var_dump($val->errors);
// echo "</pre>";

// Check for Validation status
if ($val->failed()) {
	foreach($val->errors as $error){
		echo $error . '<br>';
	}
} else { 
	echo "<h3>Hurray! There are no errors.</h3>";
}

echo "Passed: " . $val->passed() . ":: Failed: " . $val->failed();
echo "<hr>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style type="text/css" media="screen">
		.form-group {
			border: 1px solid #888;
			margin:  0;
			padding: 4px 5px;
			margin-bottom: 10px;
		}
		.form-group input {
			padding: 5px;
			border: 1px solid #000;
			border-radius: 6px;
		}
		.form-group p {
			margin: 0 0 5px 0;
		}
	</style>
</head>
<body>
	<form action="<?php $_SERVER['SCRIPT_NAME']?>" method="post">
		<div class="form-group">
			<p><?php if (isset($val->errors['alphanum'])) { echo  $val->errors['alphanum']; } else { echo "Clean"; } ?></p>
			<p><input type="text" name="alphanum" id="" placeholder="Alphanumeric" value="<?php echo $alphanum ?>"></p>
		</div>
		<div class="form-group">
			<p><?php if (isset($val->errors['text'])) { echo  $val->errors['text']; } else { echo "Clean"; } ?></p>
			<p><input type="text" name="text" id="" placeholder="Text" value="<?php echo $text ?>"></p>
		</div>	
		<div class="form-group">
			<p><?php if (isset($val->errors['number'])) { echo  $val->errors['number']; } else { echo "Clean"; } ?></p>
			<p><input type="text" name="number" id="" placeholder="Number" value="<?php echo $num ?>"></p>
		</div>
		<div class="form-group">
			<p><?php if (isset($val->errors['password'])) { echo  $val->errors['password']; } else { echo "Clean"; } ?></p>
			<p><input type="password" name="password" id="" placeholder="Password" value="<?php echo $password ?>"></p>
		</div>
		<div class="form-group">
			<p><?php if (isset($val->errors['password confirmation'])) { echo $val->errors['password confirmation']; } else { echo "Clean"; } ?></p>
			<p><input type="password" name="passwordConfirm" id="" placeholder="Confirm Password" value="<?php echo $passwordConfirm; ?>"></p>
		</div>
		<div class="form-group">
			<p><?php if (isset($val->errors['email'])) { echo $val->errors['email']; } else { echo "Clean"; }?></p>
			<p><input type="text" name="email" id="" placeholder="Email" value="<?php echo $email ?>"></p>
		</div>
		
		
		<p><input type="checkbox" name="checkbox" id=""></p>
		<button type="submit" name="submit" value="submitted">Submit</button>
	</form>
</body>
</html>
