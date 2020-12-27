var header = $(".header").before($(".menu").clone().addClass("sticky"));
$(window).on("scroll",()=>{
     var scrollFromTop = $(window).scrollTop();
     $("body").toggleClass("scroll",scrollFromTop>125);
});
$(".animate__animated").waypoint(
     () => {
          $(".animate__animated").addClass("animate__bounceInUp");
     },{
          offset:"96%"
     }
);
if (document.getElementById("search-location")){
     document.getElementById("search-location").addEventListener('keyup', () => {
          if (document.getElementById("search-location").value) {
               const req = new XMLHttpRequest();
               req.onload = function () {
                    let keyArray = this.responseText.substring(0, this.responseText.length - 1).split(";");
                    let counter = 0;
                    if (document.querySelectorAll(".hint")) {
                         document.querySelectorAll(".hint").forEach(elem => {
                              elem.remove();
                         });
                    }
                    let count = document.getElementById("search-location").value.length;
                    let value = document.getElementById("search-location").value;
                    value = value.toLowerCase();
                    if(keyArray[0]!=""){
                         keyArray.forEach(key => {
                              let wordsArr = key.split(",");
                              let boldText;
                              let nonBoldText;
                              let html;
                              let anotherTemp;
                              if (wordsArr[0].toLowerCase().startsWith(value)) {
                                   if (document.querySelectorAll(".hint")) {
                                        let flag = false;
                                        document.querySelectorAll(".hint").forEach(elem => {
                                             if(elem.textContent.replaceAll(/[\s\r\n]/g,"").startsWith(wordsArr[0])){
                                                  flag = true;
                                             }
                                        });
                                        if(!flag){
                                             boldText = wordsArr[0].substring(0, count);
                                             anotherTemp = wordsArr[0].substring(count) + ", ";
                                             nonBoldText = wordsArr[1];
                                             html = `<a href="result.php?q=${wordsArr[0]}" onmouseover="changeColor(this)" onmouseout="changeToWhite(this)" class="hint" ><strong>${boldText}</strong>${anotherTemp}${nonBoldText}</a>`;
                                             document.getElementById("hint_box").insertAdjacentHTML('beforeend', html);
                                        }
                                   }
                                   else{
                                        boldText = wordsArr[0].substring(0, count);
                                        anotherTemp = wordsArr[0].substring(count) + ", ";
                                        nonBoldText = wordsArr[1];
                                        html = `<a href="result.php?q=${wordsArr[0]}" onmouseover="changeColor(this)" onmouseout="changeToWhite(this)" class="hint" ><strong>${boldText}</strong>${anotherTemp}${nonBoldText}</a>`;
                                        document.getElementById("hint_box").insertAdjacentHTML('beforeend', html);
                                   }
                              }
                              else {
                                   if (document.querySelectorAll(".hint")) {
                                        let flag = false;
                                        document.querySelectorAll(".hint").forEach(elem => {
                                             if (elem.textContent.replaceAll(/[\s\r\n]/g, "").startsWith(wordsArr[0])) {
                                                  flag = true;
                                             }
                                        });
                                        if (!flag) {
                                             nonBoldText = wordsArr[0] + ", ";
                                             boldText = wordsArr[1].substring(0, count);
                                             anotherTemp = wordsArr[1].substring(count);
                                             html = `<a  href="result.php?q=${wordsArr[0]}" onmouseover="changeColor(this)" onmouseout="changeToWhite(this)" class="hint">${nonBoldText}<strong>${boldText}</strong>${anotherTemp}</a>`;
                                             document.getElementById("hint_box").insertAdjacentHTML('beforeend', html);
                                        }
                                   }
                                   else{
                                        nonBoldText = wordsArr[0] + ", ";
                                        boldText = wordsArr[1].substring(0, count);
                                        anotherTemp = wordsArr[1].substring(count);
                                        html = `<a  href="result.php?q=${wordsArr[0]}" onmouseover="changeColor(this)" onmouseout="changeToWhite(this)" class="hint">${nonBoldText}<strong>${boldText}</strong>${anotherTemp}</a>`;
                                        document.getElementById("hint_box").insertAdjacentHTML('beforeend', html);
                                   } 
                              }
                         });
                    }
               }
               req.open("GET", "includes/functions.php?location=" + document.getElementById("search-location").value, true);
               req.send();
          }
          else {
               if (document.querySelectorAll(".hint")) {
                    document.querySelectorAll(".hint").forEach(elem => {
                         elem.remove();
                    })
               }
          }
     });
     document.body.addEventListener('click', () => {
          if (document.querySelectorAll(".hint")) {
               document.querySelectorAll(".hint").forEach(elem => {
                    elem.style.display = "none";
               })
          }
          document.getElementById('search-location').value = "";
     });                      
}
if (document.getElementById("search_form")){
     document.getElementById("search_form").addEventListener('submit', (e) => {
          if (document.getElementById("search-location").value || document.getElementById("range-select").value) {
               document.getElementById("search_form").submit();
          }
          else {
               e.preventDefault();
          }
     });
}
$('.login').waypoint(()=>{
     $('.login').addClass("animate__animated").addClass("animate__backInLeft");
},{
     offset:"97%"
});
$('.form-input').waypoint(() => {
     $('.form-input').addClass("animate__animated").addClass("animate__backInLeft");
}, {
     offset: "97%"
});
$('.contact-form').waypoint(() => {
     $('.contact-form').addClass("animate__animated").addClass("animate__flipInY");
}, {
     offset: "100%"
});
if (document.getElementById("picture")){
     document.getElementById("picture").addEventListener("change", (e) => {
          if(e.target.files.length==3){
               Array.from(e.target.files).forEach((img,ind)=>{
                    const url = URL.createObjectURL(img);
                    document.getElementById("image"+(ind+1)).src = url;
               });
               document.getElementById("pictureCheck").textContent = "";
               document.getElementById("image-container").style.display = "flex";
               document.getElementById("image-container").style.columnGap = "10px";
               document.getElementById("image-container").style.justifyContent = "center";
          }
          else{
               document.getElementById("pictureCheck").textContent = "Please Upload three pictures of the house";
               document.getElementById("pictureCheck").style.top = "2rem";
          }
     });
}
if(document.getElementById('password')){
     document.getElementById('password').addEventListener('change',(e)=>{
          if (document.getElementById('password').value != document.getElementById('conf-pass').value && document.getElementById('conf-pass').value){
                    document.getElementById("passwordCheck").textContent = "The Passwords don't match";
                    document.getElementById("phone").style.outlineColor = "rgb(211, 22, 22)";
                    document.getElementById("phone").style.outlineColor = "rgb(28, 219, 28)";
               }
          else if (document.getElementById('password').value == document.getElementById('conf-pass').value){
               document.getElementById("passwordCheck").textContent = "";
               }
     });
     document.getElementById('conf-pass').addEventListener('change', (e) => {
          if (document.getElementById('password').value != document.getElementById('conf-pass').value && document.getElementById('password').value) {
               document.getElementById("passwordCheck").textContent = "The Passwords don't match";
               document.getElementById("phone").style.outlineColor = "rgb(211, 22, 22)";
          }
          else if (document.getElementById('password').value == document.getElementById('conf-pass').value) {
               document.getElementById("passwordCheck").textContent = "";
               document.getElementById("phone").style.outlineColor = "rgb(28, 219, 28)";
          }
     });
}
if (document.getElementById("registration-form")){
     document.getElementById("registration-form").addEventListener("submit", (e) => {
          if (e.target.checkValidity() && (document.getElementById("warning").style.display == "none")) {
               document.forms['registration-form'].submit();
          }
          else {
               e.preventDefault();
               return false;
          }
     });
}
// if(window.location.href.includes('registration_successfull')){
//      document.querySelector('#top-message').style.display = "block";
//      $("#top-message").delay(4000).fadeOut(1000);
// }
if (document.getElementById("reg_email")) {
     document.getElementById("reg_email").addEventListener('change', () => {
          if (document.getElementById("reg_email").value) {
               const req = new XMLHttpRequest();
               req.onload = function () {
                    if (this.responseText.replaceAll(/[\s\r]/g, "") == 'true') {
                         document.getElementById("emailCheck").textContent = "This Email has already been registered";
                         document.getElementById("reg_email").style.outlineColor = "rgb(211, 22, 22)";
                    }
                    else{
                         document.getElementById("emailCheck").textContent = "";
                         document.getElementById("reg_email").style.outlineColor = "rgb(28, 219, 28)";
                    }
               }
               req.open("GET", "includes/functions.php?email=" + document.getElementById("reg_email").value, true);
               req.send();
          }
     });
}
if (document.getElementById("phone")) {
     document.getElementById("phone").addEventListener('change', () => {
          if (document.getElementById("phone").value) {
               const req = new XMLHttpRequest();
               req.onload = function () {
                    if (this.responseText.replaceAll(/[\s\r]/g, "") == 'true') {
                         document.getElementById("invalidPhone").textContent = "This Phone number has already been registered";
                         document.getElementById("phone").style.outlineColor = "rgb(211, 22, 22)";
                    }
                    else if (!document.getElementById("phone").value.match(/^9\d{8}$|^\d{9}$/g) && document.getElementById("phone").value) {
                         document.getElementById("invalidPhone").textContent = "Incorrect Phone Number";
                         document.getElementById("phone").style.outlineColor = "rgb(211, 22, 22)";
                    }
                    else {
                         document.getElementById("invalidPhone").textContent = "";
                         document.getElementById("phone").style.outlineColor = "rgb(28, 219, 28)";
                    }
               }
               req.open("GET", "includes/functions.php?phone=" + document.getElementById("phone").value, true);
               req.send();
          }
     });
}
// if (window.location.href.includes("?deleted")) {
//           document.getElementById("top-message").textContent = "Profile Successfully deleted but we hate to see you go 😢😢";
//           document.getElementById("top-message").style.display = "block";
//           $("#top-message").delay(3000).fadeOut(1000);
// }
$(".menu li a[href^='#']").click(function(e){
     e.preventDefault();
      const target = $(this.hash);
     if (document.querySelector(".overlay").style.display=="block"){
          document.querySelector(".overlay").style.display = "none";
          document.querySelector(".header .header-menu").style.transform = "translate3d(100%,0,0)";
     }
      if(target.length){
           $("html, body").animate({
                scrollTop: target.offset().top - 50
           }, 1000);
      }
});
if (document.querySelector(".burger_icon")){
     document.querySelector(".burger_icon").addEventListener('click',()=>{
          document.querySelector(".overlay").style.display = "block";
          if (document.getElementById('contact_info')){
               document.getElementById('contact_info').style.display = "none";
          }
          document.querySelector(".menu .header-menu").style.transform = "translate3d(0,0,0)";
     });
     if (document.querySelector(".header .burger_icon")){
          document.querySelector(".header .burger_icon").addEventListener('click', () => {
               document.getElementById('contact_info').style.display = "none";
               document.querySelector(".menu .header-menu").style.transform = "translate3d(0,0,0)";
          });
     }
}
document.querySelector(".overlay").addEventListener('click',(e)=>{
     document.querySelector(".overlay").style.display = "none";
     document.querySelector(".menu .header-menu").style.transform = "translate3d(100%,0,0)";
});
function changeColor(ele){
     ele.style.background = "rgb(180, 174, 174)";
}
function changeToWhite(elem){
     elem.style.background = "#fff";
}
if(window.location.href.includes('InvalidUser')){
     $('html, body').animate({
          scrollTop: $('section[id="register_login"]').offset().top - 50
     },1000);
     document.getElementById("incorrect").textContent = "Incorrect Email or password";
}
else{
     document.getElementById("incorrect").textContent = "";
}
// if (document.URL.includes("?Thanks")) {
//      document.getElementById("top-message").textContent = "Thank you for you feedback 👍👍";
//      document.getElementById("top-message").style.display = "block";
//      console.log(document.URL);
//      $("#top-message").delay(100,function(){
//           window.location.href = window.location.href.replace("?Thanks","");
          
//      }).fadeOut(1000);
// }
