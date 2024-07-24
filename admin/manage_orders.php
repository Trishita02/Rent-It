<?php
require('connection.php');
if($_SESSION['Admin_username']==''){
    header('location:login.php');
    die();
}

if(isset($_GET['order_id'])) $order_id=$_GET['order_id'];
$sql="select * from `my_orders` where order_id='$order_id'";
$res=mysqli_query($con,$sql);
$order_status_query = mysqli_query($con, "SELECT order_status FROM my_orders WHERE order_id='$order_id' LIMIT 1");
$order_status_result = mysqli_fetch_assoc($order_status_query);
$order_status=$order_status_result['order_status'];

if(isset($_POST['order_status'])){
    $update_order_status=$_POST['order_status'];
    mysqli_query($con,"UPDATE `my_orders` set order_status='$update_order_status' where order_id='$order_id'");
    header('location: manage_orders.php?order_id=' . $order_id);

}
$price_query=mysqli_query($con,"SELECT SUM(amount) as total_price from payment");
$price_fetch=mysqli_fetch_assoc($price_query);
$price=$price_fetch['total_price'];
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/x-icon" href="images/logo.jpeg">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>
                  <li class="menu-item-has-children dropdown">
                     <a href="product.php" > Products</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="orders.php" > Orders</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="donations.php"> Donations</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="feedback.php"> Feedback</a>
                  </li>
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="product.php"><img src="images/logo.jpeg" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa-solid fa-caret-down"></i>&nbsp;&nbsp;Welcome <?php echo $_SESSION['Admin_username'];?></a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        <a class="nav-link" href="#"><i class="fa-solid fa-money-bill-trend-up"></i>Total revenue :<br><?php echo $price;?> RS</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h3><u><b>Order Details </b></u></h3><br>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>Product_ID</th>
                                       <th>Product Name</th>
                                       <th>Image</th>
                                       <th>Size</th>
                                       <th>Category</th>
                                       <th>Price</th>
                                       <th>Quantity</th>
                                       <th>Duration</th>
                                       <th>Total Price</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php 
                                 while($row=mysqli_fetch_assoc($res)){
                                    $product_id=$row['product_id'];
                                    $product_query = mysqli_query($con, "SELECT * FROM product WHERE id='$product_id'");
                                    $product_result = mysqli_fetch_assoc($product_query);
                                    ?>
							            <tr>
							            <td><?php echo $product_result['id']?></td>
							            <td><?php echo $product_result['name']?></td>
							            <td><img src="<?php echo 'product_img/'.$product_result['image1'];?>"/></td>
							            <td><?php echo $product_result['size']?></td>
							            <td><?php echo $product_result['category']?></td>
							            <td><?php echo $product_result['price']?> RS/day</td>
                                        <td><?php echo $row['quantity']?></td>
                                        <td><?php echo $row['duration']?> days</td>
                                        <td><?php echo $product_result['price']*$row['quantity']*$row['duration']?> RS</td>
							         </tr>
							      <?php } ?>
                                 </tbody>
                              </table>
                              <div>
                                <br><br>
                                <strong> &nbsp; &nbsp; Order status : </strong>
                                <?php  echo $order_status;?>
                              </div>
                              <div>
                              <br>
                                <form method="post">
                                &nbsp; &nbsp;
                                    <select  name="order_status">
                                    <option disabled selected>Select Order Status</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Out for Delivery">Out for Delivery</option>
                                    <option value="Delivered">Delivered</option>
                                    </select>
                                    <input type="submit">
                                </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <div class="clearfix"></div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>