<?php
session_start();
require('dbconn.php');

$weights;
$weightDates;

$sql = 'SELECT * FROM UserWeight WHERE id=\'' . $_SESSION['userid'] . '\';';
$stmt = $conn->prepare( $sql );
$stmt->execute();
$res = $stmt->fetchAll( PDO::FETCH_ASSOC );

foreach($res as $row) {
	$weights = array($row['currentWeight']);
	$weightDates = array($row['weightDate']);
}
?>


<html>

<head><title>466 Group Project</title></head>
<link rel="stylesheet" href="styles.css">

<body>

<div class="top">
	<h1 class="title">Fitness Tracker</h1>

	<?php
	echo '<p>Welcome back ' . $_SESSION['username'] . '!</p>';
	?>
</div>
<table>
	<tr>
		<td><?php include("env.php"); echo "<a href=\"".$mainDir."trackMicro.php\">";?>Track Micronutrients</a></td>
		<td><?php include("env.php"); echo "<a href=\"".$mainDir."searchFood.php\">";?>Search Food</a></td>
		<td><?php include("env.php"); echo "<a href=\"".$mainDir."searchWorkout.php\">";?>Search Workouts</a></td>
		<td><?php include("env.php"); echo "<a href=\"".$mainDir."updateWeight.php\">";?>Update Weight</td>
		<td><?php include("env.php"); echo "<a href=\"".$mainDir."trackFoodConsumption.php\">";?>Track Food Consumption</td>
		<td><?php include("env.php"); echo "<a href=\"".$mainDir."enterWorkout.php\">";?>Enter Workout</td>
		<td><?php include("env.php"); echo "<a href=\"".$mainDir."trackWorkout.php\">";?>Track Workouts</td>
	
	</tr>
</table></br></br>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">

window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "Weight Summary"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "line",
			dataPoints: [
				{ label: <?php echo '["' . implode('", "', $weightDates) . '"]' ?>,  y: <?php echo implode($weights)?>  }
			]
		}
		]
	});
	chart.render();
}
</script>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>

</body>

</html>
