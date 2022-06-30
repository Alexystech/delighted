<?php
namespace Welldex\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MetricsRequest
{
    public function __construct()
    {
        \Delighted\Client::setApiKey('RF4e44Wbzq0v3lyU0zWdrDmEAMwqUbJC');
    }

    public static function getMetrics()
    {
        $client = new Client();
        $headers = [
          'x-api-key' => 'RF4e44Wbzq0v3lyU0zWdrDmEAMwqUbJC',
          'Authorization' => 'Basic UkY0ZTQ0V2J6cTB2M2x5VTB6V2RyRG1FQU13cVViSkM6SzhpYk12bWphUFJFcio='
        ];
        $request = new Request('GET', 'https://api.delighted.com/v1/metrics.json', $headers);
        $res = $client->sendAsync($request)->wait();
        $obj = json_decode($res->getBody());
        return $obj;
    }
}
?>