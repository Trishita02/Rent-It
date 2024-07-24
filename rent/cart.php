<?php
require('..\admin\connection.php');
if(isset($_SESSION['login_id'])){
$email=$_SESSION['login_id'];
}
else{
    header('location:../login.php');
    exit();
}
if (isset($_GET['id']) && isset($_GET['duration']) && isset($_GET['quantity']) && isset($_SESSION['login_id']) ) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $duration = mysqli_real_escape_string($con, $_GET['duration']);
    $quantity = mysqli_real_escape_string($con, $_GET['quantity']);
    $data=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `product` where id='$id'"));
    $price = mysqli_real_escape_string($con, $data['price']);
    $price=$price*$duration*$quantity;
    $email=$_SESSION['login_id'];
    $sql2="Insert into cart(product_id,email,price,quantity,duration) values('$id','$email','$price','$quantity','$duration')";
    $result2=mysqli_query($con,$sql2);
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit();
}
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=mysqli_real_escape_string($con,$_GET['type']);
	if($type=='delete'){
		$id=mysqli_real_escape_string($con,$_GET['id']);
		$delete_sql="delete from cart where product_id='$id'";
		mysqli_query($con,$delete_sql);
	}
}
$total=0;
$isLoggedIn = isset($_SESSION['login_id']);
// Fetch user's diamond count
if($_SESSION['user_type'] == "normal") {
    $user_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT diamonds FROM `new user` WHERE Email='$email'"));
  } else if ($_SESSION['user_type'] == "gmail") {
    $user_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT diamonds FROM `google users` WHERE email='$email'"));
}
$diamonds = $user_data['diamonds'];

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
    <title>Cart</title>
    <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="../user-dropdown.css">
    <style>
         .box.out-of-stock {
            background-color:rgb(179, 171, 171);
        }

        .box.out-of-stock .content:after {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
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
            height: 470px;
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
        #checkoutButton[disabled] {
    opacity: 0.5; /* Example of styling for disabled state */
    cursor: not-allowed;
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
    <p id="heading">Your Cart <i class="far fa-shopping-bag"></i></p><hr><br><br><br><br>
    <div class="wrapper">
        <div class="project">
            <div class="shop">
            <?php
                $result = mysqli_query($con, "SELECT * FROM `cart` WHERE email='$email'");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['product_id'];
                        $product_result = mysqli_query($con, "SELECT * FROM `product` WHERE id='$product_id'");
                        $product_data = mysqli_fetch_assoc($product_result);
                        $name = $product_data['name'];
                        $image = $product_data['image1'];
                        $size = $product_data['size'];
                        $available_quantity = $product_data['quantity'];
                        $selected_quantity = $row['quantity'];
                        $out_of_stock_class = ($selected_quantity > $available_quantity) ? 'out-of-stock' : '';
                ?>
                <div class="box <?php echo $out_of_stock_class;?>" onclick="window.location.href='product_detail.php?id=<?php echo $product_id; ?>';" style="cursor:pointer;">
                    <img src="<?php echo '../admin/product_img/' . $image; ?>" alt="">
                    <div class="content">
                        <h3><?php echo $name; ?></h3>
                        <p class="size">Size: <?php echo $size; ?></p>
                        <h4>Price: <?php echo $row['price'];?> RS </h4>
                        <?php if($out_of_stock_class!='') {?>
                        <p class="unit" style="color:red; font-weight:bold;">Item out of stock</p>
                        <?php } else{ ?>
                        <p class="unit">Quantity: <?php echo $row['quantity']; ?></p>
                        <p class="unit">Duration: <?php echo $row['duration']; ?> Days</p>
                        <?php } ?>
                        <a class="btn-area" href="?type=delete&id=<?php echo $row['product_id']; ?>" style="text-decoration:none;">
                            <i aria-hidden="true" class="fa fa-trash"></i> <span class="btn2">Remove</span>
                        </a>
                    </div>
                </div>
                <?php
                        if($out_of_stock_class==''){
                        $total += $row['price'];
                        }
                    }
                ?>
                </div>
                <div class="right-bar">
                <div>
                <input type="checkbox" id="useDiamonds" <?php echo $diamonds == 0 ? 'disabled' : ''; ?> onclick="applyDiamondsDiscount()">
    <span for="useDiamonds"  class="diamonds-line">Use Your <?php echo $diamonds; ?> <img src="diamond.avif" alt="Diamond"></span>
    <hr>
    </div>

    <p><span>Subtotal</span> <span id="subtotal"><?php echo $total ?> RS</span></p>
    <hr id="hr" style="display: none;">
    <p id="diamondsParagraph" style="display: none;">
    <span class="diamonds-text">
        Diamonds<img src="diamond.avif" alt="Diamond"></span>
        <span style="float:right;"><?php if ($total < $diamonds) { echo "-".$total; } else { echo "-".$diamonds; } ?></span>
    
</p>

    <hr>
    <p><span>Shipping</span> <span>FREE</span></p>
    <hr>
    <p><span>Total</span> <span id="total"><?php echo $total ?> RS</span></p><br><br>

    <span id="checkoutButton" onclick="checkStockAndProceed()"> <a href="#"> <i class="fa fa-shopping-cart"></i>&nbsp; &nbsp;Checkout </a> </span>

                </div>
                <?php } else { ?>
                <div class="empty-cart">
                    <img src="empty_cart.png" alt="Cart is Empty" class="empty-cart-image"><br>
                    <button class="rent-now-button" onclick="window.location.href='index.php'">Rent Now</button>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script>
    const diamonds = <?php echo $diamonds; ?>;
    const subtotal = <?php echo $total; ?>;
    let totalElement = document.getElementById('total');
    let subtotalElement = document.getElementById('subtotal');
    let checkoutButton = document.getElementById('checkoutButton'); // Add an ID to your checkout button element

    function applyDiamondsDiscount() {
        let useDiamondsCheckbox = document.getElementById('useDiamonds');
        let diamondsParagraph = document.getElementById('diamondsParagraph');
        let horizontal_line = document.getElementById('hr');

        if (useDiamondsCheckbox.checked) {
            horizontal_line.style.display = 'block';
            diamondsParagraph.style.display = 'block';
            let discountedTotal = subtotal - diamonds;
            if (discountedTotal < 0) discountedTotal = 0;
            totalElement.innerHTML = discountedTotal + " RS";
        } else {
            horizontal_line.style.display = 'none';
            diamondsParagraph.style.display = 'none';
            totalElement.innerHTML = subtotal + " RS";
        }
    }

    function checkStockAndProceed() {
        let outOfStockItems = document.querySelectorAll('.box.out-of-stock');
        if (outOfStockItems.length > 0) {
            // Disable checkout button if any item is out of stock
            checkoutButton.disabled = true;
            alert('Some items in your cart are out of stock. Please remove them before proceeding.');
        } else {
            // Enable checkout button if all items are in stock
            checkoutButton.disabled = false;
            proceedToCheckout(); // Optionally proceed to checkout if all conditions are met
        }
    }

    function proceedToCheckout() {
        let useDiamondsCheckbox = document.getElementById('useDiamonds');
        let checkoutUrl = "<?php echo $isLoggedIn ? 'payment.php' : '../login.php'; ?>";

        // If the checkbox is checked, send the diamond usage info
        if (useDiamondsCheckbox.checked) {
            checkoutUrl += "?useDiamonds=true";
        }

        window.location.href = checkoutUrl;
    }
</script>

</body>
</html>
