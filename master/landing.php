<!DOCTYPE html>
<html lang="en">
<head >
   <meta charset="utf-8">
   <title>CyberGo - Landing Page</title>
   <!--    Custom styles   -->
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/landing.css" />
   <!--    Icons   -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div id="headtop">
        <div id="pageTitle">
            <h1>
                RENT YOUR<br>
                DREAM CAR<br>
                TODAY<br>
            </h1>
            <h2>
                Don't wanna miss out on our offers?<br>
                <a href="login.html">Sign Up Now!</a>
                or
                <a href="login.html">login </a>
                if you have an account already!
            </h2> 
        </div>

        <div id="rightSide">
            <form>
                <fieldset id="loginForm">
                    <h1>Search for Car Rental</h1>
                    <div class="select">
                        <select id=cartype >
                            <option value="" selected disabled>Select car type</option>
                            <option value="suv">SUV</option>
                            <option value="sedan">Sedan</option>
                            <option value="compact">Compact</option>
                        </select>
                    </div>  
                    <div class="select">
                        <select id=location >
                            <option value="" selected disabled>Pickup Location</option>
                            <option value="tsq">Tamarind Square</option>
                            <option value="dpulze">Dpulze</option>
                            <option value="prima">Prima Avenue</option>
                            <option value="shaftsbury">Shaftsbury</option>
                        </select>
                    </div>
                    <input type="text" name="pickup" placeholder="Pickup Date" onclick="(this.type='date')">
                    <input type="text" name="return" placeholder="Return Date" onclick="(this.type='date')">
                    
                    <a href="login.html">Search  <span class="raquo">&raquo;</span></a>
                </fieldset>
            </form>
        </div>
        
    </div>
    
    <div id="detailsBody">
        <div class="salesBox">
            <h2>Our Service</h2>
                <p>Today, we process over 520 million queries across our platforms each 
                    month for travel information, helping millions of travelers around the 
                    globe make confident decisions. With every query, KAYAK searches hundreds 
                    of travel sites to show travelers the information they need to find the
                    right flights, hotels, rental cars and vacation packages.</p>
    
                 <p>In over a decade, we've grown from a small office of 14 employees into 
                    a company of over 1,000 travel-loving teammates working across 7 
                    international brands; KAYAK, SWOODOO, checkfelix, momondo, Cheapflights, 
                    Mundi and HotelsCombined. Together, we help people experience the world 
                    by creating their favorite travel tools.</p>                   
        </div>
        <div class="salesBox" >
            <h2>About Us</h2>
                <p>Today, we process over 520 million queries across our platforms each 
                    month for travel information, helping millions of travelers around the 
                    globe make confident decisions. With every query, KAYAK searches hundreds 
                    of travel sites to show travelers the information they need to find the
                    right flights, hotels, rental cars and vacation packages.</p>
    
                <p>In over a decade, we've grown from a small office of 14 employees into 
                    a company of over 1,000 travel-loving teammates working across 7 
                    international brands; KAYAK, SWOODOO, checkfelix, momondo, Cheapflights, 
                    Mundi and HotelsCombined. Together, we help people experience the world 
                    by creating their favorite travel tools.</p>
        </div>
        <div class="salesBox">
            <h2>Be a Partner</h2>
                <p>Today, we process over 520 million queries across our platforms each 
                    month for travel information, helping millions of travelers around the 
                    globe make confident decisions. With every query, KAYAK searches hundreds 
                    of travel sites to show travelers the information they need to find the
                    right flights, hotels, rental cars and vacation packages.</p>
    
                <p>In over a decade, we've grown from a small office of 14 employees into 
                    a company of over 1,000 travel-loving teammates working across 7 
                    international brands; KAYAK, SWOODOO, checkfelix, momondo, Cheapflights, 
                    Mundi and HotelsCombined. Together, we help people experience the world 
                    by creating their favorite travel tools.</p>
        </div>
    </div>
</body>
</html>