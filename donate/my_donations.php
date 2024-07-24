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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Donations</title>
    <link rel="icon" type="image/x-icon" href="../admin/images/logo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="my_donations.css">
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
  
    <br>
    <h2 id="heading">Your Donations <i class="fas fa-hand-holding-heart"></i></h2><hr><br><br>
    

    <div class="wrapper">
		<div class="project">
			<div class="shop">
                    <?php
                    $result=mysqli_query($con,"SELECT * FROM `donate` where email='$email' ORDER BY date DESC");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { 
                        ?>
				<div class="box" onclick="window.location.href='my_donations_details.php?donation_id=<?php echo $row['donate_id'];?>';"
                style="cursor:pointer;">
					<div class="content">
						<h3>Name : <?php echo $row['name']; ?></h3>
                        <p class="size">Donated on : <?php echo $row['date']; ?></p>
                        <p>Phone no : <?php echo $row['phone']; ?></p>
                        <p>Address : <?php echo $row['address']; ?></p>
						<h4>Category : <?php echo  $row['category']; ?></h4>
                        <h4> Donated Items : <?php echo $row['no_of_clothes']; ?></h4>
					</div>
				</div>
                <?php } ?>
                </div>
			</div>
                <?php } else {?>
                    <div class="empty-wishlist">
                        <img src="no_donation.png" alt="Donation list is Empty" class="empty-wishlist-image"><br>
                        <h2>No Donations yet :( </h2>
                    </div>
            <?php } ?>
		</div>
	</div>
</body>
</html>
</body>
