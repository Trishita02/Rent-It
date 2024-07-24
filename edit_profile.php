<?php
require('admin/connection.php');
if (!isset($_SESSION['login_id'])) {
    header('location:login.php');
    exit();
}

$user = $_SESSION['login_id'];
$image = $username = $gender = $email = $phone = $address1 = $address2 = $city = $state = $pincode = $new_password = $confirm_password = '';
$passw = $confirm_passw = '';

if ($_SESSION['user_type'] == "normal") {
    $user_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `new user` WHERE Email='$user'"));
    $name = $user_query['Username'];
    $gender = $user_query['gender'];
    $email = $user_query['Email'];
    $phone = $user_query['phone'];
    $address1 = $user_query['address1'];
    $address2 = $user_query['address2'];
    $city = $user_query['city'];
    $state = $user_query['state'];
    $pincode = $user_query['pincode'];
    $passw = $user_query['Password'];
    $confirm_passw = $user_query['Confirm_password'];
    $profile_image=$user_query['profile_image'];
    if($profile_image=='') $profile_image="noprofile.jpg";
}

if ($_SESSION['user_type'] == "gmail") {
    $user_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `google users` WHERE Email='$user'"));
    $name = $user_query['name'];
    $gender = $user_query['gender'];
    $email = $user_query['email'];
    $phone = $user_query['phone'];
    $address1 = $user_query['address1'];
    $address2 = $user_query['address2'];
    $city = $user_query['city'];
    $state = $user_query['state'];
    $pincode = $user_query['pincode'];
    $passw = password_hash($user_query['password'], PASSWORD_DEFAULT);
    $confirm_passw = password_hash($user_query['confirm_password'], PASSWORD_DEFAULT);
    $profile_image=$user_query['profile_image'];
}

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $gender = isset($_POST['Gender']) ? mysqli_real_escape_string($con, $_POST['Gender']) : '';
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address1 = mysqli_real_escape_string($con, $_POST['address1']);
    $address2 = mysqli_real_escape_string($con, $_POST['address2']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm-password']);

    
    // Check if any field is updated
    $isUpdated = false;

    if ($password == '' && $confirm_password == '') {
        $password = $passw;
        $confirm_password = $confirm_passw;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT);
    }

    if ($_SESSION['user_type'] == "normal") {
        $update_sql = "UPDATE `new user` SET ";
        $update_fields = [];

        if(isset($_FILES["image"]["name"])){
            $imageName = $_FILES["image"]["name"];
            $imageSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
      
            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)){
              echo
              "
              <script>
                alert('Invalid Image Extension');
              </script>
              ";
            }
            elseif ($imageSize > 1200000){
              echo
              "
              <script>
                alert('Image Size Is Too Large');
              </script>
              ";
            }
            else{
              $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
              $newImageName .= '.' . $imageExtension;
              $query = "UPDATE `new user` SET profile_image = '$newImageName' WHERE Email ='$user'";
              mysqli_query($con, $query);
              move_uploaded_file($tmpName, 'user_img/' . $newImageName);
              echo
              "
              <script>
              document.location.href = 'edit_profile.php';
              </script>
              ";
            }
        }
        if($newImageName!=$user_query['profile_image']){
            $isUpdated = true;
        }
        if ($name !== $user_query['Username']) {
            $update_fields[] = "Username='$name'";
            $isUpdated = true;
        }
        if ($gender !== $user_query['gender']) {
            $update_fields[] = "gender='$gender'";
            $isUpdated = true;
        }
        if ($email !== $user_query['Email']) {
            $update_fields[] = "Email='$email'";
            $isUpdated = true;
        }
        if ($phone !== $user_query['phone']) {
            $update_fields[] = "phone='$phone'";
            $isUpdated = true;
        }
        if ($address1 !== $user_query['address1']) {
            $update_fields[] = "address1='$address1'";
            $isUpdated = true;
        }
        if ($address2 !== $user_query['address2']) {
            $update_fields[] = "address2='$address2'";
            $isUpdated = true;
        }
        if ($city !== $user_query['city']) {
            $update_fields[] = "city='$city'";
            $isUpdated = true;
        }
        if ($state !== $user_query['state']) {
            $update_fields[] = "state='$state'";
            $isUpdated = true;
        }
        if ($pincode !== $user_query['pincode']) {
            $update_fields[] = "pincode='$pincode'";
            $isUpdated = true;
        }
        if ($password !== $passw) {
            $update_fields[] = "Password='$password'";
            $isUpdated = true;
        }
        if ($confirm_password !== $confirm_passw) {
            $update_fields[] = "Confirm_password='$confirm_password'";
            $isUpdated = true;
        }

        if ($isUpdated) {
            $update_sql .= implode(', ', $update_fields) . " WHERE Email='$user'";
            mysqli_query($con, $update_sql);
        }
    }

    if ($_SESSION['user_type'] == "gmail") {
        $update_sql = "UPDATE `google users` SET ";
        $update_fields = [];

        if(isset($_FILES["image"]["name"])){
            $imageName = $_FILES["image"]["name"];
            $imageSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
      
            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)){
              echo
              "
              <script>
                alert('Invalid Image Extension');
              </script>
              ";
            }
            elseif ($imageSize > 1200000){
              echo
              "
              <script>
                alert('Image Size Is Too Large');
              </script>
              ";
            }
            else{
              $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
              $newImageName .= '.' . $imageExtension;
              $query = "UPDATE `google users` SET profile_image = '$newImageName' WHERE Email ='$user'";
              mysqli_query($con, $query);
              move_uploaded_file($tmpName, 'user_img/' . $newImageName);
              echo
              "
              <script>
              document.location.href = 'edit_profile.php';
              </script>
              ";
            }
        }
        if($newImageName!=$user_query['profile_image']){
            $isUpdated = true;
        }

        if ($name !== $user_query['name']) {
            $update_fields[] = "name='$name'";
            $isUpdated = true;
        }
        if ($gender !== $user_query['gender']) {
            $update_fields[] = "gender='$gender'";
            $isUpdated = true;
        }
        if ($email !== $user_query['email']) {
            $update_fields[] = "email='$email'";
            $isUpdated = true;
        }
        if ($phone !== $user_query['phone']) {
            $update_fields[] = "phone='$phone'";
            $isUpdated = true;
        }
        if ($address1 !== $user_query['address1']) {
            $update_fields[] = "address1='$address1'";
            $isUpdated = true;
        }
        if ($address2 !== $user_query['address2']) {
            $update_fields[] = "address2='$address2'";
            $isUpdated = true;
        }
        if ($city !== $user_query['city']) {
            $update_fields[] = "city='$city'";
            $isUpdated = true;
        }
        if ($state !== $user_query['state']) {
            $update_fields[] = "state='$state'";
            $isUpdated = true;
        }
        if ($pincode !== $user_query['pincode']) {
            $update_fields[] = "pincode='$pincode'";
            $isUpdated = true;
        }
        if ($password !== $passw) {
            $update_fields[] = "password='$password'";
            $isUpdated = true;
        }
        if ($confirm_password !== $confirm_passw) {
            $update_fields[] = "confirm_password='$confirm_password'";
            $isUpdated = true;
        }

        if ($isUpdated) {
            $update_sql .= implode(', ', $update_fields) . " WHERE email='$user'";
            mysqli_query($con, $update_sql);
        }
    }

    if ($isUpdated) {
        echo '<script>alert("Profile updated successfully!");</script>';
    } else {
        echo '<script>alert("No changes were made to the profile.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="admin/images/logo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>User Profile Page</title>
</head>
 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: black;
            text-align: center;
        }

        .form-control-file:hover {
            background-color: #d0d3d4;
        } 

        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 14px;
            background-color: #ecf0f1;
            color: #2c3e50;
        } 

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #7fb069;
        }

        .input-icon .form-control {
            padding-left: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color:  #7fb069;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color:  #7fb069;
        }

        .mbr-section-btn {
            text-align: center;
            margin-top: 20px;
        }

        .message {
            text-align: center;
            font-size: 16px;
            color: #7fb069;
            margin-top: 10px;
        }

        .upload {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }

        .upload img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .round {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #7fb069;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
        }

        .round input[type="file"] {
            position: absolute;
            transform: scale(2);
            opacity: 0;
            cursor: pointer;
        }

        .flex-container {
            max-width: 92%;
            display: flex;
            gap: 45px;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .flex-item {
            flex: 1;
            width: 150px; 
        }

        @media (max-width: 768px) {
            .flex-item {
                flex: 1 1 calc(50% - 10px);
            }
        }

        @media (max-width: 480px) {
            .flex-item {
                flex: 1 1 100%;
            }
        }
    </style>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form method="post" enctype="multipart/form-data" name="update">
            <div class="upload">

            <?php
            if (strpos($profile_image, 'https://') === 0) {
            echo '<img src="'.$profile_image.'" id="profile-photo" onerror="this.src=\'user_img/noprofile.jpg\';">';
            } else {
            echo '<img src="user_img/'.$profile_image.'" id="profile-photo" onerror="this.src=\'user_img/noprofile.jpg\';">';
            }
            ?>

                <div class="round">
                    <input type="file" id="profile-upload" name="image">
                    <i class="fa fa-camera" style="color: #fff;"></i>
                </div>
            </div>
            <div class="form-group">
                <h2>Personal Info</h2>
                <div class="input-icon" style="margin-right: 30px;">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="First Name" class="form-control" value="<?php echo $name; ?>">
                </div>
                <div class="input-icon" style="margin-top: 10px; margin-right: 10px;">
                    <i class="fas fa-user"></i>
                    <select name="Gender" class="form-control">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male" <?php if($gender=="male") echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if($gender=="female") echo 'selected'; ?>>Female</option>
                        <option value="other" <?php if($gender=="other") echo 'selected'; ?>>Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <h2>Contact Info</h2>
                <div class="input-icon" style="margin-right: 30px;">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>">
                </div>
                <div class="input-icon" style="margin-top: 10px; margin-right: 30px;">
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="phone" placeholder="Phone" class="form-control" value="<?php echo $phone; ?>">
                </div>
                <div class="input-icon" style="margin-top: 10px; margin-right: 30px;">
                    <i class="fas fa-address-book"></i>
                    <input type="Address" name="address1" placeholder="Address Line 1" class="form-control" value="<?php echo $address1; ?>">
                </div>
                <div class="input-icon" style="margin-top: 10px; margin-right: 30px;">
                    <i class="fas fa-address-book"></i>
                    <input type="Address" name="address2" placeholder="Address Line 2" class="form-control"
                    value="<?php echo $address2; ?>">
                </div>
                <div class="flex-container">
                    <div class="input-icon flex-item">
                        <i class="fas fa-city"></i>
                        <input type="text" name="city" placeholder="City" class="form-control" value="<?php echo $city; ?>">
                    </div>
                    <div class="input-icon flex-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="state" placeholder="State" class="form-control" value="<?php echo $state; ?>">
                    </div>
                    <div class="input-icon flex-item">
                        <i class="fas fa-mail-bulk"></i>
                        <input type="text" name="pincode" placeholder="Pincode" class="form-control"value="<?php echo $pincode; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2>Reset Password</h2>
                <div class="input-icon" style="margin-right: 30px;">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="New Password" class="form-control">
                </div>
                <div class="input-icon" style="margin-top: 10px; margin-right: 30px;">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" class="form-control">
                </div>
            </div>
            <div class="mbr-section-btn">
                <button type="submit" class="btn" name="update" onclick="updatePassword()">Update</button>
            </div>
            <div class="message" id="message"></div><br><br>
            <div id="password-strength"></div>
        </form>
    </div>
    <script>
        function uploadPhoto() {
            alert('Photo uploaded!');
        }

        const form = document.querySelector('form');

form.addEventListener('submit', function(event) {
    const password = document.querySelector('input[name="password"]');
    const confirmPassword = document.querySelector('input[name="confirm-password"]');
    if (password.value !== confirmPassword.value) {
        message.textContent = 'Passwords do not match. Please try again.';
        message.style.color = 'red';
        event.preventDefault();
        return;
    }
    else if(password.value!=''&&confirmPassword.value!=''&&password.value== confirmPassword.value){
        message.textContent = 'Your password have been updated successfully!';
        message.style.color = 'green';
        event.preventDefault();
        document.getElementById('password').value='';
        document.getElementById('confirm-password').value='';
        return;
    }
});
const submitButton = document.querySelector('button[type="submit"]');

// Bind event listener to password input field
const passwordInput = document.getElementById('password');
const passwordStrengthDiv = document.getElementById('password-strength');

passwordInput.addEventListener('input', function() {
const password = passwordInput.value;
const strength = calculatePasswordStrength(password);

// Update the UI to reflect password strength
passwordStrengthDiv.textContent = 'Password Strength: ' + strength;
passwordStrengthDiv.style.color = strength === 'strong' ? 'green' : (strength === 'moderate' ? 'orange' : 'red');
});

// Function to calculate password strength
function calculatePasswordStrength(password) {
// Define regular expressions to match lowercase letters, uppercase letters, numbers, and symbols
const lowerCaseRegex = /[a-z]/;
const upperCaseRegex = /[A-Z]/;
const numberRegex = /[0-9]/;
const symbolRegex = /[^a-zA-Z0-9]/;

// Initialize variables to track the presence of different types of characters
let hasLowerCase = lowerCaseRegex.test(password);
let hasUpperCase = upperCaseRegex.test(password);
let hasNumber = numberRegex.test(password);
let hasSymbol = symbolRegex.test(password);

// Calculate the password strength based on the presence of different types of characters
let strength = 0;
if (hasLowerCase) strength++;
if (hasUpperCase) strength++;
if (hasNumber) strength++;
if (hasSymbol) strength++;
submitButton.disabled = strength !== 4; // Check if all four types of characters are present
// Determine the strength label based on the calculated strength
if (password.length < 6) {
    return 'weak';
} else if (password.length < 10) {
    if (strength >= 3) {
        return 'moderate';
    } else {
        return 'weak';
    }
} else {
    if (strength === 4) {
        return 'strong';
    } else if (strength >= 2) {
        return 'moderate';
    } else {
        return 'weak';
    }
}
}
        document.getElementById('profile-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profile-photo').src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
