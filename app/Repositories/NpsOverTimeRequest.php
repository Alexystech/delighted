<?php
namespace Welldex\Repositories;

use ArrayObject;
use Welldex\Utils\Connection;

class NpsOverTimeRequest
{
    public function __construct() {}

    public static function getChartInformation()
    {
        $conn = new Connection();
        $db = $conn->getConnection();
        $arrayObject = new ArrayObject();

        $response = $db->fetchRowMany('SELECT nps, promoters_count, promoters_percent, pasive_count, pasive_percent, detractors_count, detractors_percent, responses_count, date FROM nps_over_time');
        foreach ($response as $item)
        {
            $npsResponse = [
                $item["nps"],
                $item["date"]
            ];

            $arrayObject->append($npsResponse);
        }

        
        return $arrayObject;
    }
}
?>