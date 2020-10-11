 
<?php 
include '../config/function.php';
include '../config/userdata.php';
include '../config/sessionData.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
} 	 
?>

 <!DOCTYPE html>
<html lang="en">
<head>
<title>Home at Nokarin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
 <!--<link rel="stylesheet" href="../css/bootstrap.min.css">-->
<?php include '../css/style.php'; ?>
<style>
body {
  font-family: Arial;
}

input[type=text], input[type=password] {
  width: 300px;
  padding: 12px 20px;
  margin: 8px 0;
  display: block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
</head>
<body>

<?php include 'header.php'; ?>


<div class="container">
<h4 style="color:gray;">Update Info</h4>
  <hr>
  <div class="container">
  <form action="" method="post">
    <input type="hidden" name="ID_User" value="<?php echo $ID; ?>">
    <label for="uname">Name</label>
    <input type="text" id="uname" name="uname" value="<?php echo $Name; ?>" placeholder="">

    <label for="Address">Address</label>
    <input type="text" id="Address" name="Address" value="<?php echo $Address; ?>" placeholder="">
	
	<label for="Contact">Contact Number</label>
    <input type="text" id="Contact" name="Contact" value="<?php echo $ContactNumber; ?>" placeholder="">
	
	<label for="Username">Username</label>
    <input type="text" id="Username" name="Username" value="" placeholder="<?php echo $username; ?>">
	
	<label for="Password">Password</label>
    <input type="password" id="Password" name="Password" value="" style="font-size:10px;" placeholder="Leave it blank if you don't want to change it.">
	
	<label for="Password2">Retype-Password</label>
    <input type="password" id="Password2" name="Password2" value="" placeholder="">

    <input type="submit" value="Update" name="UpdatemyInfo">
  </form>
</div>
<?php
if(isset($_POST['UpdatemyInfo']))
{
   update_my_nokarin_info();
} 
?>  
</div>

  <!-- Footer -->
<?php include 'footer.php'; ?> 	
  <!-- End page content -->


<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
</body>
</html>
