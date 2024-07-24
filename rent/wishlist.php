<?php
require('..\admin\connection.php');
if(isset($_SESSION['login_id'])){
$email=$_SESSION['login_id'];
}
else{
    header('location:../login.php');
    exit();
}
if (isset($_GET['add_id']) && isset($_SESSION['login_id']) ) {
    $id = mysqli_real_escape_string($con, $_GET['add_id']);
    $email=$_SESSION['login_id'];
    $sql2="Insert into wishlist(product_id,email) values('$id','$email')";
    $result2=mysqli_query($con,$sql2);
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit();
}
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=mysqli_real_escape_string($con,$_GET['type']);
	if($type=='delete'){
		$id=mysqli_real_escape_string($con,$_GET['id']);
		$delete_sql="delete from wishlist where product_id='$id'";
		mysqli_query($con,$delete_sql);
	}
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
    <title>Wishlist</title>
    <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="wishlist.css">
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
    <h2 id="heading">Your Wishlist <i class="fa-sharp fa-regular fa-heart"></i></h2><hr><br><br>
    

    <div class="wrapper">
		<div class="project">
			<div class="shop">
                    <?php
                    $result=mysqli_query($con,"SELECT * FROM `wishlist` where email='$email'");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { 
                            $product_id=$row['product_id'];
                            $product=mysqli_query($con,"SELECT * FROM `product` where id='$product_id'");
                            $product_data=mysqli_fetch_assoc($product);
                            $name =$product_data['name'];
                            $image = $product_data['image1'];
                            $price= $product_data['price'];
                            $size= $product_data['size'];
                        ?>
				<div class="box" onclick="window.location.href='product_detail.php?id=<?php echo  $product_id;?>';"
                style="cursor:pointer;">
                <img src="<?php echo '../admin/product_img/' .$image; ?>" alt="">
					<div class="content">
						<h3><?php echo $name; ?></h3>
                        <p class="size">Size: <?php echo $size; ?></p>
						<h4>Price: <?php echo $price; ?> RS/day</h4>
						<a class="btn-area" href="?type=delete&id=<?php echo $row['product_id']; ?>" style="text-decoration:none;"><i aria-hidden="true" class="fa fa-trash"></i> <span class="btn2">Remove</span></a>
					</div>
				</div>
                <?php } ?>
                </div>
			</div>
                <?php } else {?>
                    <div class="empty-wishlist">
                        <img src="empty_wishlist.png" alt="wishlist is Empty" class="empty-wishlist-image"><br>
                    </div>
            <?php } ?>
		</div>
	</div>
</body>
</html>
</body>
