<?php include "includes/functions.php"; ?>
<?php $info = getRenterInfo(); ?>
<?php if(!$_SESSION['login']){header("Location:index.html");} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Texturina&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?php if(strpos($_GET['name']," ")!=false){echo "Hello!! ".substr($_GET['name'],0,strpos($_GET['name'],' '));}else{echo "Hello!! ".$_GET['name'];}?></title>
</head>
<body>
    <div class="overlay"></div>
    <div id="delete_layout">
        <div id="question_box">
            <h3 class="confirm">Are you sure you want to delete your profile?</h3>
            <div class="button_container"><button id="delete_btn">Delete</button><button id="cancel_btn">Cancel</button></div>
        </div>
    </div>
    <div id="top-message" style="display: <?php if(isset($_SESSION['refreshed'])){echo "none";}else{echo "block";$_SESSION['refreshed']=true;}?>;z-index:100;position: fixed;top: 0;left:0;right:0;width:50%;background-color: rgb(39, 231, 39);text-align: center;margin:auto;color: #fff;font-weight: bolder;">
            Welcome back!! <?php if(strpos($_GET['name']," ")!=false){echo substr($_GET['name'],0,strpos($_GET['name'],' '));}else{echo $_GET['name'];}?>
        </div>
    <section class='login-body'></section>
        <div class="login_menu menu">
          <nav>
             <div class='brand'><strong>GOJO</strong>.com</div>
              <ul class='header-menu'>
                  <li><a id="delete_menu" class="header-link" href="">Delete Profile</a></li>
                  <li><a class="header-link" href="index.php?logout">Log out</a></li>
              </ul>
               <div class="burger_icon"></div>
          </nav>
    </div>
        <section>
                <form class='login-form' action="<?php updateRenter($info['renter_password'],$info['renter_house_picture']); ?>" method="POST" enctype="multipart/form-data" id="registration-form">
                    <div style="display:none;position: absolute;top:15.7em;right:21.7em;width:300px;background-color: rgb(211, 22, 22);text-align: center;padding:7px;" id="warning">
                            <h3 style="margin:0;color:#fff;">Incorrect Phone number</h3>
                    </div>
                    <label class="headline-label" for='name' >Change Your Name:</label>
                    <input id="contact-name" class='input-style' placeholder="Enter your name" name="name" value="<?php echo $info['renter_name'];?>" required/>
                    <label class="headline-label" for='email'>Change Your Email:</label>
                    <input type="email" class='input-style' placeholder="Enter your email address" id="email" name="email" value="<?php echo $info['renter_email'];?>" required>
                    <label class="headline-label" for='phone'>Change Your Phone Number</label>
                    <div>
                        <input type="text" style="height:40px;width:54px;border-style:none;border-radius:2px 0 0 2px;background-color: #fff;" value="  +251" disabled><input id="phone" type="tel" class='input-style' style="border-radius: 0 2px 2px 0;width:240px; margin:0;" placeholder="Enter phone number" name="phone" value="<?php echo $info['renter_phone'];?>" required>
                    </div>
                    <label class="headline-label" for='password'>Change Your Password:</label>
                    <input id="password" type="password" class='input-style' placeholder="Unchanged" name="login_password" >
                    <label class="headline-label" for='conf-pass'>Confirm Password:</label>
                    <input id="conf-pass" type="password" class='input-style' placeholder="Unchanged">
                    <label class="headline-label" for="city">Change City:</label>
                    <input id="city" class='input-style' type="text" placeholder="Enter your city name" name="city" value="<?php echo $info['renter_city'];?>" required/>
                    <label class="headline-label" for="location">Change Specific area name:</label>
                    <input id="area" class='input-style' type="text" placeholder="Enter the specific name of your area" name="area" value="<?php echo $info['renter_area'];?>" required/>
                    <label class="headline-label" for='beds'>Change Number of Beds</label>
                    <input id="beds" type="number" class='input-style' placeholder="Enter the number of beds" name="beds" value="<?php echo $info['renter_beds'];?>" required>
                    <label class="headline-label" for='basic_utility'>Change Electricity and Water Status</label>
                    <select name="utility" id="basic" class="input-style" style="width:300px;" required>
                        <option value="Yes" <?php if($info['renter_infrustructure']=="Yes") echo "selected"?>>Yes</option>
                        <option value="No" <?php if($info['renter_infrustructure']=="No") echo "selected"?>>No</option>
                    </select>
                    <label class="headline-label" for='beds'>Change transportation accessiblity</label>
                    <select name="transportation" id="transportation" class="input-style" style="width:300px" required>
                        <option value="Yes" <?php if($info['renter_transportation']=="Yes") echo "selected"?>>Yes</option>
                        <option value="No" <?php if($info['renter_transportation']=="No") echo "selected"?>>No</option>
                    </select>
                    <label class="headline-label">Change Rent:</label>
                    <input class="input-style" type="number" name="rent_range" placeholder="Enter your Ideal monthly rent" value="<?php echo $info['renter_price'];?>" required>
                    <div id="image-container">
                        <?php $images = explode(',',$info['renter_house_picture']);?>
                        <img class="house_pics" width="220" src="house_images/<?php echo $images[0];?>" alt="Your house picture" id="image1" />
                        <img class="house_pics" width="220" src="house_images/<?php echo $images[1];?>" alt="Your house picture" id="image2"/>
                        <img class="house_pics" width="220" src="house_images/<?php echo $images[2];?>" alt="Your house picture" id="image3"/>
                    </div>    
                    <label class="headline-label" for="picture">Change Picture of the house:</label>
                    <input id="picture" class='input-style file' type="file" accept="image/*" name="images[]" multiple />
                    <button id='register' class="submit-btn" type='submit' name="update">Update!</button>
                </form>
        </section>
    <script src="libs/jquery/jquery.min.js"></script>
        <script src="libs/waypoint/jquery.waypoints.min.js"></script>
        <script src="scripts/login.js"></script>
</body>
</html>