<?php
require('..\admin\connection.php');

// Check if a search query is present
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'all';

// Modify SQL query based on search and sort parameters
$base_sql = "SELECT * FROM `product` WHERE category='Women' AND status=1";
if ($search_query) {
    $base_sql .= " AND keyword LIKE '%$search_query%'";
}

switch ($sort) {
    case 'most_rented':
        $sql = "$base_sql ORDER BY rent_count DESC";
        break;
    case 'price_low_high':
        $sql = "$base_sql ORDER BY price ASC";
        break;
    case 'price_high_low':
        $sql = "$base_sql ORDER BY price DESC";
        break;
    case 'newest_oldest':
        $sql = "$base_sql ORDER BY id DESC";
        break;
    case 'oldest_newest':
        $sql = "$base_sql ORDER BY id ASC";
        break;
    default:
        $sql = $base_sql;
        break;
}

$result = mysqli_query($con, $sql);

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
    <title>Women's Section</title>
    <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../user-dropdown.css">
</head>
<style>
.header-container {
    display: flex;
    align-items: center;
}

.search-box {
    width: fit-content;
    height: fit-content;
    position: relative;
    display: inline-block;
    margin-left: 20px;
}

.input-search {
    height: 50px;
    width: 50px;
    border-style: none;
    padding: 10px;
    font-size: 18px;
    letter-spacing: 2px;
    outline: none;
    border-radius: 25px;
    transition: all .5s ease-in-out;
    background-color: #86dbe3;
    padding-right: 40px;
    color: black;
}

.input-search::placeholder {
    color: black;
    font-size: 18px;
    letter-spacing: 2px;
    font-weight: 100;
}

.btn-search {
    width: 50px;
    height: 50px;
    border-style: none;
    font-size: 20px;
    font-weight: bold;
    outline: none;
    cursor: pointer;
    border-radius: 50%;
    position: absolute;
    right: 0px;
    color: black;
    background-color: transparent;
    pointer-events: painted;
}

.btn-search:focus ~ .input-search {
    width: 300px;
    border-radius: 0px;
    background-color: transparent;
    border-bottom: 1px solid rgba(76, 73, 73, 0.5);
    transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}

.input-search:focus {
    width: 300px;
    border-radius: 0px;
    background-color: transparent;
    border-bottom: 1px solid rgba(76, 73, 73, 0.5);
    transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}
</style>
<body>
    <section id="header">
    <div class="header-container">
        <a href="index.php"><img src="finalogo.jpeg" class="logo" alt=""></a>
        <form action="women.php" method="get" class="search-box">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
            <input type="text" name="search" class="input-search" placeholder="Type to Search..." value="<?php echo htmlspecialchars($search_query); ?>">
        </form>
    </div>
            <ul id="navbar">
                <li><a  href="index.php">HOME</a></li> 
                <li><a  href="men.php">MENS WEAR</a></li>
                <li><a class="active" href="women.php">WOMENS WEAR</a></li>
                
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
    <section id="hero2" class="women-hero">
    
        <div class="women">
        <h4>Womens Wear On Rent</h4>
        <h1>STYLE <br>IS A CHOICE</h1>
        <p>Make Yours</p>
        </div>
        
    </section>

    <section id="feat">
        <div class="text">
            <p>Clothes For Looking Gorgeous</p>
        </div>
        <div class="sort">
            <p style="color:#088178;"><b>Sort By:</b></p>
            <select onchange="sortProducts(this.value)">
                <option value="all" <?php if($sort == 'all') echo 'selected'; ?>>All</option>
                <option value="most_rented" <?php if($sort == 'most_rented') echo 'selected'; ?>>Most Rented</option>
                <option value="price_low_high" <?php if($sort == 'price_low_high') echo 'selected'; ?>>Price: Low to High</option>
                <option value="price_high_low" <?php if($sort == 'price_high_low') echo 'selected'; ?>>Price: High to Low</option>
                <option value="newest_oldest" <?php if($sort == 'newest_oldest') echo 'selected'; ?>>Newest to Oldest</option>
                <option value="oldest_newest" <?php if($sort == 'oldest_newest') echo 'selected'; ?>>Oldest to Newest</option>
            </select>  
        </div>

    </section>

    <section id="product1" class="section-p1">
        <h2>WOMENS WEAR</h2>
        <p>New Morden Design</p>
        <div class="pro-container">
        <?php
            while($row=mysqli_fetch_assoc($result)){ ?>
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
                    </div><br>
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
    <script>
function sortProducts(option) {
    var searchQuery = '<?php echo htmlspecialchars($search_query); ?>';
    var newUrl = 'women.php?sort=' + option + '&search=' + searchQuery;
    window.location.href = newUrl;
}
</script>
</body>
</html>
