<?php
session_start();
require('dbconn.php');
?>


<html>

<head><title>466 Group Project</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<body style="background-color: #ffffff;">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Fitness Tracker</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="enterWorkout.php">Workouts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="updateWeight.php">Weight</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="enterFood.php">Food</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="trackMicro.php">Nutrition</a>
      </li>
    </ul>
  </div>
</nav>

<div class="top container">

	<?php
	echo '<p class="text-center font-weight-bold" style="padding: 50px; font-size: 40px;">Welcome back ' . $_SESSION['username'] . '!</p>';
	?>
</div>
<div class="container text-center">
	<button type="button" class="btn btn-primary" href="trackFoodConsumption.php"><a href="trackFoodConsumption.php" style="color: white">Track Food Consumption</a></button>
	<button type="button" class="btn btn-primary" href="enterWorkout.php"><a href="enterWorkout.php" style="color: white">Enter Workout</a></button>
	<button type="button" class="btn btn-primary" href="trackWorkout.php"><a href="trackWorkout.php" style="color: white">Track Workouts</button>
</div>
</br></br>
<div class="container">
	<div class="card-deck">
		<div class="card bg-dark">
			<div class="card-header">
			    <ul class="nav nav-pills card-header-pills">
			      <li class="nav-item">
			        <a class="nav-link active" href="#">My Weights</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Update Weight</a>
			      </li>
			    </ul>
			  </div>
			<?php
				$sql = 'SELECT * FROM UserWeight WHERE id=' . $_SESSION['userid'] . ';';
				$stmt = $conn->prepare( $sql );

				$stmt->execute();

				$res = $stmt->fetchAll( PDO::FETCH_ASSOC );

				echo '<table class="table-dark table-bordered table-hover">';
				echo '<thead><th scope="col">Weight</th><th scope="col">Date</th></thead>';
				echo '<tbody>';
				foreach( $res as $row ) {
					echo '<tr>';
					echo '<td>';
					echo $row['currentWeight'];
					echo '</td>';
					echo '<td>';
					echo $row['weightDate'];
					echo '</td>';
					echo '</tr>';
				}
				echo '</tbody>';
				echo '</table>';
			?>
		</div>
		<div class="card text-center bg-dark">
		  <div class="card-header">
		    <ul class="nav nav-pills card-header-pills">
		      <li class="nav-item">
		        <a class="nav-link active" href="#">MyFood</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="enterFood.php">Add Food</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="searchFood.php">Search Food</a>
		      </li>
		    </ul>
		  </div>
		  <?php
				$sql = 'SELECT * FROM MealContains WHERE mealId IN (SELECT mealId FROM Meal WHERE id=' . $_SESSION['userid'] . ');';
				$stmt = $conn->prepare( $sql );

				$stmt->execute();

				$res = $stmt->fetchAll( PDO::FETCH_ASSOC );

				echo '<table class="table-dark table-bordered table-hover">';
				echo '<thead><th scope="col">FoodName</th><th scope="col">Amount Eaten</th></thead>';
				echo '<tbody>';
				foreach( $res as $row ) {
					echo '<tr>';
					echo '<td>';
					echo $row['foodname'];
					echo '</td>';
					echo '<td>';
					echo $row['amount'];
					echo $row['measuredIn'];
					echo '</td>';
					echo '</tr>';
				}
				echo '</tbody>';
				echo '</table>';
			?>
		</div>
	</div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">

window.onload = function () {

	<?php
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


	var weights = ['2020/10/17', '2020/11/09', '2020/11/28'];
	var weightDates = [180, 175, 195];
	var graphData = [10];
	var a = 0;

	weights.foreach(getItems);

	var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "Weight Summary"              
		},
		data: [              
		{
			type: "line",
			dataPoints: graphData
		}
		]
	});
	chart.render();
}

function getItems(item, index) {
	grapData[ a ] = { x: weightDates[ a ], y: item };
	a++;
}
</script>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>

</body>

</html>
