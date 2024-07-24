<?php
require('..\admin\connection.php');
if(!isset($_GET['amount'])||!isset($_GET['order_id'])) { header('location:cart.php'); exit(); }
$amount=$_GET['amount'];
$order_id=$_GET['order_id'];
$id=$_SESSION['login_id'];
$product="Select * from cart where email='$id'";
$result=mysqli_query($con,$product);
while($row=mysqli_fetch_assoc($result)){ 
  $quant=$row['quantity'];
  $pid=$row['product_id'];
  mysqli_query($con,"Update product set quantity=quantity-$quant where id='$pid'");
  mysqli_query($con,"Update product set rent_count=rent_count+$quant where id='$pid'");
}
if (!isset($_SESSION['diamonds'])) {
  $_SESSION['diamonds'] = rand(1, 50);
}
$diamonds = $_SESSION['diamonds'];
if($_SESSION['user_type'] == "normal" && $_SESSION['is_diamond']==0) {
  if(isset($_GET['useDiamonds'])){
    $user_diamonds=mysqli_fetch_assoc(mysqli_query($con, "SELECT diamonds FROM `new user` WHERE Email = '$id'"));
  if($user_diamonds['diamonds']<=$amount){
    mysqli_query($con, "UPDATE `new user` SET diamonds=0 WHERE Email = '$id'");
  }
  else{
    mysqli_query($con, "UPDATE `new user` SET diamonds=diamonds-$amount WHERE Email = '$id'");
  }
  }
  mysqli_query($con, "UPDATE `new user` SET diamonds = diamonds + $diamonds WHERE Email = '$id'");
  $_SESSION['is_diamond']=1;
} else if ($_SESSION['user_type'] == "gmail" &&  $_SESSION['is_diamond']==0) {
  if(isset($_GET['useDiamonds'])){
    $user_diamonds=mysqli_fetch_assoc(mysqli_query($con, "SELECT diamonds FROM `google users` WHERE email = '$id'"));
    if($user_diamonds['diamonds']<=$amount){
      mysqli_query($con, "UPDATE `google users` SET diamonds=0 WHERE email = '$id'");
    }
    else{
      mysqli_query($con, "UPDATE `google users` SET diamonds=diamonds-$amount WHERE email = '$id'");
    }
    }
  mysqli_query($con, "UPDATE `google users` SET diamonds = diamonds + $diamonds WHERE email = '$id'");
  $_SESSION['is_diamond']=1;
}

$order_date=date('Y-m-d');
$my_order_query = mysqli_query($con, "INSERT INTO my_orders(order_id, product_id, email, price, quantity, duration,order_date,order_status,rewards)
          SELECT '$order_id', product_id, email, price, quantity, duration,'$order_date','order confirmed','$diamonds' FROM cart WHERE email = '$id'");
$sql="Delete from cart where email='$id'";
mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You</title>
  <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
  <link rel="stylesheet" href="styles.css">
  <!-- Your other stylesheets -->
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f5f5f5;
    }

    .container {
      display: flex; /* Use flexbox */
      width: 70%; /* Adjust width as needed */
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .left {
      flex: 1; /* Occupy left part */
      padding: 40px;
      display: flex; /* Use flexbox */
      flex-direction: column; /* Align items vertically */
      justify-content: center; /* Center items vertically */
      align-items: center; /* Center items horizontally */
    }

    .right {
      flex: 1; /* Occupy right part */
      padding: 40px;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column; /* Align items vertically */
    }

    .icon img {
      width: 150px; /* Adjust size */
      height: auto;
      margin-bottom: 20px;
    }

    h1 {
      color: #333;
      font-size: 36px;
      margin-bottom: 20px;
    }

    p {
      color: #666;
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 10px;
    }

    .order-details {
      flex-grow: 1; /* Occupy remaining space */
    }

    .go-home-btn {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 20px;
    }

    .go-home-btn:hover {
      background-color: #45a049;
    }
    body {
    font-family: 'Arial', sans-serif;
}
.diamonds-line {
      display: flex;
      align-items: center;
      margin: 20px 0;
      font-size: 1.2em;
      font-family: 'Pacifico', cursive;
      white-space: nowrap; /* Prevent line breaks */
    }

    .diamonds-line img {
      max-width: 50px; /* Adjust size */
      height: auto;
    }
    @media screen and (max-width: 768px) {
      .container {
        width: 90%; /* Adjust width for smaller screens */
        flex-direction: column; /* Stack elements vertically */
      }
      .diamonds-line img {
        max-width: 40px; /* Adjust size for smaller screens */
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="icon">
        <img src="tick.png" alt="Green Tick">
      </div>
      <h1>Thank You!</h1>
      <p>Your order has been placed successfully</p>
      <p>Our delivery partner will reach you within 4 days</p>
    </div>
    <div class="right">
      <div class="order-details">
        <h2>Order Details</h2>
        <p>Total Price: &#x20B9;<?php echo $_GET['amount']?></p>
        <br><br><br>
        <div class="diamonds-line">
    You got <?php echo $diamonds; ?> diamonds<img src="diamond.avif" alt="Diamond" width="50" height="50">
</div>

      </div>
      <button class="go-home-btn" onclick="window.location.href='../home.php'">Go to Home Page</button>
    </div>
  </div>
</body>
</html>
