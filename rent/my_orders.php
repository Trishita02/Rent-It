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
    <title>Your Orders</title>
    <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="my_orders.css">
    <link rel="stylesheet" href="../user-dropdown.css">
    <style>
        .empty-wishlist {
    text-align: center;
}

.empty-wishlist-image {
    width: 100%;
    max-width: 500px;
}

@media (max-width: 968px) {
    .empty-wishlist-image {
        width: 70%;
    }
}

@media (max-width: 680px) {
    .empty-wishlist-image {
        width: 90%;
    }
}

    </style>
</head>
<body>
  
    <section id="header">
      
        <a href="index.php"><img src="finalogo.jpeg" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a  href="index.php">HOME</a></li> 
                <li><a  href="men.php">MENS WEAR</a></li>
                <li><a href="women.php">WOMENS WEAR</a></li>
               
                <li><a href="about.php">ABOUT</a></li>
                <li id="lg-bag"><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
                <li id="lg-bag" ><a href="wishlist.php" class="active"><i class="fa-sharp fa-regular fa-heart"></i></a></li>
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
    <br>
    <h2 id="heading">Your Orders <i class="fas fa-box"></i></h2><hr><br><br>
    

    <div class="wrapper">
		<div class="project">
			<div class="shop">
                    <?php
                    $result=mysqli_query($con,"SELECT DISTINCT order_id FROM `my_orders` where email='$email' ORDER BY order_date DESC");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { 
                            $order_id=$row['order_id'];
                            $order_date_query = mysqli_query($con, "SELECT order_date,order_status FROM my_orders WHERE order_id='$order_id' LIMIT 1");
                            $order_date_result = mysqli_fetch_assoc($order_date_query);
                            $order_date = $order_date_result['order_date'];
                            $delivery_date = date('Y-m-d', strtotime($order_date . ' + 4 days'));
                            $order_status=$order_date_result['order_status'];
                            
                            // Fetch the total price
                            $price_query = mysqli_query($con, "SELECT SUM(price) AS total_price FROM my_orders WHERE order_id='$order_id'");
                            $price_result = mysqli_fetch_assoc($price_query);
                            $total_price = $price_result['total_price'];

                            $quantity_query = mysqli_query($con, "SELECT SUM(quantity) AS total_quantity FROM my_orders WHERE order_id='$order_id'");
                            $qunatity_result = mysqli_fetch_assoc($quantity_query);
                            $total_quantity = $qunatity_result['total_quantity'];
                        ?>
				<div class="box" onclick="window.location.href='my_orders_details.php?order_id=<?php echo $order_id;?>';"
                style="cursor:pointer;">
					<div class="content">
						<h3>Order ID:<?php echo $order_id; ?></h3>
                        <p class="size">Order placed on : <?php echo $order_date; ?></p>
                        <p class="size" style="top:40px;">Delivery expected by: <?php echo $delivery_date; ?></p>
						<h4>Price: <?php echo $total_price; ?> RS</h4>
                        <p>Total Items:<?php echo $total_quantity; ?></p>
                        <h4> Order Status: <?php echo $order_status; ?></h4>
					</div>
				</div>
                <?php } ?>
                </div>
			</div>
                <?php } else {?>
                    <div class="empty-wishlist">
                        <img src="my_orders.png" alt="wishlist is Empty" class="empty-wishlist-image"><br>
                    </div>
            <?php } ?>
		</div>
	</div>
</body>
</html>
</body>
