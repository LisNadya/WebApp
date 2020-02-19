<?php
include "db/conn.php";
session_start(); 

if( !(isset($_SESSION['login'])&&!empty($_SESSION['login'])) ){
    header("Location: login.php");
}

$USERID = $_SESSION['userID'];
$USERTYPE = $_SESSION['userType'];

$pageHeader = array(
    'available_cars'    => "View List of Available Cars",
    'userProfile'       => "View User Profile",
    'carRentHistory'    => "View Rental History",
    'cartype'           => "Manage Types of Vehicles",
    'user'              => "Manage Users",
    'servicePrice'      => "Manage Service Price",
    'promotion'         => "Manage Promotions"
);

if($USERTYPE==0){
    $colID = 'cusID';
    $colName = 'cusName';
    $colPic = 'cusPicFile';
    $table = 'customer';
    $navigation = array(
        'available_cars' => array("<a href='available_cars.php'", ">View List of Cars</a>"),
        'userProfile' => array("<a href='user_profile.php'",">User Profile</a>"),
        'carRentHistory' => array("<a href='rental_history.php'", ">Rental History</a>")
    );
}
else if($USERTYPE==1){
    $colID = 'vendorID';
    $colName = 'vendorName';
    $colPic = 'vendorPicFile';
    $table = 'vendor';
    $navigation = array(
        'vendor-dashboard.php' => array("<a href = 'vendor-dashoard.php'", ">Dashboard </a> <br/>"),
        'vendor-profile.php' => array("<a href = 'vendor-profile.php'", ">Profile </a> <br/>"),
        'vendor-report.php' => array("<a href = 'vendor-report.php'", ">Monthly Report </a> <br/>")
    );
}
else if($USERTYPE==2){
    $colID = 'adminID';
    $colName = 'adminName';
    $colPic = 'adminPicFile';
    $table = 'admin';
    $navigation = array(
        'cartype'=>array("<a href='cartype.php'",">Manage Types of Vehicles</a>"),
        'user'=>array("<a href='user.php'",">Manage Users</a>"),
        'servicePrice'=>array("<a href='servicePrice.php'",">Manage Service Price</a>"),
        'promotion'=>array("<a href='promotion.php'",">Manage Promotions</a>")
    );
}

$target_profile_dir = "img/profile/";

$conn = $DB->connect();
$sql = "select * from $table where $colID = '$USERID'";
$getUser = $conn->query($sql);
$conn->close();

while($row = $getUser->fetch_assoc()){
    $userName = $row[$colName];
    $userIcon = $row[$colPic];
    $userIcon = $target_profile_dir.$userIcon;
}

$pgName = $PAGE->getPage($_SERVER['REQUEST_URI']);
?>

<?php if($USERTYPE == 0 || $USERTYPE == 2){?>
<!DOCTYPE html>
<html lang="en">
<head lang="en">
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1" name="viewport" />
   <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!-- <title>List of Available Cars</title> -->
   <!--    Custom styles   -->
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/default.css" />
   <link rel="stylesheet" href="css/sidebar.css" />
   <!--    Icons   -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
</head>
<body>
    <aside id="leftBar">
        <div id="user">
            <img src="<?php echo $userIcon;?>" alt="User Icon">
            <p>
                Hi <br/>
                <b><?php echo $userName?></b>
            </p>
        </div>
        <nav>
            <?php
                foreach($navigation as $i => $page){
                    $count = 0;
                    foreach($page as $nav){
                        echo $nav;
                        if($count==0 && $i == $pgName){
                           echo "id='selected'";
                        }
                    }
                }
                ?>
            </nav>
            <div id="signOut">
                <a href="signout.php"><i class="fa fa-sign-out"></i> Sign Out</a>
            </div>
        </aside>

        <hgroup>
            <h1>
            <?php 
                foreach($pageHeader as $i => $title){
                    if($i == $pgName){
                        echo $title;
                    }
                }
            ?>
            </h1>
        </hgroup> 
    </body>
    </html> 

<?php } else if($USERTYPE == 1){?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css\sidebar-v.css">
    <title>
        Vendor Dashboard
    </title>
    </head>

    <body>
        <aside id="sidebar">
            <div id="avatar">
                <img src="img/default.jpg" alt="avatardp">
                <span>
                    Hi, <br />
                    <b id="avatarname">Lis Nadya binti Zaidi</b>
                </span>
            </div>
            <!--End of avatar-->
            <nav id="sidebarnav">
                <?php
                    foreach($navigation as $i => $page){
                        $count = 0;
                        foreach($page as $nav){
                            echo $nav;
                            if($count==0 && $i == $pgName){
                            echo "id='selected'";
                            }
                            $count++;
                        }
                    }
                ?>
            </nav>
            <nav id="nav-logout">
                <a href="login.php" class="sidelink">
                    <img src="img/logout-512.png" id="logoutpic" alt="Log out from profile">
                    <div id="logout">Sign Out</div>
                </a>

            </nav>
        </aside>
    </body>
    </html>
<?php } ?>