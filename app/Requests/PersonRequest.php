<?php

namespace Welldex\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Welldex\Entities\Person as EntityPerson;
use Welldex\Env\DevEnv;

class PersonRequest 
{

    public function __construct() {
        \Delighted\Client::setApiKey("XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh");
    }

    public static function create(EntityPerson $person)
    {
        return \Delighted\Person::create([
            'email' => $person->getEmail(),
            'name'  => $person->getName(),
            'delay' => $person->getDelay()
        ]);
    }

    public static function getAll()
    {
        $client = new Client();
        $headers = [
            'x-api-key' => "XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh",
            'Authorization' => "Basic WHBGdkxadG5lVEJVZnd1WUVualp2dVVheXdXT2MxeGg6SzhpYk12bWphUFJFcio="
        ];
        $request = new Request('GET', 'https://api.delighted.com/v1/people.json', $headers);
        $res = $client->sendAsync($request)->wait();
        $obj = json_decode($res->getBody());
        return $obj;
    }

    public static function deleteByEmail(string $email)
    {
        \Delighted\Person::delete(array('email' => $email));

        return true;
    }

    public static function deleteById(string $id)
    {
        \Delighted\Person::delete(array('id' => $id));
    }

    public static function getUnsubscribedPeople()
    {
        $client = new Client();
        $headers = [
          'x-api-key' => 'XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh',
          'Authorization' => 'Basic UkY0ZTQ0V2J6cTB2M2x5VTB6V2RyRG1FQU13cVViSkM6SzhpYk12bWphUFJFcio='
        ];
        $request = new Request('GET', 'https://api.delighted.com/v1/unsubscribes.json', $headers);
        $res = $client->sendAsync($request)->wait();
        return $res->getBody();
    }

    public static function getBouncedPeople()
    {
        $client = new Client();
        $headers = [
          'x-api-key' => 'XpFvLZtneTBUfwuYEnjZvuUaywWOc1xh',
          'Authorization' => 'Basic UkY0ZTQ0V2J6cTB2M2x5VTB6V2RyRG1FQU13cVViSkM6SzhpYk12bWphUFJFcio='
        ];
        $request = new Request('GET', 'https://api.delighted.com/v1/bounces.json', $headers);
        $res = $client->sendAsync($request)->wait();
        $obj = json_decode($res->getBody());
        return $obj;
    }

}
