<?php

include 'config/function.php';

if (!isset($_SESSION)) 
{
    session_start();
}
if(isset($_SESSION['username']))
{
header("location:templates/brief");
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

<body style="background-image: url('sirRommel.jpg'); background-size:cover; background-repeat: no-repeat; object-fit: cover; opacity: 0.9; width:100%; height:100%;" alt="Rommel" class="responsive">


<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  
 <a href="index" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Home</a>
 <a href="index" style="color:white;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">
     Login</a>
 <a href="#" style="color:white;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">
      Privacy</a>
 <a href="about" style="color:white;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">About Us</a>
 <a href="index#contact" style="color:white;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact Us</a>
 </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
    <a href="index" style="color:white;" class="w3-bar-item w3-button">Login</a>
    <a href="#" style="color:white;" class="w3-bar-item w3-button">Privacy</a>
    <a href="about" style="color:white;" class="w3-bar-item w3-button">About Us</a>
    <a href="index#contact" style="color:white;" class="w3-bar-item w3-button">Contact Us</a>
    
  </div>
</div>
<h2 style="color:white; text-align:center; margin-top:100px;">Nokarin Travel and Tours</h2>


<center>
<form method="post" style="width:320px;">
  <div class="container">
    <h1> Registration</h1>
    <hr>

    <label for="email"><b> Name</b></label><br>
    <input type="text" placeholder="Name" name="name" id="name" style="width:300px;" required>
<br>
    <label for="psw"><b> Address</b></label><br>
    <input type="text" placeholder="Address" name="address" id="address" style="width:300px;" required>
<br>
    <label for="psw-repeat"><b>Contact Number</b></label><br>
    <input type="text" placeholder="Contact Number" name="contactnumber" id="contactnumber" style="width:300px;" required>
    <hr>
	<div class="custom-select" style="width:200px;">
    <select name="regtype" required>
    <option value="0">REGISTER AS</option>
    <option value="3">Operator</option>
    <option value="2">Client</option>
	<option value="1">Nokarin Officer</option>

  </select>
</div>
<?php
	if(isset($_POST['submitreg']))
{
   reg_operator();
}
?>
	<hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
	

    <button type="submit" name="submitreg" class="registerbtn" onclick="SetName()">Register</button>
  </div>
  
</form>

</center>
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

var cont = document.getElementById("contactnumber").value;	
sessionStorage.setItem("Contact", cont);

var addr = document.getElementById("address").value;	
sessionStorage.setItem("Address", addr);
	
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

var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

</html>
