<?php
session_start();
require('dbconn.php');
?>

<html>

<head><title>466 Group Project</title></head>
<body>
	<p>Please select the date of a workout to search</p>
	<form action="query.php" method="POST">
		<select name="workoutType">
		<?php

		$sql = 'SELECT workoutDate FROM Workout;';
		$stmt = $conn->prepare( $sql );
		$stmt->execute();

		$result = $stmt->fetchAll( PDO::FETCH_ASSOC );
date:
		foreach( $result as $row ) {
			echo '<option>';
			echo $row['workoutDate'];
			echo '</option>';
		}
		?>
		</select>
		<input type="submit" name="searchWorkout" value="SUBMIT"/>
	</form>
</body>

</html>