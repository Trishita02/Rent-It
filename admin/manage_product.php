<?php
require('connection.php');
if($_SESSION['Admin_username']==''){
    header('location:login.php');
    die();
}

$name='';
$category='';
$price='';
$quantity='';
$size='';
$image1=''; $image2=''; $image3='';$image4='';
$description='';
$title='';
$keyword='';

$msg='';
$image_required='required';
$price_query=mysqli_query($con,"SELECT SUM(amount) as total_price from payment");
$price_fetch=mysqli_fetch_assoc($price_query);
$price=$price_fetch['total_price'];
if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required='';
    $id=mysqli_real_escape_string($con,$_GET['id']);
    $res=mysqli_query($con,"select * from product where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $category=$row['category'];
        $price=$row['price'];
        $quantity=$row['quantity'];
        $size=$row['size'];
        $description=$row['description'];
        $title=$row['title'];
        $keyword=$row['keyword'];
    }else{
        header('location:product.php');
        die();
    }
}

if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $category=mysqli_real_escape_string($con,$_POST['category']);
    $price=mysqli_real_escape_string($con,$_POST['price']);
    $quantity=mysqli_real_escape_string($con,$_POST['quantity']);
    $size=mysqli_real_escape_string($con,$_POST['size']);
    $description=mysqli_real_escape_string($con,$_POST['description']);
    $title=mysqli_real_escape_string($con,$_POST['title']);
    $keyword=mysqli_real_escape_string($con,$_POST['keyword']);
    
    if($_GET['id']==0){
        if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
            $msg="Please select only png,jpg and jpeg image formate";
        }
    }else{
        if($_FILES['image']['type']!=''){
            if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
                $msg="Please select only png,jpg and jpeg image formate";
            }
        }
    }
    
    if(isset($_GET['id']) && $_GET['id']!=''){
        if($_FILES['image']['name']!=''){
            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],'product_img/'.$image);
            $update_sql="update product set name='$name',category='$category',price='$price',quantity='$quantity',size='$size',description='$description',title='$title',keyword='$keyword',image1='$image' where id='$id'";
            mysqli_query($con,$update_sql);
        }
        if($_FILES['image2']['name']!=''){
            $image2=rand(111111111,999999999).'_'.$_FILES['image2']['name'];
            move_uploaded_file($_FILES['image2']['tmp_name'],'product_img/'.$image2);
            $update_sql="update product set image2='$image2' where id='$id'";
            mysqli_query($con,$update_sql);
        }
        if($_FILES['image3']['name']!=''){
            $image3=rand(111111111,999999999).'_'.$_FILES['image3']['name'];
            move_uploaded_file($_FILES['image3']['tmp_name'],'product_img/'.$image3);
            $update_sql="update product set image3='$image3' where id='$id'";
            mysqli_query($con,$update_sql);
        }
        if($_FILES['image4']['name']!=''){
            $image4=rand(111111111,999999999).'_'.$_FILES['image4']['name'];
            move_uploaded_file($_FILES['image4']['tmp_name'],'product_img/'.$image4);
            $update_sql="update product set image4='$image4' where id='$id'";
            mysqli_query($con,$update_sql);
        }
        if($_FILES['image']['name']==''&&$_FILES['image2']['name']==''&&$_FILES['image3']['name']==''&& $_FILES['image4']['name']==''){
            $update_sql="update product set name='$name',category='$category',price='$price',quantity='$quantity',size='$size',description='$description',title='$title',keyword='$keyword' where id='$id'";
            mysqli_query($con,$update_sql);
        }
    }
    else{
        $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'product_img/'.$image);
        $image2=rand(111111111,999999999).'_'.$_FILES['image2']['name'];
        move_uploaded_file($_FILES['image2']['tmp_name'],'product_img/'.$image2);
        $image3=rand(111111111,999999999).'_'.$_FILES['image3']['name'];
        move_uploaded_file($_FILES['image3']['tmp_name'],'product_img/'.$image3);
        $image4=rand(111111111,999999999).'_'.$_FILES['image4']['name'];
        move_uploaded_file($_FILES['image4']['tmp_name'],'product_img/'.$image4);
        mysqli_query($con,"insert into product(name,category,price,quantity,image1,image2,image3,image4,size,description,title,status,keyword) values('$name','$category','$price','$quantity','$image','$image2','$image3','$image4','$size','$description','$title',1,'$keyword')");
    }
    header('location:product.php');
    die();
    }

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
                     <a href="Product.php" > Products</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="orders.php" > Orders</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="donations.php"> Donations</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="feedback.php" > Feedback</a>
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
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Add a Product</strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="category" class=" form-control-label">Category :</label>
									<select class="form-control" name="category" id="category">
									<option disabled selected>Select Category</option>
        							<option value="Men" <?php if(isset($category) && $category == 'Men') echo 'selected'; ?>>Men</option>
        							<option value="Women" <?php if(isset($category) && $category == 'Women') echo 'selected'; ?>>Women</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name" class=" form-control-label">Product Name :</label>
									<input type="text" id="name" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
								</div>
								
								<div class="form-group">
									<label for="price" class=" form-control-label">Price (INR) :</label>
									<input type="text" id="price" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
								</div>
								
								<div class="form-group">
									<label for="quantity" class=" form-control-label">Quantity :</label>
									<input type="text" id="quantity" name="quantity" placeholder="Enter Quantity" class="form-control" required value="<?php echo $quantity?>">
								</div>
								
								<div class="form-group">
									<label for="image" class=" form-control-label">Images :</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
									<input type="file" name="image2" class="form-control" <?php echo  $image_required?>>
									<input type="file" name="image3" class="form-control" <?php echo  $image_required?>>
									<input type="file" name="image4" class="form-control" <?php echo  $image_required?>>
								</div>
								
								<div class="form-group">
									<label for="size" class=" form-control-label">Size :</label>
									<select id="size" class="form-control" name="size">
									<option disabled selected>Select Size</option>
        							<option value="Free" <?php if(isset($size) && $size == 'Free') echo 'selected'; ?>>Free</option>
        							<option value="XS" <?php if(isset($size) && $size == 'XS') echo 'selected'; ?>>XS</option>
        							<option value="S" <?php if(isset($size) && $size == 'S') echo 'selected'; ?>>S</option>
        							<option value="M" <?php if(isset($size) && $size == 'M') echo 'selected'; ?>>M</option>
       								<option value="L" <?php if(isset($size) && $size == 'L') echo 'selected'; ?>>L</option>
        							<option value="XL" <?php if(isset($size) && $size == 'XL') echo 'selected'; ?>>XL</option>
        							<option value="XXL" <?php if(isset($size) && $size == 'XXL') echo 'selected'; ?>>XXL</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for="title" class=" form-control-label">Title :</label>
									<textarea id="title" name="title" placeholder="Enter product title" class="form-control"><?php echo $title?></textarea>
								</div>

								<div class="form-group">
									<label for="description" class=" form-control-label">Description :</label>
									<textarea id="description" name="description" placeholder="Enter product description" class="form-control" required><?php echo $description?></textarea>
								</div>
								
								<div class="form-group">
									<label for="keyword" class=" form-control-label">Keyword :</label>
									<textarea id="keyword" name="keyword" placeholder="Enter product keyword" class="form-control"><?php echo $keyword?></textarea>
								</div>
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
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
		