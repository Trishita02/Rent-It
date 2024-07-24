<?php   
require('connection.php');
$invalid=false;
if(isset($_POST['login'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $sql="select * from admin where username='$username' and password='$password'";
    $result=mysqli_query($con,$sql);
    $count=mysqli_num_rows($result);
    if($count>0){
        $_SESSION['ADMIN']='admin';
        $_SESSION['Admin_username']=$username;
        header('location:product.php');
    }
    else{
        $invalid=true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RentIt</title>
	<link rel="stylesheet" href="login_style.css">
	<link rel="icon" type="image/x-icon" href="images/logo.jpeg">
</head>
<body>
	<div id="container" class="container">
		<div class="row">
			<div class="col align-items-center flex-col"></div>
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
                <form action="" method="post">
					<div class="form sign-in">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="Username" required name="username">
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Password" required name="password">
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
					</div>
				</div>
                </form>
			</div>
		</div>
		<div class="row content-row">
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome Admin to<br> RentIt
					</h2>
				</div>
            </div>
		</div>
	</div>
</body>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script>
    let container = document.getElementById('container');
    setTimeout(() => {
        container.classList.add('sign-in');
    }, 200);
</script>
</html>