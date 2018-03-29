<?php 
/**
* Autoloads classes
* @param $class_name
*/

spl_autoload_register(function ($class_name){
	include __DIR__ . '/lib/' . $class_name . '.php';
});