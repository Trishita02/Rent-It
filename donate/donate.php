<?php
require('..\admin\connection.php');
if(isset($_SESSION['login_id'])){
$user=$_SESSION['login_id'];
}
else{
    header('location:../login.php');
    exit();
}

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $address=$_POST['Address'];
    if(isset($_POST['category'])) {
        $category = $_POST['category'];
    } else {
        $category = ""; 
    }
    $no_of_clothes=$_POST['no_of_clothes'];
    $donate_id=uniqid();
    $date=date('Y-m-d');

    if($name==''||$phone==''||$address==''||$category==''||$no_of_clothes==''||empty($_FILES['doc']['name'][0])){
        echo '<script>alert("Fill all required fields")</script>';
    }
    else{
        foreach($_FILES['doc']['name'] as $key=>$val){
            $rand=rand('11111111','99999999');
            $file=$rand.'_'.$val;
            if($val!=''){
            move_uploaded_file($_FILES['doc']['tmp_name'][$key],'donated_clothes/'.$file);
             mysqli_query($con,"insert into `donate_images`(donate_id,image) values('$donate_id','$file')");
            }
        }
        mysqli_query($con,"INSERT INTO `donate`(`donate_id`,`name`,`email`, `phone`, `address`, `category`, `no_of_clothes`,`date`) VALUES ('$donate_id','$name','$user','$phone','$address','$category','$no_of_clothes','$date')");
        echo '<script>alert("Thank you for donating clothes. God bless you")</script>';
    }
}
if (isset($_SESSION['login_id'])) {
    $user = $_SESSION['login_id'];
     if ($_SESSION['user_type'] == "normal") {
      $user_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `new user` WHERE Email='$user'"));
      $user_name = $user_query['Username'];
      $user_diamonds=$user_query['diamonds'];
      $profile_image=$user_query['profile_image'];
      if($profile_image=='') $profile_image="noprofile.jpg";
    }
    else{
      $user_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `google users` WHERE Email='$user'"));
      $user_name = $user_query['name'];
      $user_diamonds=$user_query['diamonds'];
      $profile_image=$user_query['profile_image'];
    }
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>Donate</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.9.13, a.mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/photo-1599059813005-11265ba4b4ce.jpeg" type="image/x-icon">
    <meta name="description" content="Support our cause by donating to provide clothing for those in need.">
    <title>Donate Clothing Now</title>
    <link rel="icon" type="image/x-icon" href="../admin/images/logo.jpeg">
    <link rel="stylesheet"
        href="https://r.mobirisesite.com/386577/assets/web/assets/mobirise-icons2/mobirise2.css?rnd=1712851507765">
    <link rel="stylesheet"
        href="https://r.mobirisesite.com/386577/assets/bootstrap/css/bootstrap.min.css?rnd=1712851507765">
    <link rel="stylesheet"
        href="https://r.mobirisesite.com/386577/assets/bootstrap/css/bootstrap-grid.min.css?rnd=1712851507765">
    <link rel="stylesheet"
        href="https://r.mobirisesite.com/386577/assets/bootstrap/css/bootstrap-reboot.min.css?rnd=1712851507765">
    <link rel="stylesheet" href="https://r.mobirisesite.com/386577/assets/parallax/jarallax.css?rnd=1712851507765">
    <link rel="stylesheet" href="https://r.mobirisesite.com/386577/assets/dropdown/css/style.css?rnd=1712851507765">
    <link rel="stylesheet" href="https://r.mobirisesite.com/386577/assets/socicon/css/styles.css?rnd=1712851507765">
    <link rel="stylesheet" href="https://r.mobirisesite.com/386577/assets/theme/css/style.css?rnd=1712851507765">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Onest:wght@400;700&display=swap&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Onest:wght@400;700&display=swap&display=swap">
    </noscript>
    <link rel="stylesheet" href="https://r.mobirisesite.com/386577/assets/css/mbr-additional.css?rnd=1712851507765"
        type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
<link rel="stylesheet" href="../user-dropdown.css">


</head>
<style>
    .container {
        margin: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        margin-left: -74px;
        margin-left: -73px;
         width: 185px;
        justify-content: space-evenly;
        align-items: center;
    
    }

    .form-control-file {
        display: block;
        width: 180px;
        margin-left: -100px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-left: 70px;
        height: 250px;
        padding-top: 100px;
        padding-right: 100px;
        padding-left: 15px;
        font-size: 11px;
    }

    /* .button {
  padding: 10px 20px;
  background-color: #black;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
} */
    .mera-section {
        display: flex;
        justify-content: space-evenly;
        margin-left: 20px;
    }

    

    button:hover {
        background-color: rgb(101, 206, 101);
    }
    .form-group {
    margin-bottom: 20px;
}
form .row [class*=col] {
    padding-left: 0.6rem;
    padding-right: 0.6rem;
    display: flex;
    justify-content:space-around;
    
}
form .row [class*=col] select {
    font-size: 20px;
    padding-left: 50px;
    font-weight: 300;
}
select .form-control {
    width: 100%;
    max-width: 329px;
    padding: 25px;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 72px;
    font-size: 1rem;
    color: #232323;
}

.form-control {
    width: 100%; /* Set width to 100% */
}

/* Style for the dropdown */
select.form-control {
    width: 100%; /* Set width to 100% */
    max-width: 300px; /* Set max-width to limit width */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 70px;
    font-size: 1.0rem;
    color: #232323;
}

/* Adjust spacing for the button */
.mbr-section-btn {
    margin-top: 20px;
}
</style>

<body>

    <section data-bs-version="5.1" class="menu menu2 cid-u9EvmCejq9" once="menu" id="menu-5-u9EvmCejq9">


        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="#">
                            <img src="assets/images/donateimg3.webp"
                                alt="Mobirise Website Builder" style="height: 4.3rem;">
                        </a>
                    </span>
                    <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4"
                            href="#">RentalClothDonation</a></span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse"
                    data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="../home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="donate.php">Donate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="../rent/index.php" aria-expanded="false">Rent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="../rent/about.php">About</a>
                        </li>
                       
                    </ul>
                    <div class="dropdown">
        <div class="dropbtn" onclick="toggleDropdown()">
        <?php
            if (strpos($profile_image, 'https://') === 0) {
            echo '<img src="'.$profile_image.'" id="profile-photo" onerror="this.src=\'../user_img/noprofile.jpg\';">';
            } else {
            echo '<img src="../user_img/'.$profile_image.'" id="profile-photo" onerror="this.src=\'../user_img/noprofile.jpg\';">';
            }
            ?>
        </div>
        <div id="myDropdown" class="dropdown-content" style="background-color:white;">
            <p class="para">Hey, <?php echo $user_name;?></p><hr>
            <a href="../edit_profile.php"><i class="fas fa-user"></i> Your Profile</a> 
            <a href="../rent/my_orders.php"><i class="fas fa-box"></i> Your Orders</a>
            <a href="my_donations.php"><i class="fas fa-hand-holding-heart"></i>Your Donations</a>
            <a href="#"><i class="fas fa-gift"></i>Rewards <span class="diamonds-line"><?php echo $user_diamonds;?><img src="../rent/diamond.avif" alt=""></span></a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
                    <div class="navbar-buttons mbr-section-btn">
                        <a class="btn btn-primary display-4" href="#contact-form-3-u9EvmCiR1F">Donate Now</a>
                    </div>
                    
                </div>
            </div>
        </nav>
    </section>
    <script src="../user-dropdown.js"></script>
    <section data-bs-version="5.1" class="article07 cid-u9EvmCfHfU" id="about-me-7-u9EvmCfHfU">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card col-md-12 col-lg-10">
                    <div class="card-wrapper">
                        <h3 class="card-title mbr-fonts-style mbr-white mt-3 mb-4 display-2">
                            <strong>Our Mission</strong>
                        </h3>
                        <div class="row card-box align-left">
                            <div class="item features-without-image col-12">
                                <div class="item-wrapper">
                                    <p class="mbr-text mbr-fonts-style display-7">At RentalClothDonation, we believe in
                                        the power of giving. Your donations can transform lives and bring hope to those
                                        in need.</p>
                                </div>
                            </div>
                            <div class="item features-without-image col-12">
                                <div class="item-wrapper">
                                    <p class="mbr-text mbr-fonts-style display-7">Join us in our mission to make a
                                        positive impact on the world. Together, we can create a brighter future for all.
                                    </p>
                                </div>
                            </div>
                            <div class="item features-without-image col-12">
                                <div class="item-wrapper">
                                    <p class="mbr-text mbr-fonts-style display-7">Every donation counts, no matter how
                                        big or small. Let's work together to spread kindness and compassion.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="slider4 mbr-embla cid-u9EvmCf0W2" id="gallery-13-u9EvmCf0W2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="embla position-relative" data-skip-snaps="true" data-align="center"
                        data-contain-scroll="trimSnaps" data-loop="true" data-auto-play="true"
                        data-auto-play-interval="5" data-draggable="true">
                        <div class="embla__viewport">
                            <div class="embla__container">
                                <div class="embla__slide slider-image item"
                                    style="margin-left: 1rem; margin-right: 1rem;">
                                    <div class="slide-content">
                                        <div class="item-img">
                                            <div class="item-wrapper">
                                                <img src="assets/images/donateimg1.jpg"
                                                    alt="Mobirise Website Builder" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="embla__slide slider-image item"
                                    style="margin-left: 1rem; margin-right: 1rem;">
                                    <div class="slide-content">
                                        <div class="item-img">
                                            <div class="item-wrapper">
                                                <img src="assets/images/donateimg2.jpg"
                                                    alt="Mobirise Website Builder" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="embla__slide slider-image item"
                                    style="margin-left: 1rem; margin-right: 1rem;">
                                    <div class="slide-content">
                                        <div class="item-img">
                                            <div class="item-wrapper">
                                                <img src="assets/images/donateimg5.webp"
                                                    alt="Mobirise Website Builder" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="embla__slide slider-image item"
                                    style="margin-left: 1rem; margin-right: 1rem;">
                                    <div class="slide-content">
                                        <div class="item-img">
                                            <div class="item-wrapper">
                                                <img src="assets/images/donateimg4.jpg"
                                                    alt="Mobirise Website Builder" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="embla__slide slider-image item"
                                    style="margin-left: 1rem; margin-right: 1rem;">
                                    <div class="slide-content">
                                        <div class="item-img">
                                            <div class="item-wrapper">
                                                <img src="assets/images/donateimg6.jpg"
                                                    alt="Mobirise Website Builder" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="embla__button embla__button--prev">
                            <span class="mobi-mbri mobi-mbri-arrow-prev" aria-hidden="true"></span>
                            <span class="sr-only visually-hidden visually-hidden">Previous</span>
                        </button>
                        <button class="embla__button embla__button--next">
                            <span class="mobi-mbri mobi-mbri-arrow-next" aria-hidden="true"></span>
                            <span class="sr-only visually-hidden visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="features023 cid-u9EvmChQ4A" id="metrics-1-u9EvmChQ4A">
        <div class="container">

            <div class="row content-row justify-content-center">
                <div class="item features-without-image col-12 col-md-6 col-lg-4 item-mb">
                    <div class="item-wrapper">
                        <div class="title mb-2 mb-md-3">
                            <span class="num mbr-fonts-style display-1">
                                <strong>1000+</strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Happy Donors</strong>
                        </h4>
                    </div>
                </div>
                <div class="item features-without-image col-12 col-md-6 col-lg-4 item-mb">
                    <div class="item-wrapper">
                        <div class="title mb-2 mb-md-3">
                            <span class="num mbr-fonts-style display-1">
                                <strong>500+</strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Stylish Donations</strong>
                        </h4>
                    </div>
                </div>
                <div class="item features-without-image col-12 col-md-6 col-lg-4 item-mb">
                    <div class="item-wrapper">
                        <div class="title mb-2 mb-md-3">
                            <span class="num mbr-fonts-style display-1">
                                <strong>5000+</strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Lives Touched</strong>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="list05 cid-u9EvmCh90t" id="faq-3-u9EvmCh90t">
        <div class="container">
            <div class="col-12 mb-5 content-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Curious Minds Ask</strong>
                </h3>
            </div>
            <div class="row justify-content-center ">
                <div class="col-12 col-lg-8">
                    <div class="item features-without-image col-12 active">
                        <div class="item-wrapper">
                            <h5 class="mbr-card-title mbr-fonts-style mt-0 mb-3 display-5">
                                <strong>How can I donate stylishly?</strong>
                            </h5>
                            <p class="mbr-text mbr-fonts-style mt-0 mb-3 display-7">Upload a photo and customize your
                                donation properties to make a statement while giving back.</p>
                        </div>
                    </div>
                    <div class="item features-without-image col-12">
                        <div class="item-wrapper">
                            <h5 class="mbr-card-title mbr-fonts-style mt-0 mb-3 display-5">
                                <strong>What categories can I donate to?</strong>
                            </h5>
                            <p class="mbr-text mbr-fonts-style mt-0 mb-3 display-7">Choose from a variety of categories
                                including clothing, accessories, and more to support causes.</p>
                        </div>
                    </div>
                    <div class="item features-without-image col-12">
                        <div class="item-wrapper">
                            <h5 class="mbr-card-title mbr-fonts-style mt-0 mb-3 display-5">
                                <strong>Can I personalize my donation?</strong>
                            </h5>
                            <p class="mbr-text mbr-fonts-style mt-0 mb-3 display-7">Absolutely! Tailor your donation to
                                reflect your unique style and values.</p>
                        </div>
                    </div>
                    <div class="item features-without-image col-12">
                        <div class="item-wrapper">
                            <h5 class="mbr-card-title mbr-fonts-style mt-0 mb-3 display-5">
                                <strong>Who benefits from my donations?</strong>
                            </h5>
                            <p class="mbr-text mbr-fonts-style mt-0 mb-3 display-7">Your donations support NGOs and
                                individuals in need, making a real impact in their lives.</p>
                        </div>
                    </div>
                    <div class="item features-without-image col-12">
                        <div class="item-wrapper">
                            <h5 class="mbr-card-title mbr-fonts-style mt-0 mb-3 display-5">
                                <strong>How can I contact the NGO?</strong>
                            </h5>
                            <p class="mbr-text mbr-fonts-style mt-0 mb-3 display-7">Reach out to the NGO through the
                                contact details provided in the footer of the page.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="people06 cid-u9EvmCh5l0" id="testimonials-7-u9EvmCh5l0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card col-12 col-md-12 col-lg-8">
                    <div class="card-wrapper">
                        <div class="card-box align-center">
                            <p class="card-text mbr-fonts-style display-5">Donating through Rental Cloth and Donation
                                was a breeze! I uploaded a photo and supported a cause effortlessly.</p>
                            <div class="img-wrapper mt-3 justify-content-center">
                                <img src="assets/images/photo-1578161456171-a346107c3dcf.jpeg" alt="" data-slide-to="0"
                                    data-bs-slide-to="0">
                            </div>
                            <p class="card-title mbr-fonts-style mt-3 display-7">
                                <strong>Samantha Sparkles</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="article12 cid-u9EvmChkJL" id="generic-text-6-u9EvmChkJL">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <h3 class="mbr-section-title mbr-fonts-style mb-4 mt-0 display-2">
                        <strong>Support with Style</strong>
                    </h3>

                    <p class="mbr-text mbr-fonts-style display-7">Join us in making a difference through the power of
                        fashion. Upload a photo and contribute to a cause you care about.</p>
                    <p class="mbr-text mbr-fonts-style display-7">Choose a category, specify the size, and add any other
                        details to personalize your donation experience.</p>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="image02 cid-u9EvmChFyI mbr-fullscreen mbr-parallax-background"
        id="image-13-u9EvmChFyI" >
        <div class="container">
            <div class="row"></div>
        </div>
    </section>


    <section data-bs-version="5.1" class="form5 cid-u9EvmCiR1F" id="contact-form-3-u9EvmCiR1F">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 content-head">
                    <div class="mbr-section-head mb-5">
                        <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                            <strong>Join the Donation Movement</strong>
                        </h3>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mera-section">
                            <div class="form-group">
                                <label for="photoUpload" class="form-label">Choose a photo:</label>
                                <input type="file" name="doc[]" multiple class="form-control-file" id="photoUpload" accept="image/*">
                                <!-- <input type="file" id="file photoUpload" name="file" multiple /> -->
                            </div>
                            <div class="dragArea row">
                                <div class="col-md col-sm-12 form-group mb-3">
                                    <input type="text" name="name" placeholder="Name" class="form-control">
                                </div>
                                <div class="col-12 form-group mb-3 mb-3">
                                    <input type="text" name="phone" placeholder="Phone Number" class="form-control" >
                                </div>
                                <div class="col-12 form-group mb-3">
                                    <textarea name="Address" placeholder="Address" class="form-control" ></textarea>
                                </div>
                                <div class="col-md col-sm-12 form-group mb-3">
                                    <select name="category" class="form-control">
                                        <option value=" " disabled selected>Select Category</option>
                                        <option value="Men">MEN</option>
                                        <option value="Women">WOMEN</option>
                                        <option value="Child">CHILD</option>
                                    </select>
                                </div>
                                    <div class="col-6 form-group mb-3 mb-3">
                                    <input type="number" name="no_of_clothes" placeholder="No of clothes" class="form-control" >
                                </div>
                                   
                                <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
                                    <button type="submit" name="submit" class="btn btn-primary display-7">Send Love</button>
                                </div>

                            </div>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="contacts01 cid-u9EvmCiygi" id="contacts-1-u9EvmCiygi">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 content-head">
                    <div class="mbr-section-head mb-5">
                        <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                            <strong>Get in Touch</strong>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item features-without-image col-12 col-md-6 active">
                    <div class="item-wrapper">
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-3 display-5">
                                <strong>Phone</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">
                                <a href="tel:123-456-7890" class="text-black">123-456-7890</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="item features-without-image col-12 col-md-6">
                    <div class="item-wrapper">
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-3 display-5">
                                <strong>Email</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">
                                <a href="mailto:contact@rentalclothanddonation.com"
                                    class="text-black">contact@rentalclothanddonation.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="item features-without-image col-12 col-md-6">
                    <div class="item-wrapper">
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-3 display-5">
                                <strong>Address</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">Allahabad India</p>
                        </div>
                    </div>
                </div>
                <div class="item features-without-image col-12 col-md-6">
                    <div class="item-wrapper">
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-3 display-5">
                                <strong>Working Hours</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">Mon-Fri: 9am-5pm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="footer4 cid-u9EvmCin79" once="footers" id="footer-4-u9EvmCin79">
        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mbr-fonts-style display-7">© 2024 Rental Cloth and Donation. All Rights
                        Reserved.</p>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/parallax/jarallax.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/ytplayer/index.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/embla/embla.min.js"></script>
    <script src="assets/embla/script.js"></script>
    <script src="assets/masonry/masonry.pkgd.min.js"></script>
    <script src="assets/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/theme/js/script.js"></script>
    <script src="assets/formoid/formoid.min.js"></script>
</body>

</html>