<?php
require('..\admin\connection.php');
$id=$_GET['id'];
$sql="SELECT * FROM `product` WHERE id='$id'";
$result=mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$cat=mysqli_fetch_assoc(mysqli_query($con,"SELECT category FROM `product` WHERE id='$id'"));
if($row<=0){
    header('location:index.php');
}
if(isset($_SESSION['login_id'])){
    $email=$_SESSION['login_id'];
}
else $email='';
$cart_button="SELECT * FROM `cart` WHERE product_id='$id' and email='$email'";
$cart_result=mysqli_query($con,$cart_button);
$inCart = (mysqli_num_rows($cart_result) > 0);

$wishlist_button="SELECT * FROM `wishlist` WHERE product_id='$id'";
$wishlist_result=mysqli_query($con,$wishlist_button);
$inWishlist = (mysqli_num_rows($wishlist_result) > 0);

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
    <title><?php echo $row['name']?></title>
    <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../user-dropdown.css">
</head>
<script>
function addToCart() {
    var duration = document.getElementById("duration").value;
    var quantity = document.getElementById("quantity").value;

    if (duration=="Rental Duration" || !quantity) {
        alert("Please select rental duration and quantity.");
        return;
    }

    var id = "<?php echo $id; ?>";
    var url = `cart.php?id=${id}&duration=${duration}&quantity=${quantity}`;
    window.location.href = url;
    alert('Product added to the cart');

}
function addToWishlist() {
    var id = "<?php echo $id; ?>";
    var url = `wishlist.php?add_id=${id}`;
    window.location.href = url;
    alert('Product added to the wishlist');
}
function validateQuantity() {
    var input = document.getElementById("quantity");
    var max = <?php echo $row['quantity']; ?>;
    
    if (input.value > max) {
        input.value = max;
    }
}
</script>
<body>
    <section id="header">
      
        <a href="index.php"><img src="finalogo.jpeg" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">HOME</a></li> 
                <?php 
                if($cat['category']=='Men'){
                ?>
                <li><a class="active" href="men.php">MENS WEAR</a></li>
                <li><a  href="women.php">WOMENS WEAR</a></li>
                <?php }else{?>
                <li><a  href="men.php">MENS WEAR</a></li>
                <li><a class="active" href="women.php">WOMENS WEAR</a></li>
                <?php }?>

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
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="<?php echo '../admin/product_img/'.$row['image1'];?>" width="100%" id="MainImg" alt=""/>
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="<?php echo '../admin/product_img/'.$row['image1'];?>" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo '../admin/product_img/'.$row['image2'];?>" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo '../admin/product_img/'.$row['image3'];?>" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo '../admin/product_img/'.$row['image4'];?>" width="100%" class="small-img" alt="">
                </div>
            </div>
        </div>
        <div class="single-pro-details">
            <h5><?php echo $row['name']?></h5>
            <h4><u><?php echo $row['title']?></u></h4>
            <h2>Rent Rs:<?php echo $row['price']?>.00/day</h2>
            <select id="duration"  <?php echo ($row['quantity'] <= 0) ? 'disabled' : ''; ?>>
                <option disabled selected>Rental Duration</option>
                <option value="2">2 Days</option>
                <option value="4">4 Days</option>
                <option value="7">7 Days</option>
                <option value="10">10 Days</option>
                <option value="15">15 Days</option>       
            </select>
            <input type="number" id="quantity" placeholder="Enter quantity" min="1" max="<?php echo $row['quantity']; ?>"
            <?php echo ($row['quantity'] <= 0) ? 'disabled' : ''; ?> oninput="validateQuantity()"/>
            <p style="color:red; font-weight:bold;">
                <?php  if($row['quantity']<=0){ ?>
            Item out of stock</p>
            <?php }else{ ?>
            <h4>Available Size: <?php echo $row['size']?></h4>
            <?php } 
            if(!$inCart){ ?>
            <button class="normal" onclick="addToCart()"> <i class="fa fa-shopping-cart"></i> &nbsp; Add To Cart</button> 
            <?php } else{ ?>
            <button class="normal" onclick="window.location.href='cart.php'"> <i class="fa fa-shopping-cart"></i> &nbsp; Go To Cart</button> 
            <?php } ?>

            <?php if(!$inWishlist){ ?>
            <button class="normal" onclick="addToWishlist()"> <i class="fa-sharp fa-regular fa-heart"></i> &nbsp; Add To Wishlist</button> 
            <?php } else{ ?>
            <button class="normal" onclick="window.location.href='wishlist.php'"> <i class="fa-sharp fa-regular fa-heart"></i> &nbsp; Go To Wishlist</button> 
            <?php } ?>
            <h4>Product Details</h4>
            <span>    
            <?php echo $row['description']?>
            </span>
        </div>
    </section>


    <section id="product1" class="section-p1">
        <h2>Related Product</h2>
        <p>New Collection of Morden Design</p>
        <div class="pro-container">
        <?php
        $category=$cat['category'];
        $related_query = "SELECT * FROM `product` WHERE category='$category' AND id<>'$id' ORDER BY RAND() LIMIT 4";
        $related_result = mysqli_query($con, $related_query);
        
        while($row=mysqli_fetch_assoc($related_result)){?>
            <div class="pro" onclick="window.location.href='product_detail.php?id=<?php echo $row['id'];?>';">
            <img src="<?php echo '../admin/product_img/'.$row['image1'];?>"/>
                <div class="des">
                    <h5><?php echo $row['name'] ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span style="font-size:15px;"><b>Size:</b> <?php echo $row['size'] ?></span>
                    <br><br>
                    <h4><?php echo $row['price'] ?> RS</h4>
                </div>
            </div>
        <?php } ?>
            
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="finalogo.jpeg" alt="">
            <h4>Contact</h4>
            <p><strong>Address:</strong> 265 A malviya Nagar Allahabad</p>
             <p><strong>Phone:</strong> +01 3333 654/(+91) 9305299284</p>
             <p><strong>Hours:</strong>10:00 - 18:00,Mon - sat</p>
             <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                    <i class="fab fa-youtube"></i>
                </div>
             </div>
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
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="">
                <img src="img/pay/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" alt="">
        </div>
        <div class="copyright">
            <p>2021, Tech2 etc - HTML CSS Ecommerce Template</p>
        </div>
    </footer>

    <script>
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("small-img");

        smallimg[0].onclick = function(){
            MainImg.src=smallimg[0].src;
        }
        smallimg[1].onclick = function(){
            MainImg.src=smallimg[1].src;
        }
        smallimg[2].onclick = function(){
            MainImg.src=smallimg[2].src;
        }
        smallimg[3].onclick = function(){
            MainImg.src=smallimg[3].src;
        }

    </script>




</body>
</html>