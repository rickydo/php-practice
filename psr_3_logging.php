<?php

// require Monolog via composer (composer require monolog/monolog)
// ~1.10

include "./vendor/autoload.php";

// this will allow logger to be used in the global space
use Monolog\Logger;

// this will also bring to the global space
use Monolog\Handler\BrowserConsoleHandler;

// create a log channel
$log = new Logger('my_app');

// We only want warnings and above with 'Logger:;WARNING'
$log->pushHandler(new BrowserConsoleHandler(Logger::WARNING));


foreach (range(1,10) as $foo){
	$log->debug('Something is happening', ['foo' => $foo]);
}

	$log->warning('Maybe bad');
	$log->error('bad');
	$log->critical('Super bad.');
echo "Check the logs to see what's happening in here...";


// PSR-3 is only a set of rules and interfaces for logging, not a full logging implementation