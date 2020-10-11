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
<title>Trip Approval Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include '../css/style.php'; ?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
</style>
</head>
<body>

<?php include 'header.php'; ?>
<center><form method="post" styl="margin:10px;">

<label for="IsActive" style="font-size:12px; color:#615550;"><b>IsActive</b></label>
<input type="checkbox" name="IsActive" id="IsActive" value="0">

<label for="isexpired" style="font-size:12px; color:#615550; "><b>IsExpired</b></label>
<input type="checkbox" name="isexpired" id="isexpired" value="0">
<br>
<input type="submit" value="Search" name="Search" style="cursor:pointer; background-color:gray; color:white;  padding: 7px; font-family:Arial; border-radius:15px;">
    </form></center>


<div style="overflow-x:auto;">
<?php	
if(isset($_POST['Search']))
{
$IsActive = $_POST['IsActive'];
$isexpired = $_POST['isexpired'];
trip_approval($IsActive, $isexpired);
}	
?>

</div>
<script>

var checkbox = document.querySelector("input[name=IsActive]");

checkbox.addEventListener( 'change', function() {
    if(this.checked) {
  document.getElementById("IsActive").value = 1;
    } else {
        	document.getElementById("IsActive").value = 0;	
    }
});

var checkbox2 = document.querySelector("input[name=isexpired]");

checkbox2.addEventListener( 'change', function() {
    if(this.checked) {
  document.getElementById("isexpired").value = 1;
    } else {
        	document.getElementById("isexpired").value = 0;	
    }
});

</script>

<?php include 'footer.php'; ?>

</body>
</html>
