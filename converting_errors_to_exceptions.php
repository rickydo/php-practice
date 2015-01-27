<?php 

ini_set('display_errors', 1);
// errno will return a number pertaining to the error
// errstr will return a human readable error

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
	throw new ErrorException($errstr, 0, $errno, $errfile, $errfile);
});

try{	
	$handle = fopen('nope.txt', 'r');
} catch (ErrorException $e) {
	echo "<p> Can't find the file.</p>";
}

echo "<p>Do something else</p>";

// an E_NOTICE error that has been converted to ErrorException and goes uncaught will result in a fatal error
// When converting errors to exception, use ErrorException