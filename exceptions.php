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
