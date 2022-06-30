<?php
namespace Welldex\Repositories;

use ArrayObject;
use SplDoublyLinkedList;
use Welldex\Entities\SurveyResponse;
use Welldex\Requests\SurveyRequest;
use Welldex\Utils\Connection;

class SurveyRepository
{

    public function __construct() {}

    public static function insertSurveyResponses()
    {
        $conn = new Connection();
        $db = $conn->getConnection();

        /*
        $resp = SurveyRequest::getAll();

        foreach ($resp as $item)
        {
            $data = [
                'id' => $item->id,
                'person' => $item->person,
                'survey_type' => $item->survey_type,
                'score' => $item->score,
                'comment' => $item->comment,
                'permalink' => $item->permalink,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at
            ];

            $db->insert('survey_responses', $data);
        }*/

        //ultimo registro de survey_responses de la bd local
        $since = $db->fetchRow('SELECT updated_at from survey_responses order by updated_at desc limit 1');

        //filtro de los registros desde la fecha del ultimo registro
        //hasta la fecha actual de la bd de delighted
        //$listFiltered = SurveyRequest::getAllSince($since["updated_at"]);
        $listFiltered = SurveyRequest::getAllSince(1650916630);

        //registrar la lista filtrada a la base de datos local
        foreach ($listFiltered as $item)
        {
            $data = [
                'id'            => $item->id,
                'person'        => $item->person,
                'survey_type'   => $item->survey_type,
                'score'         => $item->score,
                'comment'       => $item->comment,
                'permalink'     => $item->permalink,
                'created_at'    => $item->created_at,
                'updated_at'    => $item->updated_at
            ];

            $db->insert('survey_responses', $data);
        }

        //fecha actual
        $localDate = strtotime(date('d-m-Y H:i:s'));

        //contar promoters, pasive and detractors
        $promoters = 0;
        $pasive = 0;
        $detractors = 0;

        foreach ($listFiltered as $item)
        {
            if ( $item->score >= 0 && $item->score <= 6 )
            {
                $detractors += 1;
            } else if ( $item->score >= 7 && $item->score <= 8 )
            {
                $pasive += 1;
            } else 
            {
                $promoters += 1;
            }
        }

        $responses = $promoters + $pasive + $detractors;
        $promotersPercent = ($promoters * 100) / $responses;
        $pasivePercent = ($pasive * 100) / $responses;
        $detractorsPercent = ($detractors * 100) / $responses;
        $nps = $promotersPercent - $detractorsPercent;
        
        //registrar la informacion obtenida a la tabla nps_over_time
        $npsOverTimeData = [
            'nps' => $nps,
            'promoters_count'       => $promoters,
            'promoters_percent'     => $promotersPercent,
            'pasive_count'          => $pasive,
            'pasive_percent'        => $pasivePercent,
            'detractors_count'      => $detractors,
            'detractors_percent'    => $detractorsPercent,
            'responses_count'       => $responses,
            'date'                  => $localDate
        ];

        $db->insert('nps_over_time', $npsOverTimeData);
    }

    public static function getAllSurveyResponses()
    {
        $conn = new Connection();
        $db = $conn->getConnection();
        $resp = $db->fetchRowMany('SELECT id, person, survey_type, score, comment, permalink, created_at, updated_at FROM survey_responses');
        $myListOfArrays = new ArrayObject();

        foreach ($resp as $surveys)
        {
            $dateCreated = date("d F Y H:i:s", $surveys["created_at"]);
            $dateUpdated = date("d F Y H:i:s", $surveys["updated_at"]);

            $surveyResponse = [
                "id"            => $surveys["id"],
                "person"        => $surveys["person"],
                "survey_type"   => $surveys["survey_type"],
                "score"         => $surveys["score"],
                "comment"       => $surveys["comment"],
                "permalink"     => $surveys["permalink"],
                "created_at"    => $dateCreated,
                "updated_at"    => $dateUpdated
            ];

            $myListOfArrays->append($surveyResponse);
        }

        return $myListOfArrays;
    }

