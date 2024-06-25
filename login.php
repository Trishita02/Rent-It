<?php
$showAlert = false;
$invalid=false;
$login=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $_SESSION['login']=false;
    $login=false;
    $server = "localhost";
    $user = "root";
    $password = ""  ;
    $database = "cloth donation and rental";
    $conn = mysqli_connect($server, $user, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST['signup'])){ 
    //signup
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passw = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cpassw = password_hash($_POST['cpassword'], PASSWORD_DEFAULT);
    $check_email = "SELECT * FROM `new user` WHERE `Email`='$email'";
    $check_email_result = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($check_email_result) > 0) {
        $showAlert = true;
    } else {
        $sql = "INSERT INTO `new user`(`Username`, `Email`, `Password`, `Confirm_password`) VALUES ('$username','$email','$passw','$cpassw')";
        if (mysqli_query($conn, $sql)) {
            header("Location:home.php");
            exit();
        } else {
            header("Location:error.html");
        }
    }
}
    if(isset($_POST['login'])){ 
    //login
    $login = false;
    $email_login = $_POST['lemail'];
    $password_login = $_POST['lpassword']; // Get the password entered by the user
    $result1 = mysqli_query($conn, "SELECT * FROM `new user` WHERE Email='$email_login'");
    if($result1 && mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
    $hashed_password = $row['Password'];
    if(password_verify($password_login, $hashed_password)) {
        $login = true;
        $_SESSION['login']=true;
        $_SESSION['email']=$email_login;
        header("Location:home.php");
        exit(); 
    }
    }
    $invalid = true;
    }
    mysqli_close($conn);
}
//signup with google
if(isset($_SESSION['login_id'])){
    require 'config.php';
    $_SESSION['login']=true;
    header('Location: home.php');
    exit;
}

require 'google-api/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('908346786623-01cebfl2amcq4guu4ltg11fhddoj5uag.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/online-cloth-and-rental/login.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    require 'config.php';
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);

        // checking user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT `google_id` FROM `google users` WHERE `google_id`='$id'");
        if(mysqli_num_rows($get_user) > 0){
            $_SESSION['login_id'] = $id; 
            $login=true;
            $_SESSION['login']=true;
            header('Location: home.php');
            exit;

        }
        else{

            // if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `google users`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");

            if($insert){
                $_SESSION['login_id'] = $id; 
                $login=true;
                $_SESSION['login']=true;
                header('Location: home.php');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }

        }
    }
    else{
        header('Location: login.php');
        exit;
    }
