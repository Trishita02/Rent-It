<?php
require('connection.php');
if($_SESSION['Admin_username']==''){
   header('location:login.php');
   die();
}
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=mysqli_real_escape_string($con,$_GET['type']);
	if($type=='delete'){
		$id=mysqli_real_escape_string($con,$_GET['id']);
		$delete_sql="delete from `my_orders` where order_id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="SELECT DISTINCT order_id,order_date,order_status FROM `my_orders` ORDER BY order_date DESC";
$res=mysqli_query($con,$sql);
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
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-caret-down"></i>&nbsp;&nbsp;Welcome <?php echo $_SESSION['Admin_username'];?></a>
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
				   <h4 class="box-title">Orders</h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th>ORDER_ID</th>
							   <th>ORDER_DATE</th>
							   <th>ADDRESS</th>
                               <th>PHONE NO</th>
							   <th>PAYMENT_MODE</th>
                               <th>TOTAL_AMOUNT</th>
							   <th>ORDER_STATUS</th>
                        <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							while($row=mysqli_fetch_assoc($res)){
                                $order_id=$row['order_id'];
                                $price_query = mysqli_query($con, "SELECT SUM(price) AS total_price FROM my_orders WHERE order_id='$order_id'");
                                $price_result = mysqli_fetch_assoc($price_query);
                                $total_price = $price_result['total_price'];

                                $details=mysqli_query($con,"Select Address,City,Pincode,Phoneno,payment_mode from payment where order_id='$order_id'");
                                $details_result=mysqli_fetch_assoc($details);
                                $address=$details_result['Address'];
                                $city=$details_result['City'];
                                $pincode=$details_result['Pincode'];
                                $phone=$details_result['Phoneno'];
                                $payment_mode=$details_result['payment_mode'];
                            
                            ?>
							<tr>
							   <td><a href="manage_orders.php?order_id=<?php echo $order_id?>"><b><?php echo $order_id;?></b></a></td>
							   <td><?php echo $row['order_date']; ?></td>
							   <td><?php echo $address." , ".$city." , Pincode-".$pincode; ?></td>
							   <td>+91 <?php echo $phone; ?></td>
                               <td><?php echo $payment_mode; ?></td>
                               <td><?php echo $total_price; ?> RS</td>
							   <td><?php echo $row['order_status']; ?></td>
                        <td><?php  echo "<span class='badge badge-delete'  style='background:rgb(226, 41, 2);'><a href='?type=delete&id=".$order_id."'>Delete</a></span>";?></td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>
