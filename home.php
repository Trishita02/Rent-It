<?php
session_start();
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Rental cloth and Donation</title>
  <link rel="icon" href=
   "assets/images/WhatsApp Image 2024-04-11 at 1.57.17 AM.jpeg"
         style=" width: 100%; height: 100%;" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.9.13, a.mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/photo-1561052967-61fc91e48d79.jpeg" type="image/x-icon">
  <meta name="description" content="Explore our wide range of rental clothing options and join us in making a difference through donations.">
  <title>Fashion for Good</title>
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/web/assets/mobirise-icons2/mobirise2.css?rnd=1712766403604">
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/bootstrap/css/bootstrap.min.css?rnd=1712766403604">
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/bootstrap/css/bootstrap-grid.min.css?rnd=1712766403604">
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/bootstrap/css/bootstrap-reboot.min.css?rnd=1712766403604">
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/parallax/jarallax.css?rnd=1712766403604">
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/dropdown/css/style.css?rnd=1712766403604">
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/socicon/css/styles.css?rnd=1712766403604">
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/theme/css/style.css?rnd=1712766403604">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap&display=swap"></noscript>
  <link rel="stylesheet" href="https://r.mobirisesite.com/385257/assets/css/mbr-additional.css?rnd=1712766403604" type="text/css">
  
</head>
<style>
    video{
    position:absolute;
    right:0;
    bottom:0;
    width: 20%;
    min-width: 100%;
    min-height: 100%;
    }
    #content{
        position: absolute;
        bottom:0;
        
    }
    .navbar-nav{
      margin: auto;

    }
</style>
<body>
  
<section data-bs-version="5.1" class="menu menu2 cid-u9yL7dVAAd" once="menu" id="menu-5-u9yL7dVAAd">
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="#">
                        <img src="assets/images/WhatsApp Image 2024-04-11 at 1.57.17 AM.jpeg"  style="height: 4.3rem;" style="width: 10px; background-size: cover;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4" href="#"></a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link link text-black display-4" href="rent/index.html">Rent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-black display-4" href="donate/index.html" aria-expanded="false">Donate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-black display-4" href="rent/about.html">About</a>
                    </li>
                </ul>
                
                <div class="navbar-buttons mbr-section-btn">
                        <?php if (isset($_SESSION['login'])): ?> 
                        <a class="btn btn-primary display-4" href="logout.php">Logout</a>
                    <?php else: ?> 
                        <a class="btn btn-primary display-4" href="login.php">Sign in</a>
                     <?php endif; ?> 
                </div>
            </div>
        </div>
    </nav>
</section>

<section data-bs-version="5.1" class="header18 cid-u9yL7dW6gi mbr-fullscreen"  id="hero-15-u9yL7dW6gi">
    <video autoplay muted>
        <source src="/assets/video.mp4" type="video/mp4">
    </video>
  <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="content-wrap col-12 col-md-12" id="content">
        <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-4 display-1">
          <strong>RENT IT</strong>
        </h1>
        
        <p class="mbr-fonts-style mbr-text mbr-white mb-4 display-7">Elevate Your Style with Our Trendy Rental Collection. Rent, Flaunt, Repeat!</p>
        <div class="mbr-section-btn">
          <a class="btn btn-white-outline display-7" href="home.html">Get Styled</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section data-bs-version="5.1" class="article2 cid-u9yL7dWWcM" id="about-me-2-u9yL7dWWcM">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-12 col-lg-6 image-wrapper">
				<img class="w-100" src="assets/images/IMG-20240411-WA0017.jpg" alt="Mobirise Website Builder">
			</div>
			<div class="col-12 col-md-12 col-lg">
				<div class="text-wrapper align-left">
					<h1 class="mbr-section-title mbr-fonts-style mb-4 display-2">
						<strong>Who We Are</strong>
					</h1>
					<p class="mbr-text align-left mbr-fonts-style mb-3 display-7">At RENT IT, we believe in fashion freedom. Express yourself without limits through our exclusive rental cloth options.</p>

					<p class="mbr-text align-left mbr-fonts-style mb-3 display-7">Our mission is to make every outfit a statement piece. Join us in the fashion revolution!</p>

					<p class="mbr-text align-left mbr-fonts-style mb-3 display-7">Our story begins with a passion for fashion and a commitment to kindness. Join us at Rental Cloth and Donation and be inspired to make a difference.</p>

					
				</div>
			</div>
		</div>
	</div>
