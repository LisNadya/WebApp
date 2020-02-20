<?php
include "sidebar.php";



$conn = $DB->connect();
// $current = $_SESSION['adminID'];
$current = "srithesigan98";
$getUser = $conn->query("SELECT * FROM car");
// $conn->close();

$target_car_dir = "img/car/";

while($row = $getUser->fetch_assoc()){
  $carID      = $row['carID'];
  $carPlateNo = $row['carPlateNo'];
  $carRoadTacExpiryDate = $row['carRoadTaxExpiryDate'];
  $carBrand     = $row['carBrand'];
  $carModel     = $row['carModel'];
  $carColor     = $row['carColor'];
  $carYearBought = $row['carYearBought'];
  $carType      = $row['carType'];
  $carNoSeats   = $row['carNoSeats'];
  $carPrice     = $row['carPrice'];
  $carPicFile     = $row['carPicFile'];
  $vendorID       = $row['vendorID'];

  $carPicFile = $target_car_dir.$carPicFile;
}


?>
<!DOCTYPE html>
<html>
  <head lang="en">
  <style>
    .dropdown{
      margin : 1em;
      display: inline;
    } 
  </style>
    <meta charset="utf-8" />
    
   <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Car Type</title>
    <!--    Custom styles   -->
    <link rel="stylesheet" href="css/reset.css" />

    <link rel="stylesheet" href="css/default.css" />
    <link rel="stylesheet" href="css/sidebar.css" />
    <link rel="stylesheet" href="css/cartype.css" />
    <!--   Icons   -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    
    <hgroup>
      <h1>Manage Types of Vehicles</h1>
  </hgroup>
    <div id="body">
      <div id="box">
        <h1>Car List</h1>
        <p></p>
        <div class="navbar">
        

        <div class="custom-select" style="width:200px;">
          <select>
            <option value="0">Select Type:</option>
            <option value="1">Sedan</option>
            <option value="2">SUV</option>
            <option value="3">MPV</option>
            <option value="4">Pick Up</option>
          </select>
        </div>

        <div class="custom-select" style="width:200px;">
          <select>
            <option value="0">Select Year:</option>
            <option value="1">2014</option>
            <option value="2">2015</option>
            <option value="3">2016</option>
            <option value="4">2017</option>
            <option value="5">2018</option>
            <option value="6">2019</option>
            <option value="7">2020</option>
          </select>
        </div>

        <div class="custom-select" style="width:200px;">
          <select>
            <option value="0">Select Brand:</option>
            <option value="1">Audi</option>
            <option value="2">BMW</option>
            <option value="3">Proton</option>
            <option value="4">Perodua</option>
            <option value="5">Honda</option>
          </select>
        </div>

            <div class="custom-select">
              <button class="dropbtn">Filter</button>
            </div>

      </div>
        <br />
        <br />
        <!-- Table -->
        <table>
          <thead>
            <tr>
              <th scope="col">Car ID</th>
              <th scope="col">Plate No</th>
              <th scope="col">RoaTax ExpiryDate</th>
              <th scope="col">Brand</th>
              <th scope="col">Model</th>
              <th scope="col">Color</th>
              <th scope="col">Year Bought</th> 
              <th scope="col">Type</th> 
              <th scope="col">No of Seats</th> 
              <th scope="col">Price</th> 
              <th scope="col">Picture</th>  
              <th scope="col">Vendor</th>  
            </tr>
          </thead>

          <?php
          $result = $conn->query("SELECT * FROM car");
          while($row =$result -> fetch_assoc()){
          echo'
          <tbody>
            <tr>
              <td>'.$row["carID"].'</td>
              <td>'.$row["carPlateNo"].'</td>
              <td>'.$row["carRoadTaxExpiryDate"].'</td>
              <td>'.$row["carBrand"].'</td>
              <td>'.$row["carModel"].'</td>
              <td>'.$row["carColor"].'</td>
              <td>'.$row["carYearBought"].'</td>
              <td>'.$row["carType"].'</td>
              <td>'.$row["carNoSeats"].'</td>
              <td>'.$row["carPrice"].'</td>
              <td>'.$row["carPicFile"].'</td>
              <td>'.$row["vendorID"].'</td>
              
            </tr>
          </tbody>';
          }
          ?>
        </table>
      </div>
    </div>
    </div>
  </body>
</html>
