<?php
namespace Welldex\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class SurveyRequest
{
    public function __construct()
    {
        \Delighted\Client::setApiKey('XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh');
    }

    public static function getAll()
    {
        $client = new Client();
        $headers = [
          'x-api-key' => 'XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh',
          'Authorization' => 'Basic WHBGdkxadG5lVEJVZnd1WUVualp2dVVheXdXT2MxeGg6SzhpYk12bWphUFJFcio='
        ];
        $body = '';
        $request = new Request('GET', 'https://api.delighted.com/v1/survey_responses.json?per_page=100', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        $obj = json_decode($res->getBody());
        return $obj;
    }

    public static function getAllSince(string $since)
    {
        $client = new Client();
        $headers = [
            'x-api-key' => 'XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh',
            'Authorization' => 'Basic WHBGdkxadG5lVEJVZnd1WUVualp2dVVheXdXT2MxeGg6SzhpYk12bWphUFJFcio='
        ];
        $body = '';
        $request = new Request('GET', 'https://api.delighted.com/v1/survey_responses.json?since=' . $since . '&per_page=100', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        $obj = json_decode($res->getBody());
        return $obj;
    }
}
?>