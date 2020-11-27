<?php
session_start();
require('dbconn.php');
?>

<html>

<head><title>466 Group Project</title></head>
<body>
    <p>Select a food name from the list below to see all the micronutrients!</p>
    <form action="query.php" method="POST">
        <select name="foodName">
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
        <input type="submit" name="searchFood">
    </form>
</body>

</html>
