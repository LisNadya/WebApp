<?php
include 'sidebar.php';
$success="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST["action"]=="Submit"){
        $carPlateNo = $_POST['carPlateNo'];
        $carRoadTaxExpDate = $_POST['carRoadTaxExpDate'];
        $carBrand = $_POST['carBrand'];
        $carModel = $_POST['carModel'];
        $carColor = $_POST['carColor'];
        $carYearBought = $_POST['carYearBought'];
        $carType = $_POST['carType'];
        $carNoSeats = $_POST['carNoSeats'];
        $targetFile = "img/";
        $carPicFile = $targetFile.$_FILES['carPicFile']["name"];
        $carPrice = $_POST['carPrice'];
        $valid = True;

        if(!ctype_alpha($carBrand)){
            $valid = False;
            $errBrand = "Brand can only contain alphabetical letters";
        }
        if(!ctype_alpha($carModel)){
            $valid = False;
            $errBrand = "Model can only contain alphabetical letters";
        }
        if(!is_numeric($carYearBought)||strlen($carYearBought)!=4){
            $valid = False;
            $errYear = "Invalid year";
        }

        if(!is_numeric($carPrice)){
            $valid = False;
            $errPrice = "Invalid car price";
        }

        if($valid){
            move_uploaded_file($_FILES['carPicFile']['tmp_name'], $carPicFile);

            
            $conn = $DB->connect();
            $sql = "insert into car (carPlateNo, carRoadTaxExpDate, carBrand, carModel, carColor, carYearBought, carType, carNoSeats, carPicFile, carPrice, booked) values
            ('$carPlateNo','$carRoadTaxExpDate','$carBrand', '$carModel', '$carColor', '$carYearBought', '$carType', $carNoSeats, '$carPicFile', $carPrice, 0)";
            $conn->query($sql);
            $conn->close();

            $success = "Details of your car has been submitted";
        }
    }
}
?>


<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/vendorAddCar.css" />
    <script src="js/vendorAddCar.js"></script>
</head>
<body>
    <main>
        <form action="vendor-addCar.php" method="post" enctype="multipart/form-data" id="mainForm">
            <?php if(!empty($success)){echo "<div class='msg'>$success</div>";}?>
            <label>Plate Number
                <input type="text" name="carPlateNo" placeholder="Car Plate Number" class="required">
            </label>
            
            <label>Road Tax Expiry Date
                <input type="date" name="carRoadTaxExpDate"  class="required" placeholder="Expiry Date of Road Tax" value=<?php echo "'".date("Y-m-d")."'"?>>
            </label>

            <label>Brand Name
                <input type="text" name="carBrand" placeholder="Car Brand" class="required">
            </label>
            <?php if(!empty($errBrand)){echo "<div class='err'>$errBrand</div>";}?>

            <label>Model Name
                <input type="text" name="carModel" placeholder="Car Model" class="required">
            </label>
            <?php if(!empty($errModel)){echo "<div class='err'>$errModel</div>";}?>

            <label>Color of Car
                <select name="carColor" class="required">
                    <option value="Red">Red</option>
                    <option value="Blue">Blue</option>
                    <option value="Green">Green</option>
                    <option value="Black">Black</option>
                    <option value="Purple">Purple</option>
                    <option value="Yellow">Yellow</option>
                    <option value="White">White</option>
                    <option value="Orange">Orange</option>
                </select>
            </label>
            <label>Year Bought
                <input type="text" name="carYearBought" minlength="4" maxlength="4" placeholder="Year Bought" class="required">
            </label>
            <?php if(!empty($errYear)){echo "<div class='err'>$errYear</div>";}?>

            <label>Type of Car
                <select name="carType" class="required">
                    <option value="auto">Auto</option>
                    <option value="manual">Manual</option>
                </select>
            </label>

            <label>Number of Seats
                <select name="carNoSeats" class="required">
                    <option value="4">4 Seats</option>
                    <option value="5">5 Seats</option>
                    <option value="6">6 Seats</option>
                    <option value="7">7 Seats</option>
                    <option value="8">8 Seats</option>
                    <option value="9">9 Seats</option>
                    <option value="10">10 Seats</option>
                </select>
            </label>

            <label>Rental Price Per Day (RM)
                <input type="text" placeholder="Car Price" name="carPrice" class="required">
            </label>
            <?php if(!empty($errPrice)){echo "<div class='err'>$errPrice</div>";}?>

            <label>Picture of Car
                <input type="file" name="carPicFile" class="required">
            </label>

            <input type="reset" name="action" value="Reset">
            <input type="submit" onclick="submitCheck()" name="action" value="Submit">
        </form>
    </main>

</body>
</html>