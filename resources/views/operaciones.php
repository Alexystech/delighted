<?php 
$host        = 'localhost';
$user        = 'root';
$password    = '1408';
$database    = 'hh_transportes';

$conexion = new mysqli($host,$user,$password,$database);
if ($conexion -> connect_errno) 
{
	die("fallo la conexion");
}

$resp = $conexion->query("SELECT nps, promoters_count, promoters_percent, pasive_count, pasive_percent, detractors_count, detractors_percent, responses_count, date FROM nps_over_time order by date asc");

$A1 = '';

while ($fila = $resp->fetch_array(MYSQLI_BOTH)) 
{
	$A1 .= "[".$fila["date"].",".$fila["nps"]."],";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Listado</title>
	<!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 col-md-offset-1">
						<div class="panel panel-default">
							<div class="panel-body">
								<div id="npsOverTime"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>Survey Responses from MySQL DB</h1>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Person</th>
							<th>Survey Type</th>
							<th>Score</th>
							<th>Comment</th>
							<th>Permalink</th>
							<th>Created at</th>
							<th>Updated at</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($surveyFromDB as $survey) 
						{
							echo "<tr><th>$survey[id]</th><td>$survey[person]</td><td>$survey[survey_type]</td><td>$survey[score]</td><td>$survey[comment]</td><td><a href='$survey[permalink]'>$survey[permalink]</a></td><td>$survey[created_at]</td><td>$survey[updated_at]</td></tr>";
						}
						?>
					</tbody>
				</table>


				<button class='btn btn-info' onclick="insertSurveys()"><a href="http://localhost:3000/public/index.php?insertSurveyResponses=true">CARGAR SURVEY RESPONSES DE DELIGHTED</a></button>
			</div>
		</div>
	</div>
	<div class="container-xxl">
		<div class="row">
			<div class="col-md-5">
				<br>
				<h2 class="text-center">Aceptacion de los clientes sobre HH Transportes </h2>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="panel panel-default">
							<div class="panel-body">
								<div id="acceptationPieChart"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-7">
				<h1>Comentarios</h1>
					<?php
						foreach ( $surveis as $survey ) 
						{
							echo "<div class='card'>";
							echo "<div class='card-body'>";
							if ($survey->score >= 0 && $survey->score <= 6)
							{
								echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='red' class='bi bi-emoji-frown' viewBox='0 0 16 16'>
								<path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
								<path d='M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z'/>
							  	</svg>";
							} 
							if ($survey->score >= 7 && $survey->score <= 8)
							{
								echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='gray' class='bi bi-emoji-neutral' viewBox='0 0 16 16'>
								<path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
								<path d='M4 10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm3-4C7 5.672 6.552 5 6 5s-1 .672-1 1.5S5.448 8 6 8s1-.672 1-1.5zm4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5S9.448 8 10 8s1-.672 1-1.5z'/>
							  	</svg>";
							}
							if ($survey->score >= 9 && $survey->score <= 10) 
							{
								echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='green' class='bi bi-emoji-smile' viewBox='0 0 16 16'>
								<path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
								<path d='M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z'/>
							  	</svg>";
							}

							if (property_exists($survey, 'contacto')) 
							{
								echo " - <a href='{$survey->permalink}' class='card-title'>No regstró su nombre</a> <div class='card-text'>{$survey->comment}</div> <br>";
							} else 
							{
								echo " - <a href='{$survey->permalink}' class='card-title'>{$survey->person_properties->Contacto}</a> <div class='card-text'>{$survey->comment}</div> <br>";
							}
							echo "</div>";
							echo "</div>";
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>GetAll People</h1>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Fecha de creacion</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($people as $person) 
							{
								echo "<tr><th>{$person->id}</th><td>{$person->name}</td><td>{$person->email}</td><td>{$person->created_at}</td></tr>";
							}
						?>
					</tbody>
				</table>

				<h1>Create a person</h1>
				<form action="" method="post">
					<div class="form-group">
						<label for="">Nombre</label>
						<input type="text" class="form-control" />
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" class="form-control" />
					</div>
					<div class="form-group">
						<label for="">Delay</label>
						<input type="number" class="form-control" />
					</div>
					<button class="btn btn-primary">ENVIAR</button>
				</form>

				<h1>Get unsubscribed people</h1>
				<?php
					echo $unsubscribedPersons;
				?>

				<h1>Get Bounced people</h1>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($bouncedPeople as $bouncedPerson)
						{
							echo "<tr><th>{$bouncedPerson->person_id}</th><td>{$bouncedPerson->name}</td><td>{$bouncedPerson->email}</td></tr>";
						}
					?>
					</tbody>
				</table>

				<h1>Get metrics</h1>
				<?php
					echo "nps: {$metrics->nps} <br> 
						promoter_count: {$metrics->promoter_count} <br> 
						promoter_percent: {$metrics->promoter_percent} <br> 
						passive_count: {$metrics->passive_count} <br> 
						passive_percent: {$metrics->passive_percent} <br> 
						detractor_count: {$metrics->detractor_count} <br> 
						detractor_percent: {$metrics->detractor_percent} <br> 
						response_count: {$metrics->response_count}";
				?>

				<h1>Autopilot config</h1>
				<?php
					//echo $autoPilotConfig;
				?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var pieColors = (function () {
			var colors = [],
				base = Highcharts.getOptions().colors[0],
				i;
			
			for (i = 0; i < 10; i += 1) {
				colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
			}
			return colors;
		} ());

		$(function () {
			$('#npsOverTime').highcharts({
				chart: {
					zoomType: 'x'
				},
				title: {
					text: 'NPS Over Time'
				},
				subtitle: {
					text: document.ontouchstart === undefined ?
						'Haz clic y suelta el area en la que quieras zoom' : 'Haz tab en la grafica para hacer zoom'
				},
				xAxis: {
					type: 'datetime'
				},
				yAxis: {
					title: {
						text: 'NPS'
					}
				},
				legend: {
					enabled: false
				},
				plotOptions: {
					area: {
						fillColor: {
							linearGradient: {
								x1: 0,
								y1: 0,
								x2: 0,
								y2: 1
							},
							stops: [
								[0, Highcharts.getOptions().colors[0]],
								[1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
							]
						},
						marker: {
							radius: 3
						},
						lineWidth: 2,
						states: {
							hover: {
								lineWidth: 1
							}
						},
						threshold: null
					}
				},

				series: [{
					type: 'area',
					name: 'nps',
					data: [<?php
						echo $A1;
					?>]
				}]
			});
		})

		$(function () {
			$('#acceptationPieChart').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: 'Metrics'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				accessibility: {
					point: {
						valueSuffix: '%'
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						colors: pieColors,
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b><br>{point.percentage:.1f}%',
							distance: -50,
							filter: {
								property: 'percentage',
								operador: '>',
								value: 4
							}
						}
					}
				},
				series: [{
					name: 'Aceptacion',
					data: [
						{ name: 'Promoters', y: 2 },
            			{ name: 'Passive', y: 1 },
            			{ name: 'Detractor', y: 1 },
					]
				}]
			});
		})

		function insertSurveys() {
			console.log('funciona');
		}
	</script>
</body>
</html>