</section>

<section data-bs-version="5.1" class="pricing1 cid-u9yL7dWoup" id="pricing-cards-1-u9yL7dWoup">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 content-head">
                <div class="mbr-section-head mb-5">
                    <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                        <strong>Pricing Plans</strong>
                    </h4>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="item features-without-image col-12 col-md-6 col-lg-3 item-mb active">
                <div class="item-wrapper">
                    <div class="item-head">
                        <h5 class="item-title mbr-fonts-style mb-0 display-5">
                            <strong>Stylish Starter</strong>
                        </h5>
                        <h6 class="item-subtitle mbr-fonts-style mt-0 mb-0 display-7">
                            <strong>&#x20B9 2999</strong>/week
                        </h6>
                    </div>
                    <div class="item-content">
                        <p class="mbr-text mbr-fonts-style display-7">Kickstart your fashion journey with a curated selection of trendy pieces. Swap, slay, and stay ahead of the style game!</p>
                    </div>
                </div>
            </div>
            <div class="item features-without-image col-12 col-md-6 col-lg-3 item-mb">
                <div class="item-wrapper">
                    <div class="item-head">
                        <h5 class="item-title mbr-fonts-style mb-0 display-5">
                            <strong>Fashionista Fave</strong>
                        </h5>
                        <h6 class="item-subtitle mbr-fonts-style mt-0 mb-0 display-7">
                            <strong>&#x20B9 1499</strong>/week
                        </h6>
                    </div>
                    <div class="item-content">
                        <p class="mbr-text mbr-fonts-style display-7">Unleash your inner fashion icon with unlimited access to premium designer wear. Elevate your wardrobe effortlessly!</p>
                    </div>
                    
                </div>
            </div>

            <div class="item features-without-image col-12 col-md-6 col-lg-3 item-mb">
                <div class="item-wrapper">
                    <div class="item-head">
                        <h5 class="item-title mbr-fonts-style mb-0 display-5">
                            <strong>Trendsetter Elite</strong>
                        </h5>
                        <h6 class="item-subtitle mbr-fonts-style mt-0 mb-0 display-7">
                            <strong>&#x20B9 1599</strong>/week
                        </h6>
                    </div>
                    <div class="item-content">
                        <p class="mbr-text mbr-fonts-style display-7">Lead the fashion pack with exclusive access to the latest runway trends. Be the trendsetter, not the follower!</p>
                    </div>
                    
                </div>
            </div>

            <div class="item features-without-image col-12 col-md-6 col-lg-3 item-mb">
                <div class="item-wrapper">
                    <div class="item-head">
                        <h5 class="item-title mbr-fonts-style mb-0 display-5">
                            <strong>VIP Couture</strong>
                        </h5>
                        <h6 class="item-subtitle mbr-fonts-style mt-0 mb-0 display-7">
                            <strong>&#x20B9 1999</strong>/week
                        </h6>
                    </div>
                    <div class="item-content">
                        <p class="mbr-text mbr-fonts-style display-7">Indulge in luxury with bespoke couture pieces. Redefine elegance and sophistication with every rental choice.</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="people04 cid-u9yL7dWpl3" id="testimonials-4-u9yL7dWpl3">
	
	
	<div class="container">
		<div class="row mb-5 justify-content-center">
			<div class="col-12 mb-0 content-head">
				<h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
					<strong>Glamorous</strong>
				</h3>
				
			</div>
		</div>
		<div class="row mbr-masonry" data-masonry="{&quot;percentPosition&quot;: true }">
			<div class="item features-without-image col-12 col-md-6 col-lg-4 active">
				<div class="item-wrapper">
					<div class="card-box align-left">
						<p class="card-text mbr-fonts-style display-7">RENT IT transformed my wardrobe! I feel like a celebrity every time I rent from them.</p>
						<div class="img-wrapper mt-4 mb-3">
							<img src="assets/images/photo-1643029950351-6ae7f69186fc.jpeg" data-slide-to="0" data-bs-slide-to="0" alt="">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
							<strong>Sophia Styles</strong>
						</h5>
					</div>
				</div>
			</div>
			<div class="item features-without-image col-12 col-md-6 col-lg-4">
				<div class="item-wrapper">
					<div class="card-box align-left">
						<p class="card-text mbr-fonts-style display-7">Renting from RENT IT is a fashion adventure! Their collection is a dream come true for trendsetters.</p>
						<div class="img-wrapper mt-4 mb-3">
							<img src="assets/images/photo-1509988892867-8bf3ee9e3afa.jpeg" data-slide-to="4" data-bs-slide-to="4" alt="">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
							<strong>Max Vogue</strong>
						</h5>
					</div>
				</div>
			</div>
			<div class="item features-without-image col-12 col-md-6 col-lg-4">
				<div class="item-wrapper">
					<div class="card-box align-left">
						<p class="card-text mbr-fonts-style display-7">RENT IT is my go-to for special occasions. Their rentals make me feel like a million bucks without breaking the bank!</p>
						<div class="img-wrapper mt-4 mb-3">
							<img src="assets/images/photo-1608652763120-59aab1d8125c.jpeg" data-slide-to="5" data-bs-slide-to="5" alt="">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
							<strong>Luna Luxe</strong>
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section data-bs-version="5.1" class="features037 cid-u9yL7e7z7k" id="features-68-u9yL7e7z7k">
  
  
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4">
        <div class="col-12 col-md-12">
          <h5 class="mbr-section-title mbr-fonts-style mt-0 mb-4 display-2">
            <strong>Rent &amp; Donate</strong>
          </h5>
          <h6 class="mbr-section-subtitle mbr-fonts-style mt-0 mb-4 display-7">Explore our rental cloth collection and join us in making a difference through donations.</h6>
          
        </div>
      </div>

      <div class="col-lg-8 side-features">
        <div class="item features-without-image col-12 col-md-12 col-lg-6 item-mb active">
          <div class="item-wrapper">
            <div class="item-content align-left">
              
              <h5 class="card-title mbr-fonts-style display-5">
                <strong>Rent</strong>
              </h5>
              <p class="card-text mbr-fonts-style display-7">Discover trendy outfits for any occasion available for rent at affordable prices.</p>
              
            </div>
          </div>
        </div>
        <div class="item features-without-image col-12 col-md-12 col-lg-6 item-mb">
          <div class="item-wrapper">
            <div class="item-content align-left">
              
              <h5 class="card-title mbr-fonts-style display-5">
                <strong>Donate</strong>
              </h5>
              <p class="card-text mbr-fonts-style display-7">Support our cause by donating to help those in need and make a positive impact.</p>
              
            </div>
          </div>
        </div>
        <div class="item features-without-image col-12 col-md-12 col-lg-6 item-mb">
        <div class="item-wrapper">
          <div class="item-content align-left">
            
            <h5 class="card-title mbr-fonts-style display-5">
              <strong>About Us</strong>
            </h5>
            <p class="card-text mbr-fonts-style display-7">Learn about our mission to revolutionize the fashion industry with a purpose-driven approach.</p>
            
          </div>
        </div>
      </div>
      <div class="item features-without-image col-12 col-md-12 col-lg-6 item-mb">
      <div class="item-wrapper">
        <div class="item-content align-left">
          
          <h5 class="card-title mbr-fonts-style display-5">
            <strong>Contact</strong>
          </h5>
          <p class="card-text mbr-fonts-style display-7">Get in touch with us to learn more about our services and how you can get involved.</p>
          
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
</section>

