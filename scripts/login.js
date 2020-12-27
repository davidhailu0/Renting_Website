$("#top-message").delay(4000).fadeOut(1000);
if (document.getElementById("picture")){
     document.getElementById("picture").addEventListener("change", (e) => {
          if(e.target.files.length==3){
               Array.from(e.target.files).forEach((img,ind)=>{
                    const url = URL.createObjectURL(img);
                    document.getElementById("image"+(ind+1)).src = url;
               });
               document.getElementById("image-container").style.display = "flex";
               document.getElementById("image-container").style.columnGap = "10px";
               document.getElementById("image-container").style.justifyContent = "center";
          }
     });
}
if(document.getElementById('password')){
     document.getElementById('password').addEventListener('change',(e)=>{
          if (document.getElementById('password').value != document.getElementById('conf-pass').value && document.getElementById('conf-pass').value){
                    document.getElementById("warning").children[0].textContent = "The Passwords don't match";
                    document.getElementById("warning").style.display = "block";
                    document.getElementById("warning").style.top = "15em";
               }
          else if (document.getElementById('password').value == document.getElementById('conf-pass').value){
                    document.getElementById("warning").style.display = "none";
               }
     });
     document.getElementById('conf-pass').addEventListener('change', (e) => {
          if (document.getElementById('password').value != document.getElementById('conf-pass').value && document.getElementById('password').value) {
               document.getElementById("warning").children[0].textContent = "The Passwords don't match";
               document.getElementById("warning").style.display = "block";
          }
          else if (document.getElementById('password').value == document.getElementById('conf-pass').value) {
               document.getElementById("warning").style.display = "none";
          }
     });
}
document.getElementById("registration-form").addEventListener("submit",(e)=>{
     if (e.target.checkValidity() &&(document.getElementById("warning").style.display=="none")){
          document.forms['registration-form'].submit();
     }
     else{
          e.preventDefault();
          return false;
     }
});
if (document.getElementById("phone")){
     document.getElementById("phone").addEventListener("change", () => {
          if (!document.getElementById("phone").value.match(/^9\d{8}$|^\d{9}$/g)){
               document.getElementById("warning").style.top = "8.8em";
               document.getElementById("warning").children[0].textContent = "Invalid Phone Number";
               document.getElementById("warning").style.display = "block";
          }
          else{
               document.getElementById("warning").style.top = "12.1em";
               document.getElementById("warning").style.display = "none";
          }
     }); 
}
if(window.location.href.includes('success')){
     document.querySelector('#top-message').style.display = "block";
     document.querySelector('#top-message').textContent = "You have successfully Updated your Profile"
     $("#top-message").delay(4000).fadeOut(1000,function(){
          window.location.href = window.location.href.replace("&success", "");
     });
}
if (document.getElementById("email")) {
     document.getElementById("email").addEventListener('change', () => {
          if (document.getElementById("email").value) {
               const req = new XMLHttpRequest();
               req.onload = function () {
                    if (this.responseText.replaceAll(/[\s\r]/g, "") == 'true' && document.getElementById("email").value) {
                         document.getElementById("warning").children[0].textContent = "This Email has already been registered";
                         document.getElementById("warning").style.display = "block";
                         document.getElementById("warning").style.top = "5.6em";
                    }
                    else {
                         document.getElementById("warning").style.display = "none";
                    }
               }
               req.open("GET", `includes/functions.php?id=${window.location.href.substring(window.location.href.indexOf('=') + 1, window.location.href.indexOf('&'))}&emailCheck=` + document.getElementById("email").value, true);
               req.send();
          }
     });
}
if (document.getElementById("phone")) {
     document.getElementById("phone").addEventListener('change', () => {
          if (document.getElementById("phone").value) {
               const req = new XMLHttpRequest();
               req.onload = function () {
                    console.log(this.responseText);
                    if (this.responseText.replaceAll(/[\s\r]/g, "") == 'true') {
                         document.getElementById("warning").children[0].textContent = "This Phone number has already been registered";
                         document.getElementById("warning").style.display = "block";
                         document.getElementById("warning").style.top = "8.8em";
                    }
               }
               req.open("GET", `includes/functions.php?id=${window.location.href.substring(window.location.href.indexOf('=') + 1, window.location.href.indexOf('&'))}&phoneCheck=` + document.getElementById("phone").value, true);
               req.send();
          }
     });
}
if (document.getElementById("delete_menu")){
     document.getElementById("delete_menu").addEventListener('click', (e) => {
          e.preventDefault();
          document.getElementById("delete_layout").style.display = "block";
     });
}
if (document.getElementById("delete_btn")){
     document.getElementById("delete_btn").addEventListener("click",()=>{
        const req = new XMLHttpRequest();
        req.onload = function (){
             window.location.href = "http://localhost/gojo?deleted"; 
        }
          req.open("GET", "includes/functions.php?delete=" + window.location.href.substring(window.location.href.indexOf("=") + 1, window.location.href.indexOf("&")),true);
          req.send();
          document.getElementById("delete_layout").style.display = "none";
     });
}
if (document.getElementById('cancel_btn')){
     document.getElementById('cancel_btn').addEventListener("click",()=>{
          document.getElementById("delete_layout").style.display = "none";
     });
}
if (document.getElementById('delete_layout')) {
     document.getElementById('delete_layout').addEventListener("click", () => {
          document.getElementById("delete_layout").style.display = "none";
     });
}
if (document.getElementById('question_box')) {
     document.getElementById('question_box').addEventListener("click", (e) => {
          e.stopPropagation();
     });
}