
<?php
include "sidebar.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/vendoraddcar.css" />
    <style>
        /* form{
            margin-left:200px;
        } */
    </style>
</head>

<body>

    <title>Add Car</title>


    <form action="/action_page.php">
        <label for="fname">First name:</label>
        <input type="text" id="fname" name="fname"><br><br>
        <label for="lname">Last name:</label>
        <input type="text" id="lname" name="lname"><br><br>
        <input type="submit" value="Submit">
    </form>

    <p>Click the "Submit" button and the form-data will be sent to a page on the
        server called "action_page.php".</p>

</body>

</html>