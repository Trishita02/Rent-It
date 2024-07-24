<?php
require('..\admin\connection.php');
if(isset($_SESSION['login_id'])){
$email=$_SESSION['login_id'];
}
else{
    header('location:../login.php');
    exit();
}
$isLoggedIn = isset($_SESSION['login_id']);
$order_id=$_GET['order_id'];

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
    <title>Order Details</title>
    <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="my_orders_details.css">
    <link rel="stylesheet" href="../user-dropdown.css">
    <style>
        .empty-cart {
            text-align: center;
        }

        .empty-cart-image {
            width: 100%;
            max-width: 500px;
        }

        @media (max-width: 968px) {
            .empty-cart-image {
                width: 70%;
            }
        }

        @media (max-width: 680px) {
            .empty-cart-image {
                width: 90%;
            }
        }

        .diamonds-line {
            display: flex;
            align-items: center;
            font-size: 1em;
            white-space: nowrap;
        }

        .diamonds-line img {
            max-width: 30px; /* Adjust size */
            height: auto;
        }

        @media screen and (max-width: 768px) {
            .diamonds-line {
                font-size: 0.9em; /* Adjust font size for smaller screens */
            }

            .diamonds-line img {
                max-width: 25px; /* Adjust size for smaller screens */
            }
        }

        .right-bar {
            border:1px solid blue;
            height: 480px;
            padding: 20px;
        }
        .diamonds-text {
            display: inline-flex;
            align-items: center;
        }

        .diamonds-text img {
            max-width: 30px; 
            height: auto;
        }
        span{
        font-weight: bold;  
        }
    </style>
</head>
<body>
    <section id="header">
        <a href="index.php"><img src="finalogo.jpeg" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">HOME</a></li> 
                <li><a href="men.php">MENS WEAR</a></li>
                <li><a href="women.php">WOMENS WEAR</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li id="lg-bag"><a href="cart.php" class="active"><i class="far fa-shopping-bag"></i></a></li>
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
    <br><br>
    <div class="wrapper">
        <div class="project">
            <div class="shop">
            <?php
                $result = mysqli_query($con, "SELECT * FROM `my_orders` WHERE email='$email' and order_id='$order_id'");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['product_id'];
                        $product_result = mysqli_query($con, "SELECT * FROM `product` WHERE id='$product_id'");
                        $product_data = mysqli_fetch_assoc($product_result);
                        $name = $product_data['name'];
                        $image = $product_data['image1'];
                        $size = $product_data['size'];
                        $quantity = $row['quantity'];
                        $duration=$row['duration'];
                        $rewards=$row['rewards'];
                ?>
                <div class="box" onclick="window.location.href='product_detail.php?id=<?php echo $product_id; ?>';" style="cursor:pointer;">
                    <img src="<?php echo '../admin/product_img/' . $image; ?>" alt="">
                    <div class="content">
                        <h3><?php echo $name; ?></h3>
                        <p class="size">Size: <?php echo $size; ?></p>
                        <h4>Price: <?php echo $row['price'];?> RS </h4>
                        <p class="unit">Quantity: <?php echo $row['quantity']; ?></p>
                        <p class="unit">Duration: <?php echo $row['duration']; ?> Days</p>
                    </div>
                </div>
                <?php
                    }
                }
                $details=mysqli_query($con,"Select * from payment where order_id='$order_id'");
                if (mysqli_num_rows($details) > 0) {
                $details_result=mysqli_fetch_assoc($details);
                $Name=$details_result['Name'];
                $Phoneno=$details_result['Phoneno'];
                $AltPno=$details_result['AltPno'];
                $Email=$details_result['Email'];
                $Address=$details_result['Address'];
                $City=$details_result['City'];
                $Pincode=$details_result['Pincode'];
                $Landmark=$details_result['Landmark'];
                }
                ?>
                </div>
                <div class="right-bar">
                <span style="font-size: 23px;"><?php echo $Name; ?></span><br><br><hr>
                <h3>Phone no : </h3><?php echo $Phoneno; ?>
                <?php if($AltPno!='') echo ", "; echo $AltPno; ?><br><br><br>
                <h3>Email : </h3><?php echo $Email; ?><br><br><br>
                <h3>Address : </h3><?php echo $Address; 
                echo " , ";
                echo $City;
                echo " , Pincode - ";
                echo $Pincode; 
                if($Landmark!=''){
                    echo " ( near ";
                    echo $Landmark;
                    echo " )";
                }
                ?><br><br><hr>
                <h3>Rewards : </h3>
                <span class="diamonds-line"><?php echo $rewards;?><img src="diamond.avif" alt="Diamond"></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>