<section data-bs-version="5.1" class="article14 cid-u9yL7ek6T1" id="generic-text-11-u9yL7ek6T1">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style display-2">
                    <strong>Fashion with a purpose, making a statement one outfit at a time.</strong>
                </h3>
                <p class="mbr-section-subtitle mbr-fonts-style mt-4 display-7">Stella Styles</p>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features10 cid-u9yL7enGit" id="metrics-2-u9yL7enGit">
  

  
  
  <div class="container">
    
    <div class="row justify-content-center">
      <div class="item features-without-image col-12 col-md-6 col-lg-4">
        <div class="item-wrapper">
          <div class="card-box align-left">
            
            <h5 class="card-title mbr-fonts-style display-1">
              <strong>1000+</strong>
            </h5>
            <p class="card-text mbr-fonts-style mb-3 display-7">Happy Customers</p>
            
          </div>
        </div>
      </div>
      <div class="item features-without-image col-12 col-md-6 col-lg-4">
        <div class="item-wrapper">
          <div class="card-box align-left">
            
            <h5 class="card-title mbr-fonts-style display-1">
              <strong>500+</strong>
            </h5>
            <p class="card-text mbr-fonts-style mb-3 display-7">Donations Made</p>
            
          </div>
        </div>
      </div>
      <div class="item features-without-image col-12 col-md-6 col-lg-4">
        <div class="item-wrapper">
          <div class="card-box align-left">
            
            <h5 class="card-title mbr-fonts-style display-1">
              <strong>24/7</strong>
            </h5>
            <p class="card-text mbr-fonts-style mb-3 display-7">Support Available</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section data-bs-version="5.1" class="header14 cid-u9yL7eoOyK mbr-parallax-background" id="call-to-action-1-u9yL7eoOyK">
	<div class="container">
		<div class="row justify-content-center">
			<div class="card col-12 col-md-12 col-lg-8">
				<div class="card-wrapper">
					<div class="card-box align-center">
						<h1 class="card-title mbr-fonts-style mb-4 display-1">
							<strong>Join the Fashion Revolution Today!</strong>
						</h1>
						
						<div class="mbr-section-btn mt-4">
							<a class="btn btn-primary display-7" href="#">Explore Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section data-bs-version="5.1" class="list1 cid-u9yL7etUIC" id="faq-1-u9yL7etUIC">
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-10 m-auto">
                <div class="content">
                    <div class="row justify-content-center mb-5">
                        <div class="col-12 content-head">
                            <div class="mbr-section-head">
                                <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                                    <strong>FAQs</strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="bootstrap-accordion_9" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_9" aria-expanded="false" aria-controls="collapse1">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">How can I rent clothes?</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-arrow-down"></span>
                                </a>
                            </div>
                            <div id="collapse1_9" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_9">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">Browse our collection, select your favorites, and book them for your desired dates.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse2_9" aria-expanded="false" aria-controls="collapse2">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">What items can I donate?</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-arrow-down"></span>
                                </a>
                            </div>
                            <div id="collapse2_9" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_9">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">We accept only clothing to support our cause.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse3_9" aria-expanded="false" aria-controls="collapse3">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Why choose us?</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-arrow-down"></span>
                                </a>
                            </div>
                            <div id="collapse3_9" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_9">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">We offer a unique blend of fashion and philanthropy, making a difference with every choice.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse4_9" aria-expanded="false" aria-controls="collapse4">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">How do I contact you?</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-arrow-down"></span>
                                </a>
                            </div>
                            <div id="collapse4_9" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_9">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">Reach out to us via phone, email, or visit our office for a personal consultation.</p>
                                </div>
                            </div>
                          </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features03 cid-u9yL7etEt9" id="news-1-u9yL7etEt9">
  <div class="container-fluid">
    <div class="row justify-content-center mb-5">
      <div class="col-12 content-head">
        <div class="mbr-section-head">
          <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
            <strong>Rent the Latest Trends</strong>
          </h4>
          
        </div>
      </div>
    </div>
    <div class="row">
      <div class="item features-image col-12 col-md-6 col-lg-3 active">
        <div class="item-wrapper">
          <div class="item-img mb-3">
            <img src="assets/images/pp1.jpg" alt="Mobirise Website Builder" title="">
          </div>
          <div class="item-content align-left"> 
            <h5 class="item-title mbr-fonts-style mt-0 mb-2 display-5">
              <strong>Fashion Forward Rentals</strong>
            </h5>
            <p class="mbr-text mbr-fonts-style mb-3 display-7">Step up your style game with our exclusive collection of trendy rental clothes. Be the talk of the town without breaking the bank!</p>
            <div class="mbr-section-btn item-footer">
              <a href="" class="btn item-btn btn-primary display-7">Explore</a>
            </div>
          </div>
        </div>
      </div>
      <div class="item features-image col-12 col-md-6 col-lg-3">
        <div class="item-wrapper">
          <div class="item-img mb-3">
            <img src="assets/images/pp2.jpeg" alt="Mobirise Website Builder" title="" data-slide-to="1" data-bs-slide-to="1">
          </div>
          <div class="item-content align-left">
            <h5 class="item-title mbr-fonts-style mb-2 mt-0 display-5">
              <strong>Donate for a Cause</strong>
            </h5>
            
            <p class="mbr-text mbr-fonts-style mb-3 display-7">Join us in making a difference. Your donations help us support those in need and spread positivity. Together, we can change lives!</p>
            <div class="mbr-section-btn item-footer">
              <a href="" class="btn item-btn btn-primary display-7">Explore</a>
            </div>
          </div>
        </div>
      </div>
      <div class="item features-image col-12 col-md-6 col-lg-3">
        <div class="item-wrapper">
          <div class="item-img mb-3">
            <img src="assets/images/IMG-20240411-WA0019 (1).jpg" alt="Mobirise Website Builder" title="" data-slide-to="2" data-bs-slide-to="2">
          </div>
          <div class="item-content align-left">
            <h5 class="item-title mbr-fonts-style mb-2 mt-0 display-5">
              <strong>About Us</strong>
            </h5>
           
            <p class="mbr-text mbr-fonts-style mb-3 display-7">We are the rebels of fashion, breaking stereotypes and empowering individuals to express themselves through style. Join our movement!</p>
            <div class="mbr-section-btn item-footer">
              <a href="" class="btn item-btn btn-primary display-7">Explore</a>
            </div>
          </div>
        </div>
      </div>
      <div class="item features-image col-12 col-md-6 col-lg-3">
        <div class="item-wrapper">
          <div class="item-img mb-3">
            <img src="assets/images/IMG-20240411-WA0021 (1).jpg" alt="Mobirise Website Builder" title="" data-slide-to="2" data-bs-slide-to="2">
          </div>
          <div class="item-content align-left">
            <h5 class="item-title mbr-fonts-style mb-2 mt-0 display-5">
              <strong>Get in Touch</strong>
            </h5>
            <p class="mbr-text mbr-fonts-style mb-3 display-7">Want to know more about our rebellious fashion revolution? Contact us now for a chat that will change your wardrobe forever!</p>
            <div class="mbr-section-btn item-footer">
              <a href="" class="btn item-btn btn-primary display-7">Explore</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section data-bs-version="5.1" class="slider4 mbr-embla cid-u9yL7euB0p" id="gallery-13-u9yL7euB0p">
  
  
  <div class="container-fluid">
    
    <div class="row">
      <div class="col-12">
        <div class="embla position-relative" data-skip-snaps="true" data-align="center" data-contain-scroll="trimSnaps" data-loop="true" data-auto-play="true" data-auto-play-interval="5" data-draggable="true">
          <div class="embla__viewport">
            <div class="embla__container">
              <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                <div class="slide-content">
                  <div class="item-img">
                    <div class="item-wrapper">
                      <img src="assets/images/pp1.jpg" alt="Mobirise Website Builder" title="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                <div class="slide-content">
                  <div class="item-img">
                    <div class="item-wrapper">
                      <img src="assets/images/pp2.jpeg" alt="Mobirise Website Builder" title="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                <div class="slide-content">
                  <div class="item-img">
                    <div class="item-wrapper">
                      <img src="assets/images/IMG-20240411-WA0017.jpg" alt="Mobirise Website Builder" title="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                <div class="slide-content">
                  <div class="item-img">
                    <div class="item-wrapper">
                      <img src="assets/images/IMG-20240411-WA0019 (1).jpg" alt="Mobirise Website Builder" title="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                <div class="slide-content">
                  <div class="item-img">
                    <div class="item-wrapper">
                      <img src="assets/images/IMG-20240411-WA0021 (1).jpg" alt="Mobirise Website Builder" title="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="embla_button embla_button--prev">
            <span class="mobi-mbri mobi-mbri-arrow-prev" aria-hidden="true"></span>
            <span class="sr-only visually-hidden visually-hidden">Previous</span>
          </button>
          <button class="embla_button embla_button--next">
            <span class="mobi-mbri mobi-mbri-arrow-next" aria-hidden="true"></span>
            <span class="sr-only visually-hidden visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>



