<?php
namespace Welldex\Requests;

class AutopilotConfig
{
    public function __construct()
    {
        \Delighted\Client::setApiKey('XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh');
    }

    public static function getAutopilotConfig()
    {
        //$config = \Delighted\AutopilotConfiguration::retrieve('email');

        //return $config;
    }
}
?>