    public static function deleteAllSurveyResponses()
    {
        $conn = new Connection();
        $db = $conn->getConnection();
        
        $db->delete('survey_responses', ['id' => '192817417']);
        $db->delete('survey_responses', ['id' => '192818827']);
        $db->delete('survey_responses', ['id' => '192818887']);
        $db->delete('survey_responses', ['id' => '192819909']);
        $db->delete('survey_responses', ['id' => '192820827']);
        $db->delete('survey_responses', ['id' => '192822904']);
        $db->delete('survey_responses', ['id' => '192823904']);
        $db->delete('survey_responses', ['id' => '192825038']);
        $db->delete('survey_responses', ['id' => '192825418']);
        $db->delete('survey_responses', ['id' => '192825614']);

        $db->delete('survey_responses', ['id' => '192828202']);
        $db->delete('survey_responses', ['id' => '192829563']);
        $db->delete('survey_responses', ['id' => '192831375']);
        $db->delete('survey_responses', ['id' => '192833887']);
        $db->delete('survey_responses', ['id' => '192834427']);
        $db->delete('survey_responses', ['id' => '192834968']);
        $db->delete('survey_responses', ['id' => '192835569']);
        $db->delete('survey_responses', ['id' => '192837692']);
        $db->delete('survey_responses', ['id' => '192840784']);
        $db->delete('survey_responses', ['id' => '192841637']);

        $db->delete('survey_responses', ['id' => '192853595']);
        $db->delete('survey_responses', ['id' => '192894043']);
        $db->delete('survey_responses', ['id' => '192933944']);
        $db->delete('survey_responses', ['id' => '192944568']);
        $db->delete('survey_responses', ['id' => '193316907']);
        $db->delete('survey_responses', ['id' => '194082982']);
        $db->delete('survey_responses', ['id' => '194085328']);
        $db->delete('survey_responses', ['id' => '194240592']);
        $db->delete('survey_responses', ['id' => '194527340']);
        $db->delete('survey_responses', ['id' => '194561689']);

        $db->delete('survey_responses', ['id' => '212099038']);
        $db->delete('survey_responses', ['id' => '212099731']);
        $db->delete('survey_responses', ['id' => '212100053']);
        $db->delete('survey_responses', ['id' => '212101324']);
        $db->delete('survey_responses', ['id' => '212103734']);
        $db->delete('survey_responses', ['id' => '212105240']);
        $db->delete('survey_responses', ['id' => '212105413']);
        $db->delete('survey_responses', ['id' => '212106354']);
        $db->delete('survey_responses', ['id' => '212109170']);
        $db->delete('survey_responses', ['id' => '212112801']);

        $db->delete('survey_responses', ['id' => '212115017']);
        $db->delete('survey_responses', ['id' => '212119884']);
        $db->delete('survey_responses', ['id' => '212131453']);
        $db->delete('survey_responses', ['id' => '212135884']);
        $db->delete('survey_responses', ['id' => '212162171']);
        $db->delete('survey_responses', ['id' => '212179813']);
        $db->delete('survey_responses', ['id' => '212267765']);
        $db->delete('survey_responses', ['id' => '212289155']);
        $db->delete('survey_responses', ['id' => '213722078']);
        $db->delete('survey_responses', ['id' => '213814245']);

        $db->delete('survey_responses', ['id' => '213815164']);
        $db->delete('survey_responses', ['id' => '213900250']);
        $db->delete('survey_responses', ['id' => '214324245']);
        $db->delete('survey_responses', ['id' => '235245424']);
        $db->delete('survey_responses', ['id' => '235245577']);
        $db->delete('survey_responses', ['id' => '235246219']);
        $db->delete('survey_responses', ['id' => '235252136']);
        $db->delete('survey_responses', ['id' => '235252529']);
        $db->delete('survey_responses', ['id' => '235256147']);
        $db->delete('survey_responses', ['id' => '235260351']);

        $db->delete('survey_responses', ['id' => '235263876']);
        $db->delete('survey_responses', ['id' => '235269519']);
        $db->delete('survey_responses', ['id' => '235351886']);
        $db->delete('survey_responses', ['id' => '236728095']);
        $db->delete('survey_responses', ['id' => '236739157']);
        $db->delete('survey_responses', ['id' => '237434734']);
        $db->delete('survey_responses', ['id' => '241897541']);

    }

}
?>