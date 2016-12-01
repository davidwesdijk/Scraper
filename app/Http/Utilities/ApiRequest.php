<?php

namespace App\Http\Utilities;

class ApiRequest {
	/**
	 * Protected method to run CURL requests for JSON Responses 
	 * @param  string 	$url 	Url that must be CURL'ed
	 * @return array      		JSON decoded array
	 */
	protected static function getRequest($url)
	{
		$ch = curl_init();

        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);

        return json_decode($data);
	}

	/**
	 * Retrieve the results from Google by the CSE API with optional starting point
	 * since the limit of the results are 10.
	 * 
	 * @param  string  	$keyword
	 * @param  integer 	$start
	 * @return array
	 */
	public static function fetchGoogle($keyword, $start = 1)
	{
		$url = 'https://www.googleapis.com/customsearch/v1';

		// Set parameters for the request
		$parameters = array(
			'q' => urlencode(str_replace(' ', '+', $keyword)),
			'cx' => config('app.google_cx_key'),
			'fields' => urlencode('items(link,snippet,title),searchInformation/totalResults'),
			'start' => $start,
			'key' => config('app.google_apikey')
		);
	
		// Url-ify the parameters
		$fields = '?';
		foreach ($parameters as $key => $value)
		{
			$fields .= $key .'='. $value .'&';
		}
		rtrim($fields, '&');

		return static::getRequest($url . $fields);
	}
}