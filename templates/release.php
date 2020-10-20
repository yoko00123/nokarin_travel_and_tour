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
<title>Home at Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>


</head>
<body>

<?php include 'header.php'; ?>

<div class="row">
  
  <div class="main">
    <h2>RELEASE</h2>
<div class="w3-container w3-white" style="margin-bottom:10px; ">
<button class="accordion">Version 1.0.0.0 | Development Start - July 20, 2020</button>
<div class="panel">
  <p>Fixing bugs and mobile compatibility issues.
  </p>
</div>
</div>
  </div>
</div>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

<?php include 'footer.php'; ?>

</body>
</html>
