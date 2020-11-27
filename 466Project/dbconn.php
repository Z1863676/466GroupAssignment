<?PHP
/*
 * PERSON1: Ehren Grenlund
 * PERSON2:
 * PERSON3:
 * CSCI466 - 003
 * Group Assignment 
 */
//Credential variables to login to the SQL server
$host = 'students';								                        //Hostname
$user = 'z1863676';								                        //Username
$password = '1999Aug03';						                        //Password

$db = 'z1863676';								                        //Database name we are connecting to
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

try {
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		//Try to establish a connection to the server
}
catch (PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();					                //If it fails, let the user know
}

?>