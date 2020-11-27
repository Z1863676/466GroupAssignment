<?php

require('dbconn.php');

$username = $_POST['username'];                             //Get the username from the HTML form
$password = $_POST['password'];                             //Get the password from the HTML form

$getUser = 'SELECT id FROM User WHERE name=\'' . $username . '\' AND password=\''. $password . '\';';

$stmt = $conn->prepare( $getUser );                         //Prepare our statement

$stmt->execute();                                           //Execute the statement

$res = $stmt->fetchAll( PDO::FETCH_ASSOC );                 //Fetch all of the results from the statement

if($res == NULL)
    echo '<h1>Incorrect login credentials!</p>';            //If the login credentials are false, dont start the session, just let them know
else {
    session_start();                                        //Start the session so we can use session variables
    foreach( $res as $row )                                 //Foreach row in the result (should only be one)
        $_SESSION['userid'] = $row['id'];                   //Set the session userid to the id in the row
    
        $_SESSION['username'] = $_POST['username'];         //Set the session variable for the users username as well
    header("Location: home.php");                           //Redirect to the home.php if successfull
}

?>