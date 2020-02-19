<?php
include "sidebar.php";

$conn = $DB->connect();
$sql = "select * from car where booked = 0";
$getCar = $conn->query($sql) or die("Error in $sql");;
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head lang="en">
   <!--    Custom styles   -->
   <link rel="stylesheet" href="css/availableCars.css" />
</head>
<body>
    <main id="body">
        <section id="salesBox">
            <?php

                while($row = $getCar->fetch_assoc()){
                    $carID = $row['carID'];
                    $carBrand = $row['carBrand'];
                    $carModel = $row['carModel'];
                    $carColor = $row['carColor'];
                    $carYearBought = $row['carYearBought'];
                    $carType = $row['carType'];
                    $carNoSeats = $row['carNoSeats'];
                    $carPicFile = $row['carPicFile'];
                    $carPrice = $row['carPrice'];
                    echo 
                    "<div class='sales'>
                        <figure>
                            <img src='{$carPicFile}'>
                            <figcaption>
                                <h2>{$carBrand} {$carModel}</h2>
                                <ul>
                                    <li>{$carNoSeats} Seater</li>
                                    <li>{$carType}</li>
                                    <li>{$carYearBought}</li>
                                    <li>{$carColor} Color</li>
                                </ul>
                            </figcaption>
                        </figure>
                        <p>
                            from<br/>
                            <b>RM {$carPrice}/day</b>
                            <a href='bookdetails.php?carID={$carID}'>Book Now</a>
                        </p>
                    </div>";
                }
            ?>
        </section>
    </main>
    
</body>
</html>
