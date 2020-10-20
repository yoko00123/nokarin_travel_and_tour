<?php 
include '../config/function.php';
include '../config/sessionData.php';
include '../config/userdata.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Trip Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>

<div class="w3-bar w3-black">
    <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'London')">Assign Trip Tickets</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Tokyo')">Used Trip Tickets</button>
   <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')">Expired Trip Tickets</button>
    
  </div>
  
  <div id="London" class="w3-container w3-border city">
    <?php mytripticket(); ?>
  </div>

  <div id="Paris" class="w3-container w3-border city" style="display:none">
 2 
  </div>

  <div id="Tokyo" class="w3-container w3-border city" style="display:none">
   3
  </div>
</div>

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>


<?php include 'footer.php'; ?>

</body>
</html>
