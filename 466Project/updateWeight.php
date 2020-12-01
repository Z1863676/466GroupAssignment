<?php
session_start();
require('dbconn.php');
?>

<html>

<head><title>466 Group Project</title></head>
<body>
Update Your Weight here!

<form action="query.php" method="POST">
	<p>Current Weight: <input type="textbox" name="newWeight"\> (IBS)</p>
	<p>Date Recorded: <input type="textbox" name="date" value="0000/00/00"\> (YEAR/MONTH/DAY)</p>
	<p>Time Recorded: <input type="textbox" name="time" value="00:00:00"> (MILITARY TIME)</p>
	<input type="submit" name="updateWeight"\>
</form>
</body>

</html>
