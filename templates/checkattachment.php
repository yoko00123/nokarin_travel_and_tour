<?php 
include '../config/function.php';
include '../config/sessionData.php';
include '../config/userdata.php';
include('../config/connection.php');

if(!isset($_SESSION['username']))
{
header("location:../index");
}  
	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
		$_SESSION['ID'] = $id;
	}else{$id = "error";} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Check Attachment Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>

<?php
  include '../style.php';
 ?>
  
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: green;
  font-size: 18px;

}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

hr {
margin:0px;	
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>
<body>

<?php include 'header.php'; ?>

<?php

	$sql8 = "SELECT * FROM `toperator` WHERE ID = $id";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	
	$Operator_Name = $row8['Operator_Name'];
	$Make = $row8['Make'];
	$Year_Model = $row8['Year_Model'];
	$vehicle_color = $row8['vehicle_color'];
	$Series = $row8['Series'];
	$Chassis_Number = $row8['Chassis_Number'];
	$Engine_Number = $row8['Engine_Number'];
	$BODY_TYPE = $row8['BODY_TYPE'];
	$PLATE_NUMBER = $row8['PLATE_NUMBER'];
	$MV_FILE_NO = $row8['MV_FILE_NO'];
	$Van_Current_City_Location = $row8['Van_Current_City_Location'];
	$Copy_of_ORCR = $row8['Copy_of_ORCR'];
	$Insurance_Name = $row8['Insurance_Name'];
	$Copy_of_Insurance = $row8['Copy_of_Insurance'];
	$Copy_of_Insurance1 = $row8['Copy_of_Insurance1'];


echo '

<div class="card w3-container w3-lime" style="margin-top:50px; font color:black; text-align:left;">
<br>
  <p class="title" style="font-family: Comic Sans; font-weight:bold; font-size:16px;">'.ucfirst($Operator_Name).'</p>
  ';
  echo '<br><h6 style="color:gray;">Vehicle Info</h6><hr>';
  echo '
  <p>Vehicle Brand: '.$Make.'</p>
  <p>Year Model: '.$Year_Model.'</p>
  <p>Vehicle Color: '.$vehicle_color.'</p>
  <p>Body Type: '.$BODY_TYPE.'</p>
  <p>Current Location: '.$Van_Current_City_Location.'</p><br>
  ';
  
  echo '<br><h6 style="color:gray;">Vehicle Details</h6><hr>
  <p>Series: '.$Series.'</p>
  <p>Chassis Number: '.$Chassis_Number.' </p>
  <p>Engine Number: '.$Engine_Number.'</p>
  <p>Plate Number: '.$PLATE_NUMBER.'</p>
  <p>MV File Number: '.$MV_FILE_NO.'</p>
  <p>Insurance Name: '.$Insurance_Name.'</p><br>
  ';
  
  echo '<br><h6 style="color:gray;">Attachments</h6><hr>
   
  <div class="">Copy of ORCR: <a href="/nokarin/templates/operatorreq/'.$Copy_of_ORCR.'" target="_blank">View</a></div>
  
  
  <div class="">Copy of Insurance : <a href="/nokarin/templates/operatorreq/'.$Copy_of_Insurance.'" target="_blank">View</a></div>
  
  <div class="">2nd Copy of Insurance : <a href="/nokarin/templates/operatorreq/'.$Copy_of_Insurance1.'" target="_blank">View</a></div>
  <br>
  
  
  <p><button style="background-color:green; color:white;">Approved</button></p>
  <p><button style="background-color:gray; color:white;">Hold</button></p>
</div>';

?>



<?php include 'footer.php'; ?>

</body>
</html>
