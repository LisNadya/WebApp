<?php
    include "db/conn.php";
    // include 'ChromePhp.php';
    include_once "object/promotionTable.php";
    // session_start(); 
    // ChromePhp::log('Hello console!');
    // ChromePhp::log($_SERVER);
    // ChromePhp::warn('something went wrong!');

    $promotion = new PromotionTable($DB);
    $getPromotion = $promotion->read();
    $uploadOk = 1;

    if(isset($_SESSION["alertClass"])) {
        $alertClass = $_SESSION["alertClass"];
        unset($_SESSION["alertClass"]);
    } else {
        $alertClass = "";
    }

    if(isset($_SESSION["alertText"])){
        $alertText = $_SESSION["alertText"];
        unset($_SESSION["alertText"]);
    }else {
        $alertText = "";
    }

    if(isset($_GET["StatusId"])){
        $promotion->changeStatus($_GET["StatusId"]);
        $_SESSION["alertClass"] = 'success';
        $_SESSION["alertText"] = 'Status Successfully Change!';
        header("Location: promotion.php");
    }

    if(isset($_GET['delId'])){
        $promotion->delete($_GET['delId']);
        $_SESSION["alertClass"] = 'success';
        $_SESSION["alertText"] = 'The event is successfully deleted!';
        header("Location: promotion.php");
    }

    // If the new event form submitted
    if(isset($_POST["createEvent"]))
    {
        $target_dir = "img/events/"; // The directory where the file is going to be placed
        // Specify the path of the file to be uploaded
        $target_file = $target_dir . basename($_FILES["myFile"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Holds the file extension of the file (in lowercase)

        // Check if file already exists
        // if(file_exists($target_file)){
        //     $alertClass = "failure";
        //     $alertText = "Sorry, File already exists. Please rename your filename to something unique.";
        //     $uploadOk = 0;
        // }

        // CHeck file size, max file size = 500KB
        if($_FILES["myFile"]["size"] > 500000) {
            $_SESSION["alertClass"] = 'failure';
            $_SESSION["alertText"] = 'Sorry, your file is too large.';
            $uploadOk = 0;
        }

        // Allow certain file formats only
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
            $_SESSION["alertClass"] = 'failure';
            $_SESSION["alertText"] = 'Sorry, only JPG, JPEG and PNG files are allowed.';
            $uploadOk = 0;
        }
        
        if($uploadOk == 1)
        {
            if(move_uploaded_file($_FILES["myFile"]["tmp_name"], $target_file))
            {
                $promotion->addEvent($_POST);
                $_SESSION["alertClass"] = 'success';
                $_SESSION["alertText"] = 'New Events Added Successfully!';
            } else {
                $_SESSION["alertClass"] = 'failure';
                $_SESSION["alertText"] = 'Sorry, there was an error uploading your file.';
            }
            header("Location: promotion.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   
   <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
   <title>Manage Promotion</title>
   <!--    Custom styles   -->
   <link rel="stylesheet" href="css/reset.css" />
   
   <link rel="stylesheet" href="css/default.css" />
   <link rel="stylesheet" href="css/sidebar.css" />
   <link rel="stylesheet" href="css/promotion.css" />
   <link rel="stylesheet" href="css/alert.css" />
   <!--    Icons   -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="leftBar">
        <div id="user">
            <img src="img/default.jpg" alt="Profile Image">
            <p>
                Hi <br/>
                <b >Kuang Tar</b>
            </p>
        </div>
        <nav>
            <a href="cartype.html">Manage Types of Vehicles</a>
            <a href="user.html">Manage Users</a>
            <a href="servicePrice.html">Manage Service Price</a>
            <a href="promotion.html"  id="selected">Manage Promotions</a>
          </nav>
        <div id="signOut">
            <a href="login.html"><i class="fa fa-sign-out"></i> Sign Out</a>
        </div>
    </div>
    <hgroup>
        <h1>Manage Promotion</h1>
    </hgroup>
    <div id="body">
        <div id="title">
            <h1>Promotions</h1>
        </div>
        <div id="content">
            <a>List of Promotions Events</a><button class="button button4 open-modal" data-open="modal1"><i class="fa fa-pencil-square-o"></i> New Event</button>
           
            <div class="alert-box <?php echo $alertClass; ?>"><?php echo $alertText; ?></div>

            <div class="table-box">
                <div class="table-row table-head">
                    <div class="table-cell first-cell">
                       <p>Events</p>
                    </div>
                    <div class="table-cell">
                        <p>Date Created</p>
                    </div>
                    <div class="table-cell last-cell">
                        <p></p>
                    </div>
                </div>

                <?php while($row = $getPromotion->fetch_assoc()) { ?>
                    <div class="table-row" id="<?php echo $row["id"]; ?>">
                    <div class="table-cell first-cell">
                        <p><?php echo $row["event"]; ?></p>
                    </div>
                    <div class="table-cell">
                        <p><?php echo $row["date_created"]; ?></p>
                    </div>
                    <div class="table-cell last-cell">
                        <a href="<?php echo 'promotion.php?StatusId=' . $row["id"]; ?>" class="button button1">
                        <?php if($row["status"] == 1) { ?>
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        <?php } else { ?>
                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        <?php } ?>
                        </a>
                            <!--<button class="button button2 open-modal" data-open="modifyModal" data-id=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>-->
                            <a href="<?php echo 'editPromotion.php?editId=' . $row["id"]; ?>" class="button button2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="<?php echo 'promotion.php?delId=' . $row["id"]; ?>" class="button button3"><i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include "modal.php"; ?>
    <script src="js/promotion.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        
    </script>
</body>
</html>