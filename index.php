<?php include "includes/functions.php"; ?>
<?php 
    ob_start();
    session_start();
    if(isset($_GET['logout'])){
        $_SESSION['refreshed'] = NULL;
        $_SESSION['login'] = NULL;
        $_SESSION['name'] = NULL;
        $_SESSION['email'] = NULL;
    }
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Gojo house rent</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Texturina&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/animate/animate.css" />
    <script src="libs/jquery/jquery.min.js"></script>
</head>
<body>
    <div class="overlay"></div>
          <div class="menu">
          <nav>
             <div class='brand'><strong>GOJO</strong>.com</div>
              <ul class='header-menu'>
                  <li><a class="header-link" href="#">Home</a></li>
                  <li><a class="header-link" href="#about_gojo">About Us</a></li>
                  <li><a class="header-link" href="#register_login">Register/Login</a></li>
                  <li><a class="header-link" href="#contact_gojo">Contact Us</a></li>
              </ul>
              <div class="burger_icon"></div>
          </nav>
          </div>
          <?php
            if(isset($_SESSION['showMess'])){
                if($_SESSION['showMess']=='register'){
                    ?>
                     <div id="top-message" style="z-index:100;position: fixed;top: 0;left:0;right:0;width:50%;background-color: rgb(39, 231, 39);text-align: center;margin:auto;color: #fff;font-weight: bolder;">
                        You have been Registered Successfully, You can login and Update or delete your Information anytime
                    </div>
                    <script>$('#top-message').delay(2000).fadeOut(2000)</script>
                    <?php
                    $_SESSION['showMess']=NULL;
                }
                elseif($_SESSION['showMess']=='delete'){
                    ?>
                     <div id="top-message" style="z-index:100;position: fixed;top: 0;left:0;right:0;width:50%;background-color: rgb(39, 231, 39);text-align: center;margin:auto;color: #fff;font-weight: bolder;">
                        Profile Successfully deleted but we hate to see you go 😢😢
                    </div>
                    <script>$('#top-message').delay(2000).fadeOut(2000)</script>
                    <?php
                    $_SESSION['showMess']=NULL;
                }
                elseif($_SESSION['showMess']=='suggestion'){
                     ?>
                     <div id="top-message" style="z-index:100;position: fixed;top: 0;left:0;right:0;width:50%;background-color: rgb(39, 231, 39);text-align: center;margin:auto;color: #fff;font-weight: bolder;">
                        Thank you for you feedback 👍👍
                    </div>
                    <script>$('#top-message').delay(2000).fadeOut(3000)</script>
                    <?php
                    $_SESSION['showMess']=NULL;
                }
            }
        ?>
        <section class='header'>
          <div class='form-container'>
              <h1 class="headline">Get your Ideal home at an affordable price</h1>
              <form action="result.php" method="GET" id="search_form">
                    <input name="search-location" class="input-style" id="search-location" type="search" placeholder="Search by Location" autocomplete="off" required/>
                    <div id='hint_box'></div>
                    <select class="range-select" name="rent_range" id="range-select">
                        <option value="" selected disabled>Rent Range</option>
                        <option value="500-1000">500-1000 Birr</option>
                        <option value="1000-3000">1000-3000 Birr</option>
                        <option value="3000-5000">3000-5000 Birr</option>
                        <option value="Above 5000">Above 5000 birr</option>
                    </select>
                    <button class='submit-btn' type="search" name="search_btn" id="submit_btn">Search</button>
              </form>
          </div>
      </section>
        <section class='about-us' id="about_gojo">
            <h3 class='about-us-title'>About Gojo.com</h3>
            <hr/>
            <h2>Your best Companion</h2>
            <p class='about-us-para'>Gojo is a new start up company that offers the opportunity for house owners and renter to easily get what they want in the fastest time possible.
                So choose us we will be your best companion in finding a home where you and your family enjoy without any damage done to your pocket 😂😂.
            </p>
            <h2>Here is something that our customers got to say about us</h2>
            <div class="testimony-container">
                <div class="testimony_div animate__animated">
                    <img src='images/GettyImages-507244236.jpg' class="testimony"/>
                    <h4>Martha Simon</h4>
                    <p>I like the way the website is laid out and in addition to that I got the house I wanted</p>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <div class="testimony_div animate__animated">
                    <img src='images/lady-img.jpg' class="testimony"/>
                    <h4>Mekdes Tesfaye</h4>
                    <p>I like the way the website is laid out and in addition to that I got the house I wanted</p>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                </div>
                <div class="testimony_div animate__animated">
                    <img src='images/20191028_143738.jpg' class="testimony"/>
                    <h4>Dawit Hailu</h4>
                    <p>I like the way the website is laid out and in addition to that I got the house I wanted</p>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div>
            </div>
        </section>
        <section class='register' id="register_login">
            <div class="login">
                <h1 class='brand-title'>Login</h1>
                <form action="<?php verifyUser();?>" method="post" id="login_check">
                    <input class='input-style' id="login-user" type="text" placeholder="Enter your email" name="email" autocomplete="off" required>
                    <div class="usercheck">
                        <input class='input-style' id="login-password" type="password" name="password" placeholder="Enter your password" required>
                        <div id="incorrect"></div>
                    </div>
                    <div style="text-align:end;"><a href="forgotPassword.php" class="forgot">Need help? forgot password</a> </div>
                    <button type="submit" name="login_btn" class="submit-btn" id="login-btn">Login</button>
                </form>
            </div>
            <div class="form-input">
                <p class="headline-label">Don't have Account? Register and leave everything to us!!</p>
                <form class='registration' action="<?php addRenter();?>" method="POST" enctype="multipart/form-data" id="registration-form">
                    <div style="display:none;position: absolute;top:19em;right:6.1em;width:300px;background-color: rgb(211, 22, 22);text-align: center;padding:7px;" id="warning">
                            <h3 style="margin:0;color:#fff;">Incorrect Phone number</h3>
                    </div>
                    <label class="headline-label" for='name' >Name:</label>
                    <input id="contact-name" class='input-style' placeholder="Enter your name" name="name" required/>
                    <label class="headline-label" for='email'>Email:</label>
                    <div class="emailfield">
                        <input type="email" id="reg_email" class='input-style' placeholder="Enter your email address" name="email" required>
                         <div id='emailCheck'></div>
                    </div>
                    <label class="headline-label" for='phone'>Phone Number</label>
                    <div class="phonefield">
                        <input type="text" style="height:40px;width:54px;border-style:none;border-radius:2px 0 0 2px;background-color: #fff;" value="  +251" disabled><input id="phone" type="tel" class='input-style' style="border-radius: 0 2px 2px 0;width:240px; margin:0;" placeholder="Enter phone number" name="phone" required>
                        <div id="invalidPhone"></div>
                    </div>
                    <label class="headline-label" for='password'>Password:</label>
                    <input id="password" type="password" class='input-style' placeholder="Enter your password" name="password" required>
                    <label class="headline-label" for='conf-pass'>Confirm Password:</label>
                    <div class="passwordfield">
                    <input id="conf-pass" type="password" class='input-style' placeholder="Confirm your Password" required>
                        <div id="passwordCheck"></div>
                    </div>
                    <label class="headline-label" for="city">City:</label>
                    <input id="city" class='input-style' type="text" placeholder="Enter your city name" name="city" required/>
                    <label class="headline-label" for="location">Specific area name:</label>
                    <input id="area" class='input-style' type="text" placeholder="Enter the specific name of your area" name="area" required/>
                    <label class="headline-label" for='beds'>Number of Beds</label>
                    <input id="beds" type="number" class='input-style' placeholder="Enter the number of beds" name="beds" required>
                    <label class="headline-label" for='basic_utility'>Does the house has Electricity and Water?</label>
                    <select name="utility" id="basic" class="input-style" style="width:310px;" required>
                        <option value="" selected disabled>Select Yes or No</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <label class="headline-label" for='beds'>Is transportation accessible in your area?</label>
                    <select name="transportation" id="transportation" class="input-style" style="width:310px" required>
                        <option value="" selected disabled>Select Yes or No</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <label class="headline-label">Ideal Rent:</label>
                    <input class="input-style" type="number" name="rent_range" placeholder="Enter your Ideal monthly rent" required>
                    <div id="image-container" style="display:none;margin: 0;grid-column-start: 1;grid-column-end: span 2;">
                        <img src=" " alt="Your house picture" style="height: 150px;" id="image1"/>
                        <img src=" " alt="Your house picture" style="height: 150px;" id="image2"/>
                        <img src=" " alt="Your house picture" style="height: 150px;" id="image3"/>
                    </div>    
                    <label class="headline-label" for="picture">Picture of the house:</label>
                    <div class="picturefield">
                            <input id="picture" class='input-style file' type="file" accept="image/*" name="picture[]" multiple required/>
                            <div id="pictureCheck"></div>
                    </div>
                    <button id='register' class="submit-btn" type='submit' name="register">Register!</button>
                </form>
            </div>
        </section>
        <section class="contact-us" id="contact_gojo">
            <h3 class='about-us-title'>Contact us</h3>
            <hr/>
            <h2>if you want to work with us or give us suggestion</h2>
             <form class='contact-form' action="<?php addSuggestion(); ?>" method="POST">
                    <label class="headline-label color" for='name' >Name:</label>
                    <input id="name" class='input-style color' placeholder="Enter your name" name="Name" required/>
                    <label class="headline-label color" for='email'>Email:</label>
                    <input type="email" class='input-style color' placeholder="Enter your email address" name="Email" required>
                    <label class="headline-label color textarea-label" for="location">Suggestion:</label>
                    <textarea class="textarea" placeholder="Questions or Suggestions..." name="Content" required></textarea>
                    <button id="contact-btn" type='submit' name="contact_us">Contact us!</button>
                </form>
        </section>
        <footer>
            <div class="footer-section">
                <div>
                    <h3 class="footer-headline">Get to know us</h3>
                    <hr class="bottom_border"/>
                    <ul class='footer-list'>
                        <li><a class="header-link" href="#">Blog</a></li>
                        <li><a class="header-link" href="#">About Gojo</a></li>
                        <li><a class="header-link" href="#">Investor Relations</a></li>
                        <li><a class="header-link" href="#">Carreer</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-headline">Work with Us</h3>
                    <hr class="bottom_border"/>
                    <ul class='footer-list'>
                        <li><a class="header-link" href="#">Rent a house on Gojo</a></li>
                        <li><a class="header-link" href="#">Advertise your Products</a></li>
                        <li><a class="header-link" href="#">Rent Properties</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-headline">Need help?</h3>
                    <hr class="bottom_border"/>
                    <ul class='footer-list'>
                        <li><a class="header-link" href="#">FAQS</a></li>
                        <li><a class="header-link" href="#">Privacy</a></li>
                        <li><a class="header-link" href="#">Policy</a></li>
                        <li><a class="header-link" href="#">Terms</a></li>
                        <li><a class="header-link" href="#">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-headline">Contacts</h3>
                    <hr class="bottom_border"/>
                    <ul class='footer-list'>
                        <li><a class="header-link" href="#">FAQS</a></li>
                        <li><a class="header-link" href="#">Privacy</a></li>
                        <li><a class="header-link" href="#">Policy</a></li>
                    </ul>
                </div>
            </div>
                <hr class="footer-hr"/>
                <p class="trade-mark"><strong>GOJO</strong>.com Copyright &copy; 2020 Gojo rental Service</p>    
        </footer>
        <script src="libs/waypoint/jquery.waypoints.min.js"></script>
        <script src="scripts/main.js"></script>
</body>

</html>
