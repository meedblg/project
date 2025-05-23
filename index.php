<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>TaskManager</title>
<link rel="stylesheet" href="css/index.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>
<body>

<!---------------------------- Navbar section ------------------------>

<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">Lisya</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      
        <li class="nav-item">
          <a class="nav-link" href="#features">FEATURES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about-us">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#testimonials">TESTIMONIAL</a>
        </li>

      </ul>
      <div class="navbar-buttons">
        <a href="auth/login.php" class="btn btn-outline-primary">Sign In</a>
        <a href="auth/singup.php" class="btn btn-primary">Register</a>
      </div>
    </div>
</nav>

</section>

<!---------------------------- banner section ------------------------>

 <section id="banner" >
<div class="contrainer" >
<div class="row">
<div class="col-md-6">
<h1 class="promo-title">Your peace<br> begins with US</h1>
<p class="little-titre">With Lisya, planning your day becomes a mindful habit, not a mental burden.  Now let's explore all the amazing features.🚀</p>
<button type="button" class="btn btn-primary" onclick="window.location.href='../log in up/login.php'">Get started</button>

</div>
<div class="col-md-6 text-center">
<img src="images/home.png" class="img-fluid" />
</div>
</div>
</div>

<!------<img src="images/wave1.png" class="bottom-img"/>------>

 </section>

<!---------------------------- features section ------------------------>

<section id="features">
<div class="container text-center">
<div class="container text-center" >
<h1 class="title">WHAT WE DO</h1>
<div class="row text-center">
<div class="col-md-4 service">
<img src="images/tasks-management.png" class="features-img" data-aos="zoom-in"/>
<h4>Tasks organisation</h4>
<p>We help users break down their day with easy-to-use task lists and smart categorization.</p>
</div>
<div class="col-md-4 service">
<img src="images/time-management.png" class="features-img" data-aos="zoom-in"  />
<h4>Focus & Productivity</h4>
<p>Our reminder system and notifications keep you on track with deadlines and goals.</p>
</div>
<div class="col-md-4 service">
<img src="images/growth-chart (1).png" class="features-img" data-aos="zoom-in" data-aos-once="false" />
<h4>Progress Tracking</h4>
<p>Track your daily, weekly, and monthly achievements through clean dashboards and stats.</p>
</div>
<div class="col-md-4 service">
<img src="images/notification (6).png" class="features-img" data-aos="zoom-in" data-aos-once="false" />
<h4>Deadline Reminders</h4>
<p>Get notified before tasks are due so you never miss anything.</p>
</div>
<div class="col-md-4 service">
<img src="images/rating.png" class="features-img"data-aos="zoom-in" data-aos-once="false" />
<h4>Mobile-Friendly Interface</h4>
<p>Plan and manage on the go with a responsive design.</p>
</div>
<div class="col-md-4 service">
<img src="images/night-mode.png" class="features-img"data-aos="zoom-in" data-aos-once="false" />
<h4>Dark & Light Mode</h4>
<p>Choose a theme that suits your vibe.</p>
</div>
</div>
</div>

</section>

<!---------------------------- About us section ------------------------>

<section id="about-us">
<div class="container">
<h1 class="title text-center">WHY CHOSE US?</h1>
<div class="row">
<div class="col-md-6 about-us">
<p class="about-title">Why we are different?</p>
<ul>
  <li> We believe task management should feel effortless, not overwhelming.</li>
  <li>With a gentle design and calming colors, your productivity feels peaceful.</li>
  <li>We crafted every feature with care to suit your daily needs and flow</li>
  <li>It’s not just what you do, but how you feel while doing it that matters.</li>
  <li> We help you build habits, stay inspired, and grow your rhythm</li>
</ul>
</div>
<div class="col-md-6">
  <img src="images/Market Research.gif" class="img-fluid" alt="Market Research GIF">
</div>
</div>
</div>
</section>

<!---------------------------- Testimonials section ------------------------>

<section id="testimonials">
<div class="container">
<h1 class="title text-center">WHAT OUR CLIENTS SAY </h1>
<div class="row offset-1">
<div class="col-md-5 testimonials">
<p>"This app has completely changed the way I organize my tasks. Highly recommended!"</p>
<img src="images/user1.jpg">
<p class="user-details"><b>-Jane smith</b><br> co-founder at xyz</p>

</div>
<div class="col-md-5 testimonials">
<p>"Lisya completely transformed the way I manage my tasks it's simple, beautiful, and incredibly effective!"</p>
<img src="images/user2.jpg">
<p class="user-details"><b>-John doe</b><br> director at xyz</p>
</div>

</div>
</div>
</section>

<!---------------------------- Social Media section ------------------------>

<section id="social-media">
<div class="container text-center">
  <p>FIND US ON SOCIAL MEDIA</p>
  <div class="social-icons">
    <a href="#"><img src="images/facebook-icon.png"></a>
    <a href="#"><img src="images/instagram-icon.png"></a>
    <a href="#"><img src="images/twitter-icon.png"></a>
    <a href="#"><img src="images/whatsapp-icon.png"></a>
    <a href="#"><img src="images/linkedin-icon.png"></a>
    <a href="#"><img src="images/snapchat-icon.png"></a>
</div>
</div>
</section>

<!---------------------------- Footer section ------------------------>
<section id="footer">
<img src="images/wave2.png" class="footer-img"/>
<div class="container">
<div class="row">
<div class="col-md-4 footer-box">
<img src="images/demo-logo.png">
<p>Designed with care and simplicity, LISYA reflects a passion for clean visuals and smooth task management 🙌🚀.</p>
</div>
<div class="col-md-4 footer-box contact-box">
  <p class="g"><b>CONTACT US</b></p>
  <p><i class="fa fa-map-marker"></i> Trade Center , Rabat!</p>
  <p><i class="fa fa-phone"></i> +212 722 885282896</p>
  <p><i class="fa fa-envelope-o"></i> lisyaweb@gmail.com</p>

</div>
</div>
<hr>
<p class="copyright"> <br>© 2025 LISYA. All rights reserved.<br></p>
</div>
</section>

<!---------------------------- Smoothe scroll JS ------------------------>
<script src="js/smooth-scroll.js"></script>
<script>
	var scroll = new SmoothScroll('a[href*="#"]');
</script>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    once: false, 
    duration: 800,
    offset: 200, 
  });
</script>


</body>
</html>