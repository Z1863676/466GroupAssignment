<html>

<head><title>466 Group Project</title></head>
<link rel="stylesheet" href="styles.css">

<body>

<div class="top">
	<h1 class="title">Fitness Tracker</h1>

	<p>Edit Data Base</p>
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
</table>

<p>Here will go the "dashboard" which will contain a "graph" of how many calories were<br>
   burnt. A "graph" of the weight of the user. When I say graph I really mean table <br>
   because that is too much work -Luke
</p>

</body>

</html>
