<?php
namespace Welldex\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MetricsRequest
{
    public function __construct()
    {
        \Delighted\Client::setApiKey('XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh');
    }

    public static function getMetrics()
    {
        $client = new Client();
        $headers = [
          'x-api-key' => 'XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh',
          'Authorization' => 'Basic WHBGdkxadG5lVEJVZnd1WUVualp2dVVheXdXT2MxeGg6SzhpYk12bWphUFJFcio='
        ];
        $request = new Request('GET', 'https://api.delighted.com/v1/metrics.json', $headers);
        $res = $client->sendAsync($request)->wait();
        $obj = json_decode($res->getBody());
        return $obj;
    }
}
?>