<?php
require('..\admin\connection.php');
// Extracting POST data
$name=$_POST['name'];
$phone=$_POST['phone'];
$altphone=$_POST['altPhone'];
$email=$_POST['email'];
$address=$_POST['address'];
$pincode=$_POST['pincode'];
$city=$_POST['city'];
$landmark=$_POST['landmark'];
$amount=$_POST['amount'];
$payment_status="pending";
$added_on=date('Y-m-d h:i:s');
$order_id = $_POST['order_id'];

// Check if there is no pending payment for the same email
$query = "SELECT COUNT(*) as count FROM payment WHERE Email='$email' AND payment_status='pending'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// Insert new payment only if no pending payment for the same email exists
if($count == 0) {
    mysqli_query($con,"INSERT INTO `payment`(`Name`, `Phoneno`, `AltPno`, `Email`, `Address`, `Pincode`, `City`, `Landmark`, `amount`,`payment_mode`, `payment_status`, `added_on`) VALUES ('$name','$phone','$altphone','$email','$address','$pincode','$city','$landmark','$amount','online','$payment_status','$added_on')");
}

if(isset($_POST['payment_id'])){
    $payment_id=$_POST['payment_id'];
    mysqli_query($con,"UPDATE payment SET payment_status='complete', payment_id='$payment_id',order_id='$order_id' WHERE payment_id='' AND Email='$email'");
}
?>
