<?php
require('..\admin\connection.php');
if(isset($_SESSION['login_id'])){
$email=$_SESSION['login_id'];
}
else{
    header('location:../login.php');
    exit();
}
$donation_id=$_GET['donation_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Details</title>
    <link rel="icon" type="image/x-icon" href="../admin/images/logo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="my_donations_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
<br>
<h2 id="heading">Your Donated Clothes <i class="fa-solid fa-shirt"></i></h2><hr><br><br>
<main>
    <?php
     $result = mysqli_query($con, "SELECT image FROM `donate_images` WHERE donate_id='$donation_id'");
         while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class = "card">
    <img src="<?php echo 'donated_clothes/'.$row['image']; ?>" alt="">
    </div>
    <?php } ?>
</main>
</body>
</html>