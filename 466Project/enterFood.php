<?php
require('dbconn.php');
session_start();
?>

<html>
    <head>
        <title>Enter Food</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
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

        <div class="container">
            <form action="query.php" method="POST">
                <p>FoodName: <input type="text" name="foodName"\></p>
                <p>Grams Per Serving: <input type="text" name="gramsPerServing"\></p>
                <p>Calories: <input type="text" name="calories"\></p>
                <p>Date: <input type="text" name="date" value="YYYY-MM-DD"\></p>
                <p>Time: <input type="text" name="time" value="00:00:00"\></p>
                <input type="submit" class="btn btn-primary" name="addFood">
            </form>
        </div>
    </body>
</html>
