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
    <script>
        function makeRed(inputDiv){
            inputDiv.style.backgroundColor="rgb(255, 145, 128)";
        }

        function makeClean(inputDiv){
            inputDiv.style.backgroundColor="white";
        }

        function isBlank(inputDiv){
            if(inputDiv.type=="select"){
                if(inputDiv.checked){
                    return false;
                }
                return true;
            }
            if(inputDiv.value == ""){
                return true;
            }
            return false;
        }

        function submitCheck(){
            var mainform = document.getElementById("mainForm");
            
            mainform.onsubmit = function(e){
                var requiredInputs = document.querySelectorAll(".required");

                for(var i=0; i<requiredInputs.length;i++){
                    if(isBlank(requiredInputs[i])){
                        e.preventDefault();
                        makeRed(requiredInputs[i]);
                    }
                    else{
                        makeClean(requiredInputs[i]);
                    }
                }
            }
        }
    </script>
    <style>
        form{
            position:absolute;
            margin-top:5em;
            margin-left:17rem;
            width:65%;
            padding:3rem;
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
        label, input, select{
            display:block
        }

        .msg{
            padding:0.5em;
            background:#fff;
            border-radius:20px;
            border:0.1em solid grey;
            margin-bottom:0.5em;
            text-align:center;
            color:grey;
        }

        .err{
            background:pink;
            border:0.5px solid red;
            color:red;
            margin-bottom:1em;
            padding:0.5em 0;
            text-align:center;
            border-radius:0;
            width:100%;
        }
    </style>
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