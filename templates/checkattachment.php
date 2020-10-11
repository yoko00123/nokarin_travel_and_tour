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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'header.php'; ?>



<?php

	$sql8 = "SELECT Operator_Name, Year_Model, Engine_Number, BODY_TYPE, PLATE_NUMBER, Van_Current_City_Location, Copy_of_ORCR, Insurance_Name, Copy_of_Insurance, Copy_of_Insurance1 FROM `toperator` WHERE ID = $id";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	
	$Operator_Name = $row8['Operator_Name'];
	$Copy_of_ORCR = $row8['Copy_of_ORCR'];
	$Insurance_Name = $row8['Insurance_Name'];
	$Copy_of_Insurance = $row8['Copy_of_Insurance'];
	$Copy_of_Insurance1 = $row8['Copy_of_Insurance1'];

echo '
<div class="container">
  <a href="members" style="margin:10px;"> &lt;&lt; Back</a><h5>'.$Operator_Name.' attachments</h5>
   
  <div class="well well-sm">Copy of ORCR: <a href="/nokarin/templates/operatorreq/'.$Copy_of_ORCR.'" target="_blank">View</a></div>
  
  <div class="well well-sm">Insurance Name: '.$Insurance_Name.'</div>
  
  <div class="well well-sm">Copy of Insurance : <a href="/nokarin/templates/operatorreq/'.$Copy_of_Insurance.'" target="_blank">View</a></div>
  
  <div class="well well-sm">2nd Copy of Insurance : <a href="/nokarin/templates/operatorreq/'.$Copy_of_Insurance1.'" target="_blank">View</a></div>
  
</div>';

?>



<?php include 'footer.php'; ?>

</body>
</html>
