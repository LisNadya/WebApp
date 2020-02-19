<?php
include 'sidebar.php';

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

        
        move_uploaded_file($_FILES['carPicFile']['tmp_name'], $carPicFile);

        
        $conn = $DB->connect();
        $sql = "insert into car (carPlateNo, carRoadTaxExpDate, carBrand, carModel, carColor, carYearBought, carType, carNoSeats, carPicFile, carPrice, booked) values
        ('$carPlateNo','$carRoadTaxExpDate','$carBrand', '$carModel', '$carColor', '$carYearBought', '$carType', $carNoSeats, '$carPicFile', $carPrice, 0)";
        $conn->query($sql);
        $conn->close();

        $success = "Details of your car has been submitted";
    }
}
?>


<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <style>
        form{
            position:absolute;
            margin-top:5em;
            margin-left:17rem;
            width:70%;
            padding:1rem;
            background:white;
            border-radius:20px;
            border-bottom:5px solid #060517;
        }

        .col2{
            width:48%;
            display:inline-block;
        }
        .last{
            margin-left:2em;
        }

        input, select{
            padding:0.5em 0;
            margin-top:0.5em;
            margin-bottom:1em;
            background:transparent;
            border:none;
            border-bottom:1px solid #060517;
            width:100%;
        }

        input::placeholder{
            color:black;
        }

        input:focus, select:focus{
            outline:none;
        }

        input[type="submit"], input[type="reset"]{
            border:none;
        }

        input[type="submit"], input[type="reset"]{
            width:49.5%;
            display:inline-block;
            background:#e94b2e;
            color:black;
            transition:0.5s;
            border-radius:20px;
        }

        input[type="submit"]:hover, input[type="reset"]:hover{
            letter-spacing:5px;
            color:white;
            background:#060517;
            cursor:pointer;
        }

        select{
            width:101%;
        }
        label, input, select{
            display:block
        }
    </style>
</head>
<body>
    <main>
        <form action="vendor-addCar.php" method="post" enctype="multipart/form-data">
            <label class="col2">Plate Number
                <input type="text" name="carPlateNo" placeholder="Car Plate Number">
            </label>
            <label class="col2 last">Road Tax Expiry Date
                <input type="date" name="carRoadTaxExpDate" placeholder="Expiry Date of Road Tax" value=<?php echo "'".date("Y-m-d")."'"?>>
            </label>
            <label class="col2">Brand Name
                <input type="text" name="carBrand" placeholder="Car Brand">
            </label>
            <label class="col2 last">Model Name
                <input type="text" name="carModel" placeholder="Car Model">
            </label>
            <label class="col2">Color of Car
                <select name="carColor">
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
            <label class="col2 last">Year Bought
                <input type="text" name="carYearBought" minlength="4" maxlength="4" placeholder="Year Bought">
            </label>
            <label class="col2">Type of Car
                <select name="carType">
                    <option value="auto">Auto</option>
                    <option value="manual">Manual</option>
                </select>
            </label>
            <label class="col2 last">Number of Seats
                <select name="carNoSeats">
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
                <input type="text" placeholder="Car Price" name="carPrice">
            </label>
            <label>Picture of Car
                <input type="file" name="carPicFile">
            </label>

            <input type="reset" name="action" value="Reset">
            <input type="submit" name="action" value="Submit">
        </form>
    </main>

</body>
</html>