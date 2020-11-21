<html>

<head><title>466 Group Project</title></head>
<body>
<h1>Log In:</h1>
<?php include("env.php");echo "<form action=\"http://students.cs.niu.edu/~".$zid."/466Project/home.php\" action=\"GET\">";?>
<p><input type="textbox" name="USER" style="100px"/> (HINT: Use "Username" if you don't have a username!</p>
<p><input type="password" name="PASS" style="100px"/> (HINT: Use "Password" if you don't have a Password!</p>

<input type="submit" name="submit" value="LOG IN">
</form>


</body>

</html>