<section data-bs-version="5.1" class="contacts4 map1 cid-u9yL7ew3dF" id="contacts-3-u9yL7ew3dF">
<div class="main_wrapper">
		<div class="b_wrapper">
			<div class="container-fluid">
				<div class="row justify-content-start">
					<div class="col-md-5 col-lg-4 item-wrapper">
                        <h5 class="cardTitle mbr-fonts-style mb-2 display-5">
                            <strong>Contact Us</strong>
                        </h5>
                        <ul class="list mbr-fonts-style display-7">
                            <li class="mbr-text item-wrap">
                            Phone:                                
                            <a href="tel:123-456-7890" target="blank" class="text-black">123-456-7890</a></li>

                            <li class="mbr-text item-wrap">WhatsApp: 
                            <a href="https://wa.me/7235952121" class="text-black">7245673421</a></li> 

                            <li class="mbr-text item-wrap">                            
                            Email:
                            <a href="mailto:info@rentanddonate.com" class="text-black">tanisha.2023ca104@mnnit.ac.in</a>                        
                            </li>

                            <li class="mbr-text item-wrap">                        
                            Address:
                            Allahabad India
                            </li>

                            <li class="mbr-text item-wrap">
                            Working Hours:
                            Mon-Fri: 9am-5pm
                            </li>
                        </ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section data-bs-version="5.1" class="footer2 cid-u9yL7ewJws" once="footers" id="footer-5-u9yL7ewJws">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 center mt-2 mb-3">
                <p class="mbr-fonts-style copyright mb-0 display-7">© 2024 Rent &amp; Donate. All Rights Reserved.</p>
            </div>
            <div class="col-12 col-lg-6 center">
                <div class="row-links mt-2 mb-3">
                    <ul class="row-links-soc">
                        <li class="row-links-soc-item mbr-fonts-style display-7">
                            <a href="#" class="text-white">About</a>
                        </li><li class="row-links-soc-item mbr-fonts-style display-7">
                            <a href="#" class="text-white">Services</a>
                        </li><li class="row-links-soc-item mbr-fonts-style display-7">
                            <a href="#" class="text-white">Blog</a>
                        </li><li class="row-links-soc-item mbr-fonts-style display-7">
                            <a href="#" class="text-white">Contact</a>
                        </li></ul>
                </div>
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
  <script src="assets/vimeoplayer/player.js"></script>
  <script src="assets/masonry/masonry.pkgd.min.js"></script>
  <script src="assets/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="assets/embla/embla.min.js"></script>
  <script src="assets/embla/script.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
</body>
</html>