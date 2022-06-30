<?php

require '../vendor/autoload.php';
require '../app/Entities/Person.php';
require '../app/Requests/PersonRequest.php';
require '../app/Requests/SurveyRequest.php';
require '../app/Requests/MetricsRequest.php';
require '../app/Requests/AutopilotConfig.php';
require '../app/Repositories/SurveyRepository.php';

$people = Welldex\Requests\PersonRequest::getAll();
$unsubscribedPersons = Welldex\Requests\PersonRequest::getUnsubscribedPeople();
$bouncedPeople = Welldex\Requests\PersonRequest::getBouncedPeople();
$surveis = Welldex\Requests\SurveyRequest::getAll();
$metrics = \Welldex\Requests\MetricsRequest::getMetrics();
$autoPilotConfig = \Welldex\Requests\AutopilotConfig::getAutopilotConfig();

if (isset($_GET['insertSurveyResponses'])) {
    \Welldex\Repositories\SurveyRepository::deleteAllSurveyResponses();
    \Welldex\Repositories\SurveyRepository::insertSurveyResponses();
}

$surveyFromDB = \Welldex\Repositories\SurveyRepository::getAllSurveyResponses();
//$npsOverTimeData = \Welldex\Repositories\NpsOverTimeRequest::getChartInformation();

include "../resources/views/operaciones.php";