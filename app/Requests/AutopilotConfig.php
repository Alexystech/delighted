<?php
namespace Welldex\Requests;

class AutopilotConfig
{
    public function __construct()
    {
        \Delighted\Client::setApiKey('RF4e44Wbzq0v3lyU0zWdrDmEAMwqUbJC');
    }

    public static function getAutopilotConfig()
    {
        //$config = \Delighted\AutopilotConfiguration::retrieve('email');

        //return $config;
    }
}
?>