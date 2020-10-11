<?php

include 'config/function.php';

if (!isset($_SESSION)) 
{
    session_start();
}    
if(isset($_POST['submitLogin']))
{
   login();
}
if(isset($_POST['submitreg']))
{
   reg_operator();
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Nokarin Travel and Tour</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
  include 'style.php';
 ?>
</head>

<body style="background-image: url('sirRommel.jpg'); background-size:cover;  object-fit: cover; opacity: 0.9; width:100%; height:100%;" alt="Rommel" class="responsive">

<h2 style="color:white;">Nokarin Travel and Tour</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="Username" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="Password">
        
      <button type="submit" name="submitLogin" style="font-size:24px;">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>




<form method="post" style="width:450px;">
  <div class="container">
    <h1>Operator Registration</h1>
    <hr>

    <label for="email"><b>Operator Name</b></label><br>
    <input type="text" placeholder="Operator Name" name="name" id="name" style="width:400px;" required>
<br>
    <label for="psw"><b>Operator Address</b></label><br>
    <input type="text" placeholder="Operator Address" name="address" id="address" style="width:400px;" required>
<br>
    <label for="psw-repeat"><b>Contact Number</b></label><br>
    <input type="text" placeholder="Contact Number" name="contactnumber" id="contactnumber" style="width:400px;" required>
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" name="submitreg" class="registerbtn" onclick="SetName()">Register</button>
  </div>
  
</form>

</body>
<footer class="w3-container w3-padding-32 w3-theme-d1 w3-center" style="width:100%;">
  <h4>Follow Us</h4>
  <a class="w3-button w3-large w3-teal" href="https://www.facebook.com/nokarintravelandtours/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Twitter"><i class="fa fa-twitter"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-google-plus"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Instagram"><i class="fa fa-instagram"></i></a>
  <a class="w3-button w3-large w3-teal w3-hide-small" href="javascript:void(0)" title="Linkedin"><i class="fa fa-linkedin"></i></a>
</footer>

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
</script>

</html>
