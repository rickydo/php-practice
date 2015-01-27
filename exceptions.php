<?php
ini_set('display_errors', 1);

include "./vendor/autoload.php";

class HttpRedirectException extends Exception {};
class HttpClientException extends Exception {};
class HttpServerException extends Exception {};

function fetchHttpBody($url)
{
	$browser = new Buzz/Browswer();
	$repsonse = $broswer->get($url);

	$content = $response->getContent();
	$statusCode = $response->getStatusCode();

	$statusGroup = substr((string) $statusCode, 0, 1);

	switch ($statusGroup){
		case '2':
			return $content;
		case '3':
			throw new HttpRedirectException('Http request was redirected', $statusCode);
		case '4':
			throw new HttpClientException('You made a bad request', $statusCode);
		case '5':
			throw new HttpServerException('The server you tried calling is not ok', $statusCode);
		default:
			throw new Exception('Got and unexpected status code of ' . $statusGroup);
	}
}


try {
	echo fetchHttpBody('http://example.org');

} 	catch(HttpRedirectException $e){
		printf('Redirect Error: %s (code %d)', $e->getMessage(), $e->getCode());
	}
	catch(HttpClientException $e){
		printf('Client Error: %s (code %d)', $e->getMessage(), $e->getCode());
	} 
	catch(HttpServerException $e){
		printf('Server Error: %s (code %d)', $e->getMessage(), $e->getCode());
	} 
	catch(Exception $e){
		printf('General Error: %s (code %d)', $e->getMessage());
	} 
