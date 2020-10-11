<?php

include 'config/function.php';

if (!isset($_SESSION)) 
{
    session_start();
}
if(isset($_SESSION['username']))
{
header("location:templates/home");
}
if(isset($_POST['submitLogin']))
{
   reg_new_pass();
}



?>

<!DOCTYPE html>
<html>
<head>
<title>Nokarin Travel and Tours</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
  include 'style.php';
 ?>
</head>

<body style="background-image: url('sirRommel.jpg'); background-repeat: no-repeat; background-size:cover; object-fit: cover; opacity: 0.9; width:100%; height:100%;" alt="Rommel" class="responsive">


<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  
 <a href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Home</a>
 <a href="registration" style="color:white;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">
     Register</a>
 <a href="#" style="color:white;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">
      Privacy</a>
 <a href="about" style="color:white;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">About Us</a>
 <a href="index#contact" style="color:white;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact Us</a>
 </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
    <a href="registration" style="color:white;" class="w3-bar-item w3-button">Register</a>
    <a href="#" style="color:white;" class="w3-bar-item w3-button">Privacy</a>
    <a href="about" style="color:white;" class="w3-bar-item w3-button">About Us</a>
    <a href="index#contact" style="color:white;" class="w3-bar-item w3-button">Contact Us</a>
    
  </div>
</div>




  
  <form class="modal-content animate" method="post" style="width:300px;">
<div style="position:relative; text-align:center; ">
<h2 style="color:green;">Nokarin Travel and Tours</h2>
</div>
<h4 style="color:dodgerblue; font-size:16px; margin:10px;" id="loginmorito"></h4>
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="Username" id="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="New Password" name="Password" id="Password">
        
		<input type="checkbox" style="margin:10px;" onclick="showPass()">Show Password
		<br>
      <center><button type="submit" name="submitLogin" id="changepassnew" style="font-size:16px; width:80%;">Set Password</button>
   </center>

   
	
	</div>

  </form>


<footer class="w3-container w3-padding-32 w3-theme-d1 w3-center" style="width:100%;">
  <h4>Follow Us</h4>
  <a class="w3-button w3-large w3-teal" href="https://www.facebook.com/nokarintravelandtours/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Twitter"><i class="fa fa-twitter"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-google-plus"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Instagram"><i class="fa fa-instagram"></i></a>
  <a class="w3-button w3-large w3-teal w3-hide-small" href="javascript:void(0)" title="Linkedin"><i class="fa fa-linkedin"></i></a>
</footer>

</body>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function SetName() {

var name = document.getElementById("name").value;	
sessionStorage.setItem("Name", name);
	
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}


var usern = sessionStorage.getItem("Username");
if(usern != null){
document.getElementById("loginmorito").innerHTML = 'Your username is '+ usern + ' same with the plate number you provided. You may change it if you wish to.';
document.getElementById("uname").value = usern;
}else{
document.getElementById("changepassnew").disabled = true;
}

function showPass() {
  var x = document.getElementById("Password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


</html>
