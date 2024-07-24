<?php
require('connection.php');
if($_SESSION['Admin_username']==''){
    header('location:login.php');
    die();
}

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=mysqli_real_escape_string($con,$_GET['type']);
	if($type=='status'){
		$operation=mysqli_real_escape_string($con,$_GET['operation']);
		$id=mysqli_real_escape_string($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update product set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=mysqli_real_escape_string($con,$_GET['id']);
		$delete_sql="delete from product where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select * from product";
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
            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa-solid fa-caret-down"></i>&nbsp;&nbsp;Welcome <?php echo $_SESSION['Admin_username'];?>
            </a>
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
                           <h3><u><b>Products </b></u></h3><br>
                           <h5 class="box-link"><a href="manage_product.php">Add Products</a><h5>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Product Name</th>
                                       <th>Image</th>
                                       <th>Size</th>
                                       <th>Category</th>
                                       <th>Price</th>
                                       <th>Quantity</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php 
                                 while($row=mysqli_fetch_assoc($res)){?>
							            <tr>
							            <td><?php echo $row['id']?></td>
							            <td><?php echo $row['name']?></td>
							            <td><img src="<?php echo 'product_img/'.$row['image1'];?>"/></td>
							            <td><?php echo $row['size']?></td>
							            <td><?php echo $row['category']?></td>
							            <td><?php echo $row['price']?> RS</td>
                                 <td><?php echo $row['quantity']?></td>
							            <td>
								         <?php
								         if($row['status']==1){
									      echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								         }else{
									      echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								         }
								         echo "<span class='badge badge-edit' style='background:rgb(179, 169, 193);'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>&nbsp;";	
								         echo "<span class='badge badge-delete'  style='background:rgb(226, 41, 2);'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								         ?>
							            </td>
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
         <div class="clearfix"></div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>