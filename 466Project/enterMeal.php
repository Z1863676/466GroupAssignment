<?php
session_start();
require("dbconn.php");
?>

<html>
<head><title>466 Group Project</title></head>

<body>
<h2>Enter Food Here!</h2>
<form action="query.php" method="POST">
	<p>Date Recorded: <input type="textbox" name="date" value="0000/00/00"\> (YEAR/MONTH/DAY)</p>
	<p>Time Recorded: <input type="textbox" name="time" value="00:00:00"> (MILITARY TIME)</p>
	<p>
		First Food: <select name="food1">
		<?php
		$sql = 'SELECT foodname FROM FoodBeverage;';
        	$stmt = $conn->prepare( $sql );
        	$stmt->execute();
	
        	$res = $stmt->fetchAll( PDO::FETCH_ASSOC );

        	foreach( $res as $row ) {
        	    echo '<option>';
        	    echo $row['foodname'];
		    echo '</option>';
		}
		?>
		</select>
		Amount: <input type="textbox" name="food1measure" style="width: 30px"/>
		Measured in: <select name="food1type">
			<option>oz</option>
			<option>ibs</option>
		</select>
	</p>
	<p>
		First Food: <select name="food2">
		<option>None</option>
		<?php
		$sql = 'SELECT foodname FROM FoodBeverage;';
        	$stmt = $conn->prepare( $sql );
        	$stmt->execute();
	
        	$res = $stmt->fetchAll( PDO::FETCH_ASSOC );

        	foreach( $res as $row ) {
        	    echo '<option>';
        	    echo $row['foodname'];
		    echo '</option>';
		}
		?>
		</select>
		Amount: <input type="textbox" name="food2measure" style="width: 30px"/>
		Measured in: 
		<select name="food2type">
			<option>oz</option>
			<option>ibs</option>
		</select>
	</p>
	<input type="submit" name="enterMeal" value="SUBMIT"/>
</form>
</body>
</html>
