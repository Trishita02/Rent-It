<?php
require('..\admin\connection.php');
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $msg = mysqli_real_escape_string($con, $_POST['msg']);
    $date=date('Y-m-d h:i:s');
    $sql="Insert into feedback(Name,email,subject,msg,Date) values('$name','$email','$subject','$msg','$date')";
    $result=mysqli_query($con,$sql);
    if($result){
        $message = 'Feedback submitted successfully! Thank you';
    } else {
        $message = 'Failed to submit feedback. Please try again.';
    }
}
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
    <title>About Us</title>
    <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../user-dropdown.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if(!empty($message)): ?>
                alert("<?php echo $message; ?>");
            <?php endif; ?>
        });
    </script>
</head>
<body>
    <section id="header">
      
        <a href="../home.php"><img src="finalogo.jpeg" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a  href="index.php">HOME</a></li> 
                <li><a  href="men.php">MENS WEAR</a></li>
                <li><a href="women.php">WOMENS WEAR</a></li> 
                <li><a class="active" href="about.php">ABOUT</a></li>
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
    <section id="page-header" class="about-header">
        
        <h2>#let's_talk</h2>
        
        <p>LEAVE A MESSAGE. We love to hear from you!</p>
        
    </section>
    <section id="about-head" class="section-p1">
        <img src="img/d2.jpg" alt="">
        <div>
            <h2>HERE CLOTHES FOR RENT</h2>
            <p>
                Welcome to our clothes renting platform, where fashion meets sustainability!<br><br> We believe that everyone deserves to look and feel their best without compromising the environment. Our mission is to provide a convenient and affordable way to access high-quality, stylish clothing while promoting a circular fashion economy.<br><br>
Our curated collection features a wide range of garments for every occasion, from casual everyday wear to elegant evening attire. We work with top brands and designers to ensure that our selection is both fashionable and sustainable. Each item is carefully inspected and cleaned to meet the highest standards of hygiene and quality.

<br><br>Join us in redefining the way we think about fashion. <b>Rent, wear, return, and repeat </b>- it's that simple. Together, we can make a difference, one rental at a time.<br>
 <br>           </p>
 
             
             <br><br>

             <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">"Rent clothes, embrace change, and redefine your style sustainably."</marquee>

        </div>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f2.png" alt="">
            <h6>Online Rental/Donetal</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f3.png" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f4.png" alt="">
            <h6>Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f5.png" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f6.png" alt="">
            <h6>24/7 Support</h6>
        </div>
       
    </section>

    <section id="about-head" class="section-p1 ">
        <img src="img/donate.jpg" alt="">
        <div>
            <h2>HERE CLOTHES FOR DONATE</h2>
            <h2>HERE CLOTHES FOR DONATE</h2>
            <p>       
                Welcome to our clothes donation platform, where generosity meets impact! We are dedicated to making a difference in the lives of those in need by providing a simple and convenient way to donate clothes.
<br><br>
Our mission is to ensure that everyone has access to clean and appropriate clothing, regardless of their circumstances. By donating your gently used clothes, you are helping to clothe individuals and families who are experiencing hardship or crisis.
<br><br>
Every donation counts and makes a meaningful impact. Whether you're cleaning out your closet or looking for a way to give back, we're here to make the donation process easy and rewarding.
<br><br>
<b>Join us in spreading kindness, one piece of clothing at a time. Donate today and help us make a difference in the lives of others.</b>
<br><br>
            </p>
             <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">"Don't let your clothes gather dust, let them gather love."</marquee>

        </div>
    </section>
    <section id="contact-details" class="section-p1">

<div class="details">
    <span>GET IN TOUCH</span>
    <h2>Visit one of our agency locations or contact us today</h2>
    <h3>Head Office</h3>
    <div>
        <li>
            <i class="fal fa-map">
                <br><br><p>265 A Malviya Nagar Allahabad</p>
            </i>
        </li>
        <li>
            <i class="fal fa-envelope"></i>
                <p>contact@example.com</p>
           
        </li>
        <li>
            <i class="fal fa-phone-alt"></i>
                <p>contact@example.com</p>
         
        </li>
        <li>
            <i class="fal fa-clock"></i>
                <p>Monday to Sunday: 9:00am to 16:00pm</p>
            
        </li>
    </div>
</div>

   <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7202.773146605155!2d81.8660671!3d25.492151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399aca789e0c84a5%3A0x2c27733a7529bf08!2sMNNIT%20Allahabad%20Campus%2C%20Teliarganj%2C%20Prayagraj%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1712238906089!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>" frameborder="0"></iframe>
   </div>
    </section>

     <section id="form-details">
        <form method="post" action="about.php">
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you</h2>
            <input type="text" placeholder="YOUR NAME" name="name" required>
            <input type="text" placeholder="E-mail" name="email" required>
            <input type="text" placeholder="Subject" name="subject" required>
            <textarea name="msg"  cols="30" rows="10" placeholder="Your Message" required></textarea>
            <button class="normal" type="submit" name="submit">Submit</button>
        </form>

        <div class="people">
            <div>
                <img src="img/people/1.png" alt="">
                <p><span>Anubhav Krishna</span>Senior Marketting Manager <br>Phone: +000 123 000 77 88 <br>Email: contact@example.com
                </p>
            </div>
            <div>
                <img src="img/people/2.png" alt="">
                <p><span>Abhishek Mishra</span>Senior Marketting Manager <br>Phone: +000 123 000 77 88 <br>Email: contact@example.com
                </p>
            </div>
            <div>
                <img src="img/people/3.png" alt="">
                <p><span>Nitya Tiwari</span>Senior Marketting Manager <br>Phone: +000 123 000 77 88 <br>Email: contact@example.com
                </p>
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
            <a href="#">About us</a>
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
    <script src="script.js"></script>
</body>
</html>