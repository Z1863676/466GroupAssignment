<?php
session_start();                                        //Must start the session at the top of the page so we can use session variables
?>

<html>

<head><title>466 Group Project</title></head>
<body>
    <form action="query.php" method="POST">
        <p><input type="text" name="woType" value="WorkoutName">(Workout Type)</p>
        <p><input type="text" name="woDuration" value="00:00:00">(Workout Duration)</p>
        <select name="woIntensity">
            <option>Light</option>
            <option>Moderate</option>
            <option>Intense</option>
        </select>
        <p><input type="text" name="woDate" value="0000/00/00">(Workout Date)</p>
        <p><input type="text" name="woTime" value="00:00:00">(Workout Time)</p>
        <input type="submit" name="entWorkout">
    </form>
</body>

</html>
