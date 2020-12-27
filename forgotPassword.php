<?php include "includes/functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Texturina&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Reset Password</title>
</head>
<body>
    <div class="overlay"></div>
    <section class='forgot-password'></section>
        <div class="login_menu menu">
          <nav>
             <div class='brand'><strong>GOJO</strong>.com</div>
              <ul class='header-menu'>
                  <li><a class="header-link" href="#">Sign up</a></li>
                  <li><a class="header-link" href="#">Back to Homepage</a></li>
              </ul>
              <div class="burger_icon"></div>
          </nav>
    </div>
        <form class='login-form' action="<?php resetLink();?>" method="POST" id="forgot_password_form">
                    <label class="headline-label" for='name' >Enter Your Email:</label>
                    <input id="contact-name" class='input-style' type="email" placeholder="Enter your Email" name="reset_email" required/>
                    <button id='send_link' class="submit-btn" type='submit' name="reset">Send me the Reset link!</button>
                </form>
    <script src="libs/jquery/jquery.min.js"></script>
        <script src="scripts/login.js"></script>
</body>
</html>