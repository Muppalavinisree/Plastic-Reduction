<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="srp.css">
    <link rel="stylesheet" href="videos.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
</head>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <a href="#" class="logo">videos on plastic<span>.</span></a>
        </nav>
    </header>
<
<script>
fetch('navbar.php')
    .then(response => response.text())
    .then(data => document.querySelector('header').innerHTML = data);
    fetch('footer.php')
    .then(response => response.text())
    .then(data => document.querySelector('footer').innerHTML = data);


    </script>


    <?php  include 'navbar.php'; ?>
    <div class="container">
    <div class="box">
        <iframe  width="560"  height="315"  src="https://www.youtube.com/embed/iO3SA4YyEYU?si=zhJOw4DnWX6iGvyl"  title="YouTube video player" style="border: none;"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"  referrerpolicy="strict-origin-when-cross-origin"  allowfullscreen>
        </iframe>
    </div>
    <div class="box">
        <iframe  width="560" height="315"  src="https://www.youtube.com/embed/_6xlNyWPpB8?si=baqPWleSdmg6ItUK"   title="YouTube video player" style="border: none;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"   referrerpolicy="strict-origin-when-cross-origin"  allowfullscreen>
        </iframe>
    </div>
    <div class="box">
        <iframe   width="560"  height="315"  src="https://www.youtube.com/embed/Q9EVT9tD34U?si=i9M1oSp2s6mFSRRj"  title="YouTube video player"  style="border: none;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"     allowfullscreen>
        </iframe>
    </div>
    <div class="box">
        <iframe   width="560"  height="315"   src="https://www.youtube.com/embed/-dk3NOEgX7o?si=Lz8P5WlJCQUujlI2"  title="YouTube video player"   style="border: none;"   allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"  referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>
    </div>
</div>



    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="col-one">
                        <h4>Plastic <span>Reduction</span></h4>
                        <p>Address: JNTUA COLLEGE OF ENGINEERING</p>
                        <p>Contact No: <a href="tel: +91 7816034607">+91 7816034607</a></p>
                        <p>Email: <a href="mailto:plasticmanagement@gmail.com">plasticmanagement@gmail.com</a></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-two">
                        <h4>Important Links</h4>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li><a href="aboutplastic.php">About </a></li>
                            <li><a href="videos.php">Videos</a></li>
                            <li><a href="solution.php">Solution</a></li>
                            <li><a href="community.php">Community</a></li>
                            <li><a href="project/user_page.php">MyShop</a></li>
                            <li><a href="contactus.php">Contact Us</a></li>
                            <li><a href="index.php">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-three">
                        <h4>Social Media</h4>
                        <div class="social">
                            <a href="https://www.facebook.com/"><img src="f.jpg" alt="Facebook"></a>
                            <a href="https://www.instagram.com/"><img src="i.jpg" alt="Instagram"></a>
                            <a href="https://www.youtube.com/"><img src="y.jpg" alt="YouTube"></a>
                            <a href="https://twitter.com/?lang=en-in"><img src="t.jpg" alt="Twitter"></a>
                            <a href="https://mail.google.com/mail/u/0/?ogbl"><img src="g.jpg" alt="Gmail"></a>
                        </div>
                    </div>
                    <p class="foot">Copyright &copy; 2024 | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="srp.js"></script>
    
    </body>
   
</html>
