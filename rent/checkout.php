<?php
require('..\admin\connection.php');
$amount = 0;
if (isset($_SESSION['login_id'])) {
    $email = $_SESSION['login_id'];
    $result = mysqli_query($con, "SELECT SUM(price) AS total_price FROM cart WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);
    $amount = $row['total_price'];
    if (isset($_GET['useDiamonds'])) {
        if ($_SESSION['user_type'] == "normal") {
            $user_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT diamonds FROM `new user` WHERE Email='$email'"));
        } else if ($_SESSION['user_type'] == "gmail") {
            $user_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT diamonds FROM `google users` WHERE email='$email'"));
        }
        $diamonds = $user_data['diamonds'];
        if ($diamonds > $amount) {
            $amount = 0;
        } else {
            $amount = $amount - $diamonds;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = uniqid();
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $altPhone = $_POST['altPhone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $landmark = $_POST['landmark'];
    $amount = $_POST['amount'];
    date_default_timezone_set('Asia/Kolkata');
    $added_on = date('Y-m-d h:i:s');

    $stmt = $con->prepare("INSERT INTO `payment`(`order_id`, `Name`, `Phoneno`, `AltPno`, `Email`, `Address`, `Pincode`, `City`, `Landmark`, `amount`, `payment_mode`, `payment_status`, `payment_id`, `added_on`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'offline', 'complete', '', ?)");
    $stmt->bind_param("ssssssssiss", $order_id, $name, $phone, $altPhone, $email, $address, $pincode, $city, $landmark, $amount, $added_on);

    if ($stmt->execute()) {
        $param = isset($_GET['useDiamonds']) ? "&useDiamonds=" . $_GET['useDiamonds'] : "";
        header("Location: thank_you.php?amount=$amount$param&order_id=$order_id");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details & Billing</title>
    <link rel="icon" type="image/x-icon" href="finalogo.jpeg">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Premium font style */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #088169, #088198); /* Gradient background */
        }

        .container {
            display: flex;
            flex-direction: row;
            max-width: 1000px; /* Increased width */
            width: 95%;
            height: 20%; /* Reduced height */
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.3s;
        }

        .container:hover {
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
        }

        .user-details {
            flex: 1;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 10px 0 0 10px;
        }

        .billing-details {
            flex: 1;
            padding: 10px;
            background-color: #e0e0e0;
            border-radius: 0 10px 10px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            background-image: url('payment.avif'); /* Background image */
            background-size: cover; /* Ensure background image covers the entire area */
            background-position: center; /* Center the background image */
            color: #333; /* Text color */
            overflow: hidden;
        }

        .billing-details::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255,0.6); /* Semi-transparent white overlay */
            z-index: 1;
        }

        .billing-details h2,
        .billing-amount,
        .pay-now-btn {
            position: relative;
            z-index: 2;
        }

        .billing-amount {
            margin-bottom: 10px;
            font-size: 26px;
            padding:10px;
            color: #333;
            text-align: center;
        }

        .pay-now-btn {
            padding: 12px 32px; /* Increased padding */
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .pay-now-btn:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 8px; 
        }

        label {
            display: block;
            margin-bottom: 3px;
            color: #333;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            width: calc(100% - 20px);
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            transition: border-color 0.3s;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        textarea:focus {
            outline: none;
            border-color: #4caf50;
        }
        .require{
            color:red;
            font-weight: bolder;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="user-details">
            <h2>User Details</h2>
            <form method="post" id="paymentForm"> 
            <div class="form-group">
                <label for="name">Name <span class="require">*</span></label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number <span class="require">*</span></label>
                <input type="tel" id="phone" name="phone" required maxlength="10">
            </div>
            <div class="form-group">
                <label for="altPhone">Alternative Phone Number <span> (optional)</span></label>
                <input type="tel" id="altPhone" name="altPhone" maxlength="10">
            </div>
            <div class="form-group">
                <label for="email">Email <span class="require">*</span></label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address <span class="require">*</span></label>
                <textarea id="address" name="address" rows="3" required style="resize:none;"></textarea>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode <span class="require">*</span></label>
                <input type="text" id="pincode" name="pincode" required>
            </div>
            <div class="form-group">
                <label for="city">City <span class="require">*</span></label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="landmark">Landmark <span> (optional)</span></label>
                <input type="text" id="landmark" name="landmark">
            </div>
        </div>
        <div class="billing-details">
            <h2>Amount to pay</h2>
            <div class="billing-amount">&#x20B9; <?php echo $amount;?> </div>
             <?php if($amount == 0 && !isset($_GET['useDiamonds'])): ?>
                <input type="button" class="pay-now-btn" value="Pay Now" style="cursor:pointer" onclick="pay_now_alert()">
            <?php elseif($amount == 0 && isset($_GET['useDiamonds'])): ?>
            <?php else: ?>
                <input type="button" class="pay-now-btn" value="Pay Now" style="cursor:pointer" onclick="pay_now()">
                <?php endif; if ($amount == 0 && isset($_GET['useDiamonds'])): ?>
                <h2></h2>
                <?php else: ?>
                <h2>OR</h2>
                <?php endif; ?>
            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
            <input type="button" class="pay-now-btn" value="Pay On Delivery" style="cursor:pointer" onclick="payOnDelivery()">
        </div>
    </form>
    </div>
</body>
</html>
<script>
    function pay_now_alert(){
        alert('Add an item to the cart');
        window.location.href = 'cart.php';
    }

    function payOnDelivery() {
        var name = document.getElementById('name').value.trim();
        var phone = document.getElementById('phone').value.trim();
        var altPhone = document.getElementById('altPhone').value.trim();
        var email = document.getElementById('email').value.trim();
        var address = document.getElementById('address').value.trim();
        var pincode = document.getElementById('pincode').value.trim();
        var city = document.getElementById('city').value.trim();
        var landmark = document.getElementById('landmark').value.trim();
        var amount = <?php echo $amount; ?>;
        
        <?php if ($amount == 0 && !isset($_GET['useDiamonds'])): ?>
            alert('Add an item to the cart');
            window.location.href = 'cart.php';
            return false;
            <?php endif; ?>

        if (name === '' || phone === '' || email === '' || address === '' || pincode === '' || city === '') {
            alert('Please fill in all required fields.');
            return false;
        }

        document.getElementById('paymentForm').submit();
    }
</script>
