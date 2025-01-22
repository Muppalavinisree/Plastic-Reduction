<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
<header>
        <nav class="navbar">
            <a href="#" class="logo">videos on plastic<span>.</span></a>
        </nav>
    </header>
    <script>
        // Load navbar
        fetch('navbar.php')
            .then(response => response.text())
            .then(data => document.querySelector('header').innerHTML = data);

        // Load footer
       
    </script>

    <?php  include 'navbar.php'; ?>
    <div class="container">
        <div class="title">
            <h1>contact us</h1>
        </div>
        <div class="box">
            <div class="contact form">
                <h3>Send a Message</h3>
                <form action="https://formsubmit.co/vinisreemuppala248@gmail.com" method="POST">
                    <div class="formbox">
                        <div class="row50">
                            <div class="inputbox">
                                <span>Name</span>
                                <input type="text" name="name" placeholder="enter your name" required>
                            </div>
                            <div class="inputbox">
                                <span>location:</span>
                                <input type="text" name="location" placeholder="enter your location" required>
                            </div>
                        </div>
                        <div class="row50">
                            <div class="inputbox">
                                <span>email</span>
                                <input type="text" name="email" placeholder="@email.com" required>
                            </div>
                            <div class="inputbox">
                                <span>mobile</span>
                                <input type="text" name="phone" placeholder="+91" required>
                            </div>
                        </div>
                        <div class="row100">
                            <div class="inputbox">
                                <span>message</span>
                                <textarea name="message" placeholder="write your message here...."  required></textarea>
                            </div>
                            </div>
                            <div class="row100">
                                <div class="inputbox">
                                    <input type="submit" value="submit">
                                </div>
                                </div>
    

                    </div>
                </form>
            </div>
            <div class="contact info">
                <h3>contact info</h3>
                <div class="infobox">
                    <div>
                        <span><ion-icon name="location"></ion-icon></span>
                        <p>rlykodur,andhra pradesh<br>india</p>
                    </div>
                    <div>
                <span><ion-icon name="mail"></ion-icon></span>
                <a href="mailto:vinisreemuppala248@gmail.com">@email.com</a>
            </div>
            <div>
            <span><ion-icon name="call"></ion-icon></span>
            <a href="tel:+917816034607">+91</a>
        </div>
        <ul class="slm">
            <li><a href="https://www.facebook.com/"><ion-icon name="logo-facebook"></ion-icon></a></li>
            <li><a href="https://twitter.com/?lang=en-in"><ion-icon name="logo-twitter"></ion-icon></a></li>
            <li><a href="https://mail.google.com/mail/u/0/?ogbl"><ion-icon name="logo-linkedin"></ion-icon></a></li>
            <li><a href="https://www.instagram.com/"><ion-icon name="logo-instagram"></ion-icon></a></li>
        </ul>
        </div>
        </div>



        <div class="contact map">
    <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30976.433078073707!2d79.3294390455457!3d13.95538237907468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bb2d49df40eed9b%3A0x7f24a3c53ac3c77!2sKoduru%2C%20Andhra%20Pradesh%20516101!5e0!3m2!1sen!2sin!4v1718956036462!5m2!1sen!2sin"title="Google Maps location of Koduru, Andhra Pradesh"  style="border:0;"   allowfullscreen=""   loading="lazy"    referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

            
        </div>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    
</body>

</html>
