
<html>

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  width: 500px;
}
</style>
<head><title>466 Group Project</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script></head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">Fitness Tracker</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
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
    </br></br>
</body>
</html>

<?php
session_start();
require('dbconn.php');
//require('drawTable.php');


if( isset($_POST['entWorkout'])) {
    //Initialize all of our session variables
    $woType =   $_POST['woType'];                                       //Get the workout type from the form
    $woDur =    $_POST['woDuration'];                                   //Get the workout duration from the form
    $woInt =    $_POST['woIntensity'];                                  //Get the workout intensity from the form
    $woDate =   $_POST['woDate'];                                       //Get the workout date from the form
    $woTime =   $_POST['woTime'];                                       //Get the workout time from the form

    $sql = 'INSERT INTO Workout VALUES (' . $_SESSION['userid'] . ', \'' . $woType . '\', \'' . $woDur . '\', \'' . $woInt . '\', \'' . $woDate . '\', \'' . $woTime . '\');';

    $stmt = $conn->prepare( $sql );
    $stmt->execute();

    header("Location: success.php");
}
else if(isset($_POST['updateWeight'])) {
    //Initialize all of our variables
    $newWeight =    $_POST['newWeight'];
    $dateOfWeight = $_POST['date'];
    $timeOfWeight = $_POST['time'];

    //We need to select the id first and check for a NULL value so we can see they have entered a weight before as updating a table with
    //no entry WILL throw an error
    $sql = 'SELECT id FROM UserWeight WHERE id=\'' . $_SESSION['userid'] . '\';';
    $stmt = $conn->prepare( $sql );
    $stmt->execute();

    $res = $stmt->fetchAll( PDO::FETCH_ASSOC );

    $sql1 = 'INSERT INTO UserWeight VALUES (' . $_SESSION['userid'] . ', ' . $newWeight . ', \'' . $dateOfWeight . '\', \'' . $timeOfWeight . '\');';
    $stmt1 = $conn->prepare( $sql1 );
    $stmt1->execute();

    header("Location: success.php");
}
else if(isset($_POST['searchFood'])) {
    $foodName = $_POST['foodName'];
    $sql = 'SELECT * FROM FoodBeverage WHERE foodname=\'' . $foodName . '\';';
    $sql2 = 'SELECT * FROM Micronutrients WHERE nutrientName IN (SELECT nutrientName FROM FoodContains WHERE foodname=\'' . $foodName . '\');';
    $stmt = $conn->prepare( $sql );
    $stmt2 = $conn->prepare( $sql2 );
    $stmt2->execute();
    $stmt->execute();

    $res = $stmt->fetchAll( PDO::FETCH_ASSOC );
    $res2 = $stmt2->fetchAll( PDO::FETCH_ASSOC );

    echo '<table>';
    echo '<thead>';
    echo '<th>Food Name</th><th>Grams Per Serving</th><th>Calories</th>';
    echo '</thead>';
    foreach( $res as $row ) {
        echo '<tr>';
        echo '<td>';
        echo $row['foodname'];
        echo '</td>';
        echo '<td>';
        echo $row['gramsPerServ'];
        echo '</td>';
        echo '<td>';
        echo $row['calories'];
        echo '</td>';
        echo '</tr>';
    }
    echo '</table></br>';

    echo '<table>';
    echo '<thead><th>Nutrient Name</th><th>Recommended Dose</th></thead>';
        foreach($res2 as $row2 ) {
            echo '<tr>';
            echo '<td>';
            echo $row2['nutrientName'];
            echo '</td>';
            echo '<td>';
            echo $row2['reccomendedDose'];
            echo '</td>';
            echo '</tr>';
        }
    echo '</table>';
} else if(isset($_POST['enterMeal'])){

	$sql = "INSERT INTO Meal (mealDate, mealTime, id) VALUES ('".$_POST["date"]."', '".$_POST["time"]."', '".$_SESSION["userid"]."');"; 
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$sql = "SELECT MAX(mealId) FROM Meal;";
	$res = $conn->query($sql);
	
	$row = $res->fetch();	
	$mealId = $row[0];

	for($i = 1; $i <= 2; ++$i){
		if($_POST["food2"] == "None" && $i==2){
			header("success.php");
			break;
		}
		$sql = "INSERT INTO MealContains VALUES ('".$mealId."', '".$_POST["food".$i]."', ?, '".$_POST["food".$i."type"]."');";
		$prepare = $conn->prepare($sql);
		$prepare->execute(array($_POST["food".$i."measure"]));
	}
	header("success.php");
}else if(isset($_POST['foodConsumption'])){

	$sql = "SELECT DISTINCT foodname, amount, measuredIn FROM MealContains WHERE mealId IN (SELECT mealId FROM Meal WHERE id = ".$_SESSION["userid"]." AND mealDate >= ? AND mealDate <= ?);";
	
	$prepare = $conn->prepare($sql);
	$res = $prepare->execute(array($_POST["startDate"], $_POST["endDate"]));
	
	while(( $row = $prepare->fetch( PDO::FETCH_ASSOC ))){
		if(!isset($table[$row["foodname"]])){
			$table[$row["foodname"]] = 0;
		}
			
		if($_POST["units"] == $row["measuredIn"]){
			$table[$row["foodname"]] += $row["amount"];
		}else{
			if($row["measuredIn"] == "lbs" && $_POST["units"] == "oz"){

				$table[$row["foodname"]] += $row["amount"] * 16;
			
			}else{
				$table[$row["foodname"]] += $row["amount"] / 16;
			}
		}
	
	}

	echo "<table>";
	echo "<tr><th>Food Name</th><th>".$_POST["units"]."</th></tr>";
	foreach($table as $item => $key){
		echo "<tr><td>".$item."</td><td>".$key."</td></tr>";
	}
	echo "</table>";
	echo "<p><form action=\"home.php\" method=\"POST\"><input type=\"submit\" name=\"fromQuery\" value=\"RETURN TO HOME\"></form></p>";



		
} else if(isset($_POST["trackMicro"])){
	$sql = "SELECT DISTINCT foodname, amount, measuredIn FROM MealContains WHERE mealId IN (SELECT mealId FROM Meal WHERE id = ".$_SESSION["userid"].");";

	$res = $conn->query($sql);

	while(( $row = $res->fetch( PDO::FETCH_ASSOC ))){
		if(!isset($food[$row["foodname"]])){
			$food[$row["foodname"]] = 0;
		}
		if($row["measuredIn"] == "ibs")	
			$row["amount"] *= 16;

		$food[$row["foodname"]] += $row["amount"];

	}

	$sql = "SELECT * FROM FoodContains WHERE foodname = ?;";

	$prepare = $conn->prepare($sql);

	foreach($food as $foodname => $amount){

		$prepare->execute(array($foodname));

		while(($row = $prepare->fetch( PDO::FETCH_ASSOC ))){
			if(!isset($micros[$row["nutrientName"]]))
				$micros[$row["nutrientName"]] = 0;

			$micros[$row["nutrientName"]] += $amount * $row["amount"];


		}

	}
	echo "<table>";
	echo "<tr><th>Micronutrient Name</th><th>Amount</th></tr>";
	foreach($micros as $item => $key){
		echo "<tr><td>".$item."</td><td>".$key."</td></tr>";
	}
	echo "</table>";
    echo "<p><form action=\"home.php\" method=\"POST\"><input type=\"submit\" name=\"fromQuery\" value=\"RETURN TO HOME\"></form></p>";
} else if(isset($_POST["addFood"])) {
    $food = $_POST['foodName'];
    $gps = $_POST['gramsPerServing'];
    $calories = $_POST['calories'];

    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = 'INSERT INTO FoodBeverage VALUES (\'' . $food . '\', \'' . $gps . '\', \'' . $calories . '\');';
    $sql2 = 'INSERT INTO Meal (mealDate, mealTime, id) VALUES (\'' . $date . '\', \'' . $time . '\', ' . $_SESSION['userid'] . ');';
    //Get the current meal number
    $sqlMealNum = 'SELECT mealId FROM Meal WHERE mealDate=\'' . $date . '\' AND mealTime=\'' . $time . '\';';

    $ex = $conn->prepare( $sqlMealNum );
    $ex->execute();
    $res = $ex->fetchAll( PDO::FETCH_ASSOC );

    //Insert into the table
    if($res[0] == NULL) {
        echo 'INSERT INTO MealContains (mealId, foodname, amount) VALUES (0, \'' . $food . '\', ' . $gps . ');';
    }
    else {
        echo 'INSERT INTO MealContains (mealId, foodname, amount) VALUES (' . $res[0]['mealId'] + 1 . ', \'' . $food . '\', ' . $gps . ');';
    }

    //$stmt1 = $conn->prepare( $sql );
    //$stmt1->execute();
    //$stmt2 = $conn->prepare( $sql2 );
    //$stmt2->execute();
    //$stmt3 = $conn->prepare( $sql3 );
    //$stmt3->execute();

    //header("Location: success.php");

} else if(isset($_POST['tWorkout'])){

    $workoutDate = $_POST['workoutDate'];

	$sql = 'SELECT * FROM Workout WHERE id IN (SELECT id FROM User WHERE id = '.$_SESSION["userid"].' AND workoutDate=\'' . $workoutDate . '\');';
	
	$prepare = $conn->prepare($sql);
    $prepare->execute();
    
    $res = $prepare->fetchAll( PDO::FETCH_ASSOC );

    echo "<table>";
    echo "<thead>";
	echo "<th>ID</th><th>Workout</th><th>Duration</th><th>Intensity</th><th>Time</th>";
    echo "</thead>";
    foreach( $res as $row ){
		echo "<tr>";
		echo '<td>';
        echo $row['id'];
        echo '</td>';
        echo '<td>';
        echo $row['workoutType'];
        echo '</td>';
        echo '<td>';
        echo $row['workoutDur'];
        echo '</td>';
        echo '<td>';
        echo $row['workoutIntensity'];
        echo '</td>';
        echo '<td>';
        echo $row['workoutTime'];
        echo '</td>';
		echo "</tr>";
	}
	echo "</table>";
}
?>
