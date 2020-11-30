<html>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  width: 500px;
}
</style>
</html>

<?php
session_start();
require('dbconn.php');


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
    $sql2 = 'SELECT * FROM Micronutrients WHERE foodname=\'' . $foodName . '\';';
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
}
else if(isset($_POST['entMacro'])) {

}else if(isset($_POST['enterMeal'])){

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
}
?>
