<?php

session_start();

?>

<html>

<head><title>466 Group Project</title></head>
<body>

<form action="query.php" method="POST">
	<p>Start Date: <input type="textbox" name="startDate" value="0000/00/00"/> (YEAR/MM/DD)</p>
	<p>End Date: <input type="textbox" name="endDate" value="0000/00/00"/> (YEAR/MM/DD)</p>
	<p>Units: <select name="units">
		<option>oz</option>
		<option>ibs</option>
	</select></p>
	<input type="submit" name="foodConsumption" value="SUBMIT"/>
</form>

</body>

</html>