else: 
    // Google Login Url = $client->createAuthUrl(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RentIt</title>
	<style>
		:root {
    --primary-color: #088178;
    --secondary-color: #088178;
    --black: #000000;
    --white: #ffffff;
    --gray: #efefef;
    --gray-2: #757575;

    --facebook-color: #4267B2;
    --google-color: #DB4437;
    --twitter-color: #1DA1F2;
    --insta-color: #E1306C;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

* {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html,
body {
    height: 100vh;
    overflow: hidden;
}

.container {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
}

.row {
    display: flex;
    flex-wrap: wrap;
    height: 100vh;
}

.col {
    width: 50%;
}

.align-items-center {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.form-wrapper {
    width: 100%;
    max-width: 28rem;
}

.form {
    padding: 1rem;
    background-color: var(--white);
    border-radius: 1.5rem;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    transform: scale(0);
    transition: .5s ease-in-out;
    transition-delay: 1s;
}

.input-group {
    position: relative;
    width: 100%;
    margin: 1rem 0;
}

.input-group i {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
    font-size: 1.4rem;
    color: var(--gray-2);
}

.input-group input {
    width: 100%;
    padding: 1rem 3rem;
    font-size: 1rem;
    background-color: var(--gray);
    border-radius: .5rem;
    border: 0.125rem solid var(--white);
    outline: none;
}

.input-group input:focus {
    border: 0.125rem solid var(--primary-color);
}

.form button {
    cursor: pointer;
    width: 100%;
    padding: .6rem 0;
    border-radius: .5rem;
    border: none;
    background-color: var(--primary-color);
    color: var(--white);
    font-size: 1.2rem;
    outline: none;
}
.form button:hover{
    background-color:#013830;
}
.form p {
    margin: 1rem 0;
    font-size: .7rem;
}

.flex-col {
    flex-direction: column;
}

.social-list {
    margin: 2rem 0;
    padding: 1rem;
    border-radius: 1.5rem;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    transform: scale(0);
    transition: .5s ease-in-out;
    transition-delay: 1.2s;
}

.social-list>div {
    color: var(--white);
    margin: 0 .5rem;
    padding: .7rem;
    cursor: pointer;
    border-radius: .5rem;
    cursor: pointer;
    transform: scale(0);
    transition: .5s ease-in-out;
}

.social-list>div:nth-child(1) {
    transition-delay: 1.4s;
}

.social-list>div:nth-child(2) {
    transition-delay: 1.6s;
}

.social-list>div:nth-child(3) {
    transition-delay: 1.8s;
}

.social-list>div:nth-child(4) {
    transition-delay: 2s;
}

.social-list>div>i {
    font-size: 1.5rem;
    transition: .4s ease-in-out;
}

.social-list>div:hover i {
    transform: scale(1.5);
}
._container.btn{
            text-align: center;
        }
        .heading{
            text-align: center;
            color: #4d4d4d;
            text-transform: uppercase;
        }
        .login-with-google-btn {
            transition: background-color 0.3s, box-shadow 0.3s;
            padding: 12px 16px 12px 42px;
            border: none;
            border-radius: 3px;
            box-shadow: 0 -1px 0 rgb(0 0 0 / 4%), 0 1px 1px rgb(0 0 0 / 25%);
            color: black;
            font-size: 14px;
            font-weight: 500;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
            background-color: white;
            background-repeat: no-repeat;
            background-position: 12px 11px;
            text-decoration: none;
        }
        .login-with-google-btn:hover {
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25);
        }
        .login-with-google-btn:active {
            background-color: #000000;
        }
        .login-with-google-btn:focus {
            outline: none;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25), 0 0 0 3px #c8dafc;
        }
        .login-with-google-btn:disabled {
            filter: grayscale(100%);
            background-color: #ebebeb;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 1px 1px rgba(0, 0, 0, 0.25);
            cursor: not-allowed;
        }
.pointer {
    cursor: pointer;
}

.container.sign-in .form.sign-in,
.container.sign-in .social-list.sign-in,
.container.sign-in .social-list.sign-in>div,
.container.sign-up .form.sign-up,
.container.sign-up .social-list.sign-up,
.container.sign-up .social-list.sign-up>div {
    transform: scale(1);
}

.content-row {
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 6;
    width: 100%;
}

.text {
    margin: 4rem;
    color: var(--white);
}

.text h2 {
    font-size: 3.5rem;
    font-weight: 800;
    margin: 2rem 0;
    transition: 1s ease-in-out;
}

.text p {
    font-weight: 600;
    transition: 1s ease-in-out;
    transition-delay: .2s;
}

.img img {
    width: 30vw;
    transition: 1s ease-in-out;
    transition-delay: .4s;
}

.text.sign-in h2,
.text.sign-in p,
.img.sign-in img {
    transform: translateX(-250%);
}

.text.sign-up h2,
.text.sign-up p,
.img.sign-up img {
    transform: translateX(250%);
}

.container.sign-in .text.sign-in h2,
.container.sign-in .text.sign-in p,
.container.sign-in .img.sign-in img,
.container.sign-up .text.sign-up h2,
.container.sign-up .text.sign-up p,
.container.sign-up .img.sign-up img {
    transform: translateX(0);
}

/* BACKGROUND */

.container::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    height: 100vh;
    width: 300vw;
    transform: translate(35%, 0);
    background-image: linear-gradient(-45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    transition: 1s ease-in-out;
    z-index: 6;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-bottom-right-radius: max(50vw, 50vh);
    border-top-left-radius: max(50vw, 50vh);
}

.container.sign-in::before {
    transform: translate(0, 0);
    right: 50%;
}

.container.sign-up::before {
    transform: translate(100%, 0);
    right: 50%;
}

/* RESPONSIVE */

@media only screen and (max-width: 425px) {

    .container::before,
    .container.sign-in::before,
    .container.sign-up::before {
        height: 100vh;
        border-bottom-right-radius: 0;
        border-top-left-radius: 0;
        z-index: 0;
        transform: none;
        right: 0;
    }

    /* .container.sign-in .col.sign-up {
        transform: translateY(100%);
    } */

    .container.sign-in .col.sign-in,
    .container.sign-up .col.sign-up {
        transform: translateY(0);
    }

    .content-row {
        align-items: flex-start !important;
    }

    .content-row .col {
        transform: translateY(0);
        background-color: unset;
    }

    .col {
        width: 100%;
        position: absolute;
        padding: 2rem;
        background-color: var(--white);
        border-top-left-radius: 2rem;
        border-top-right-radius: 2rem;
        transform: translateY(100%);
        transition: 1s ease-in-out;
    }

    .row {
        align-items: flex-end;
        justify-content: flex-end;
    }

    .form,
    .social-list {
        box-shadow: none;
        margin: 0;
        padding: 0;
    }

    .text {
        margin: 0;
    }

    .text p {
        display: none;
    }

    .text h2 {
        margin: .5rem;
        font-size: 2rem;
    }

}
	</style>
</head>
<body>
	<div id="container" class="container">
		<!-- FORM SECTION -->
		<div class="row">
			<!-- SIGN UP -->
			<div class="col align-items-center flex-col sign-up">
				<div class="form-wrapper align-items-center">
					<div class="form sign-up">
                        <form action="" method="post">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" name="username" placeholder="Username" required class="form-control" >
						</div>
						<div class="input-group">
							<i class='bx bx-mail-send'></i>
							<input type="email" name="email" placeholder="Email" required class="form-control" >
                            <?php
                            if($showAlert)
                            echo '<b style="color:red; font-size:13px;">*This email already exists*</b>';
                            ?>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password" id="password" placeholder="Password" required class="form-control" maxlength="15">
                            <div id="password-strength"></div>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="cpassword" placeholder="Confirm password" required class="form-control" maxlength="15">
						</div>
						<button type="submit" name="signup">
							Sign up
                        </button>
                        </form>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign in here
							</b>
						</p>
					</div>
				</div>
			
			</div>
			<!-- END SIGN UP -->

			<!-- SIGN IN -->
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
                <form action="" method="post">
					<div class="form sign-in">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="Email" required name="lemail">
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Password" required name="lpassword">
						</div>
                        <?php
                            if($invalid)
                            echo '<b style="color:red; font-size:13px;">*Invalid email or password*</b>';
                            ?>
                            <br>
                            <br>
						<button name="login">
							Log in
						</button>
						<p>
							<a href="#" style="text-decoration:none;">
								Forgot password?
                            </a>
						</p>
                        <p style="font-size: 14px;">Or <br></p>

                        <div class="_container btn">
                        <a type="button" class="login-with-google-btn" href="<?php echo $client->createAuthUrl(); ?>">
                            Log in with Google
                        </a>
                        </div>
                        <br>
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign up here
							</b>
						</p>
					</div>
				</div>
    </form>
				<div class="form-wrapper">
		
				</div>
			</div>
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->
		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome to<br> RentIt
					</h2>
	
				</div>
				<div class="img sign-in">
		
				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">
				
				</div>
				<div class="text sign-up">
					<h2>
						Connect with us
					</h2>
	
				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>
</body>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script>
    let container = document.getElementById('container');

    toggle = () => {
        container.classList.toggle('sign-in');
        container.classList.toggle('sign-up');
    };

    setTimeout(() => {
        container.classList.add('sign-in');
    }, 200);

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])): ?>
    // If the form is submitted, don't toggle
    // Remove this part if you want to toggle even after form submission
    setTimeout(() => {
        container.classList.remove('sign-in');
        container.classList.add('sign-up');
    }, 200);
    <?php endif; ?>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])): ?>
    // If the form is submitted, don't toggle
    // Remove this part if you want to toggle even after form submission
    setTimeout(() => {
        container.classList.remove('sign-up');
        container.classList.add('sign-in');
    }, 200);
    <?php endif; ?>

    // Form validation
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        const password = document.querySelector('input[name="password"]');
        const confirmPassword = document.querySelector('input[name="cpassword"]');
        if (password.value !== confirmPassword.value) {
            alert('Passwords do not match.');
            event.preventDefault();
            return;
        }
    });
    const submitButton = document.querySelector('button[type="submit"]');
submitButton.disabled = true;
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
</script>
</html>
<?php endif; ?>