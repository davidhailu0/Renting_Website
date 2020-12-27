<?php include_once "includes/functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Texturina&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/animate/animate.css" />
    <title>Search Result for <?php if(isset($_GET['search-location'])){echo $_GET['search-location'];}else{echo $_GET['q'];} ?></title>
</head>
<body>
    <div class="overlay" onclick="exitImages(this)">
        <div id="contact_info"></div>
    </div>
    <div class="menu-result menu">
          <nav>
             <div class='brand'><strong>GOJO</strong>.com</div>
              <ul class='header-menu'>
                  <li><a class="header-link" href="index.php">Go Back</a></li>
              </ul>
              <div class="burger_icon"></div>
          </nav>
    </div>
    <section class="result_page">
        <?php if(isset($_GET['search_btn'])||isset($_GET['q'])||isset($_GET['p'])){displayResult();} ?>
    </section> 
    <section class="pagination">
        <?php if(isset($_GET['search_btn'])||isset($_GET['q'])||isset($_GET['p'])){displayPagination();} ?>
    </section>
    <script>
        function showImages(elem){
            const id = elem.id;
            const req = new XMLHttpRequest();
            req.onload = function(){
                const images = this.responseText.split(',');
                const html = `<div onclick="exitImages(this)" style="height: 100vh;background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));z-index: 500;position: fixed;top: 0;bottom: 0;right: 0;left: 0;text-align: center;display: block;">
                                <div style="display: flex;flex-direction: column;justify-content: space-evenly;align-items:center;height:100vh;">
                                    <img width="400px" height="200" style="object-fit:contain" src="house_images/${images[0]}" alt="The House Picture">
                                    <img width="400px" height="200" style="object-fit:contain" src="house_images/${images[1]}" alt="The House Picture">
                                    <img width="400px" height="200" style="object-fit:contain" src="house_images/${images[2]}" alt="The House Picture">
                                    </div>
                            </div>`;
                            document.body.insertAdjacentHTML('afterbegin',html);
            }
            req.open("GET",'includes/functions.php?imageId='+id,true);
            req.send();
        }
        function exitImages(elem){
            elem.style.display = "none";
        }
        function displayContact(elem){
            const id = elem.id;
            const req = new XMLHttpRequest();
            req.onload = function(){
                const lists = this.responseText.split(',');
                const html = `<ul style="list-style-type:none;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;">
                                        <li><strong>Renter Name</strong>: ${lists[0]}</li>
                                        <li><strong>Renter Email</strong>: ${lists[1]}</li>
                                        <li><strong>Renter Phone Number</strong>: ${lists[2]}</li>
                                    </ul>`;
                                    if(document.getElementById('contact_info').firstChild){
                                        document.getElementById('contact_info').firstChild.remove();
                                    }
                            document.getElementById('contact_info').style.display = "flex";
                            document.getElementById('contact_info').insertAdjacentHTML('afterbegin',html);
                            document.querySelector('.overlay').style.display = "block";
            }
            req.open("GET",'includes/functions.php?renterId='+id,true);
            req.send();
            document.getElementById("contact_info").addEventListener('click',(e)=>{
            e.stopPropagation();
            });
        }
    </script>
<script src="libs/jquery/jquery.min.js"></script>
        <script src="libs/waypoint/jquery.waypoints.min.js"></script>
        <script src="scripts/main.js"></script>          
</body>
</html>