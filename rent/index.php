<?php
require('..\admin\connection.php');
if (isset($_SESSION['login_id'])) {
    $user = $_SESSION['login_id'];
     if ($_SESSION['user_type'] == "normal") {
      $user_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `new user` WHERE Email='$user'"));
      $user_name = $user_query['Username'];
      $user_diamonds=$user_query['diamonds'];
      $profile_image=$user_query['profile_image'];
      if($profile_image=='') $profile_image="noprofile.jpg";
    }
    else{
      $user_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `google users` WHERE Email='$user'"));
      $user_name = $user_query['name'];
      $user_diamonds=$user_query['diamonds'];
      $profile_image=$user_query['profile_image'];
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="finalogo.jpeg" type="image/icon type">
<link rel="stylesheet" href="../user-dropdown.css">

</head>
<body>
    <section id="header">
      
        <a href="../home.php"><img src="finalogo.jpeg" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a class="active"  href="index.php">HOME</a></li> 
                <li><a href="men.php">MENS WEAR</a></li>
                <li><a href="women.php">WOMENS WEAR</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li id="lg-bag"><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
                <li id="lg-bag"><a href="wishlist.php"><i class="fa-sharp fa-regular fa-heart"></i></a></li>
                <?php if (isset($_SESSION['login_id'])) { ?>
                <div class="dropdown">
        <div class="dropbtn" onclick="toggleDropdown()">
        <?php
            if (strpos($profile_image, 'https://') === 0) {
            echo '<img src="'.$profile_image.'" id="profile-photo" onerror="this.src=\'../user_img/noprofile.jpg\';">';
            } else {
            echo '<img src="../user_img/'.$profile_image.'" id="profile-photo" onerror="this.src=\'../user_img/noprofile.jpg\';">';
            }
            ?>
        </div>
        <div id="myDropdown" class="dropdown-content" style="background-color:white;">
            <p class="para">Hey, <?php echo $user_name;?></p><hr>
            <a href="../edit_profile.php"><i class="fas fa-user"></i> Your Profile</a> 
            <a href="my_orders.php"><i class="fas fa-box"></i> Your Orders</a>
            <a href="../donate/my_donations.php"><i class="fas fa-hand-holding-heart"></i>Your Donations</a>
            <a href="#"><i class="fas fa-gift"></i>Rewards <span class="diamonds-line"><?php echo $user_diamonds;?><img src="diamond.avif" alt=""></span></a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
<?php } ?>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>
   <script src="../user-dropdown.js"></script> 
        
       <section id="hero">
        <div class="slider">
            <!-- list Items -->
            <div class="list">
                <div class="item active">
                    <img src="image/bg1.jpg">
                    <div class="content">
                        <p>design</p>
                        <h2>Vouge</h2><br>
                        <p>
                            "Transform your look, transform your day. Rent the perfect outfit and let your style speak for itself."
                        </p>
                        <button class="normal" onclick="window.location.href='women.php';">Womens Rent Wear</button>
                            <button class="normal" onclick="window.location.href='men.php';">Mens Rent Wear</button>
                        
                    </div>
                </div>
                <div class="item">
                    <img src="image/images(l10).webp">
                    <div class="content">
                        <p>design</p>
                        <h2>Fashion</h2><br>
                        <p>
                          <b>  "Why settle for one look when you can have them all? Renting clothes opens up a world of possibilities, where your style knows no bounds."
                        </b></p>
                        
                            <button class="normal" onclick="window.location.href='women.php';">Womens Rent Wear</button>
                            <button class="normal" onclick="window.location.href='men.php';">Mens Rent Wear</button>
                        
                    </div>
                    
                </div>
                <div class="item">
                    <img src="image/bg9.avif">
                    <div class="content">
                        <p>design</p>
                        <h2>Elegance</h2><br>
                        <p>
                          <b>  "Fashion on your terms: rent, return, rejoice!"
                        </b></p>
                        <button class="normal" onclick="window.location.href='women.php';">Womens Rent Wear</button>
                            <button class="normal" onclick="window.location.href='men.php';">Mens Rent Wear</button>
                        
                    </div>
                </div>
                <div class="item">
                    <img src="image/bg6.avif">
                    <div class="content">
                        
                        <p>design</p>
                        <h2>Panache</h2><br>
                        <p>
                            <b>Why buy when you can rent? Our collection of stylish outfits lets you experiment with new looks without the commitment."
                        </b></p>
                        <button class="normal" onclick="window.location.href='women.php';">Womens Rent Wear</button>
                            <button class="normal" onclick="window.location.href='men.php';">Mens Rent Wear</button>
                        
                    </div>
                </div>
                <div class="item">
                    <img src="image/images (11).jpeg">
                    <div class="content">
                        <p>design</p>
                        <h2>Trends</h2><br>
                        <p>
                            "Fashion should be fun, not stressful. Renting clothes takes the hassle out of getting dressed, so you can focus on enjoying the moment."
                        </p>
                        <button class="normal" onclick="window.location.href='women.php';">Womens Rent Wear</button>
                            <button class="normal" onclick="window.location.href='men.php';">Mens Rent Wear</button>
                        
                    </div>
                </div>
            </div>
            <!-- button arrows -->
            <div class="arrows">
                <button id="prev"></button>
                <button id="next">></button>
            </div>
            <!-- thumbnail -->
            <div class="thumbnail">
                <div class="item active">
                    <img src="image/bg1.jpg">
                    
                </div>
                <div class="item">
                    <img src="image/images(l10).webp">
                    
                </div>
                <div class="item">
                    <img src="image/bg9.avif">
                    
                </div>
                <div class="item">
                    <img src="image/bg6.avif">
                   
                </div>
                <div class="item">
                    <img src="image/images (11).jpeg">
                    
                </div>
            </div>
        </div>
       </section>
    
    
    
        
   


    <section id="blog">
        <div class="blog-box">
            <div class="blog-img ">
               <img class="n" src="img/n1.jpg" alt="">
            </div>
            <div class="blog-details">
               <p>TREND ALERTS</p>
               <h2>Derisk You Style Experiment</h2>
               <p>Be any version of yourself without burning your pockets</p>
              <a href="cart.html"> <button class="normal">Rent Now</button></a>
                <div class="sm-box">
                        <div class="a">
                                 <img src="img/n3.jpg" alt="">
                                 <p>Stylish Shirts</p>
                                 <p>Rs:650</p>
                        </div>
                        <div class="a">
                            <img src="img/about/n4.jpg" alt="">
                            <p>Stylish Shirts</p>
                            <p>Rs:650</p>
                   </div>
                </div>
           </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h2>Fashion On <br>The Rocks</h2>
            <p>CLASSY IS HER MIDDLE NAME</p>
           
          
        </div>
        <div class="banner-box banner-box2" >
            <h4>spring/summer</h4>
            <h2>upcoming season</h2>
            <span>The best classic dress is on sale at cara</span>
            
        </div>
    </section>
    
    <section id="banner3">
        <div class="banner-box">
            <h2>STYLES EXCLUSIVE</h2>
            <h3>Be any version of yourself</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>NEW CLOTHES COLLECTION</h2>
            <h3>Spring/Summer 2024</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>Designer Dresses</h2>
            <h3>New Tranding print</h3>
        </div>
    </section>
  

    <section id="blog">
        <div class="blog-box">
            <div class="blog-details">
                <p>Mens Wear</p>
                <h2>Why Should Girls Have All The Fun?</h2>
                <p>For the dapper and uber stylish modern man</p>
                <a href="cart.html"> <button class="normal">Rent Now</button></a>
                 <div class="sm-box">
                        
                         <div class="a">
                                  <img src="img/n5.jpg" alt="">
                                  <p>Stylish Women's Wear</p>
                                  <p>Rs:359</p>
                         </div>
                         <div class="a">
                             <img src="img/n7.jpg" alt="">
                             <p>Stylish Gowns</p>
                             <p>RS:499</p>
                    </div>
                 </div>
            </div>
            <div class="blog-img l">
               <img class="n1" src="img/n2.jpg" alt="">
            </div>
            
    </section>

    

 

   <section id="a">
     <h1>Join The Revolution</h1>
     <div class="c">
     <div class="b">
        <p>I wore this stunning gold mirror lehenga for my best friend's destination wedding and I absolutely loved the attention that I grabbed that day! The fittimg was perfect too Thank you Team Stylease for making me look so gorgeous in my Insta pictures!</p>
        <h4>Nitya Tiwari</h4>
     </div>
     <div class="b">
        <p>This lehenga came in a packaging that was spot-on. The fittings were absolutely perfect too and I got a lot of compliments on this style. Absolutely love the collection, theres's always something for every occasion. Thank you team Stylease for making sure I look my best this wedding season!</p>
        <h4>Tanisha</h4>
     </div>
     <div class="b">
        <p>We loved our experience with The Stylease. We decided to attend a friend's sangeet at the last minute and we didn't want to spend a bomb on something that we weren't going to use. The Stylease went out of their way and helped us look our best for the event.</p>
        <h4>Abhishek</h4>
     </div>
     </div>

   </section>

 

   <footer class="section-p1">
    <div class="col">
        <img class="logo" src="finalogo.jpeg" alt="">
        <h4>Contact</h4>
        <p><strong>Address:</strong> 265 A malviya Nagar Allahabad</p>
         <p><strong>Phone:</strong> +01 3333 654/(+91) 9305299284</p>
         <p><strong>Hours:</strong>10:00 - 18:00,Mon - sat</p>
       
    </div>
    <div class="col">
        <h4>About</h4>
        <a href="about.php">About us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Contact Us</a>
    </div>
    <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign In</a>
        <a href="cart.php">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track My Order</a>
        <a href="#">Help</a>
    </div>

    <div class="col install">
       
        <p>Secured Payment Gateways</p>
        <img src="img/pay/pay.png" alt="">
    </div>
   
</footer>
<script src="app.js"></script>
</body>
</html>