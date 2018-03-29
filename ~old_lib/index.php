<?php 

require __DIR__ . '/autoloader.php';

$val = new ValFactory();

$alphanum = $_POST['alphanum'];
$text = $_POST['text'];
$num = $_POST['number'];
$email = $_POST['email'];

// var_dump($_POST);
// die();

$inputs = [
	$alphanum,
	$text,
	$num,
	$email
];

foreach($inputs as $input){
	if ($val->notEmpty($input)) {
		echo "<p> $input is not Empty </p>";
	} else {
		echo "<p> $input Empty </p>";
	}
}

echo "<hr>";

foreach($inputs as $input){
	if ($val->alpha($input)) {
		echo "<p> $input is a string </p>";
	} else {
		echo "<p> $input is not an string </p>";
	}
}

echo "<hr>";

foreach($inputs as $input){
	if ($val->numeric($input)) {
		echo "<p> $input is a number </p>";
	} else {
		echo "<p> $input is not an number </p>";
	}
}

echo "<hr>";

foreach($inputs as $input){
	if ($val->alphaNum($input)) {
		echo "<p> $input is AlphaNumeric </p>";
	} else {
		echo "<p> $input is not AlphaNumeric </p>";
	}
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
		<p><input type="text" name="email" id="" placeholder="Email"></p>
		
		<p><input type="checkbox" name="checkbox" id=""></p>
		<button type="submit">Submit</button>
	</form>
</body>
</html>