<?php 
include '../config/function.php';
include '../config/userdata.php';
include '../config/sessionData.php';

if(!isset($_SESSION['username']))
{
header("location:../index");
} 

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
		$_SESSION['ID'] = $id;
	}else{$id = 0;} 

if(isset($_POST['update_nokarintrip']))
{
update_nokarin_trip();
}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Driver at Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
</head>
  <style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
<body>

<?php include 'header.php'; ?>

<div class="container">
<?php
include('../config/connection.php');

$sql = "SELECT * FROM tTripTicketIssued WHERE ID = $id ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);


	if (mysqli_num_rows($result3) > 0) {
		
echo '<form method ="post">';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$Code = $row3['Code'];
	$ID_Operator = $row3['ID_Operator'];
	$StartDate = $row3['StartDate'];
	$EndDate = $row3['EndDate'];
    $FromLoc = $row3['FromLoc'];
	$ToLoc = $row3['ToLoc'];
	$Issuedby = $row3['Issuedby'];
	$Requester = $row3['Requester'];
	$ReqMobileNo = $row3['ReqMobileNo'];
	$ProjectName = $row3['ProjectName'];
	
	$IsActive = $row3['IsActive'];
	$IsExpire = $row3['IsExpire'];
	
	
	$sql8 = "SELECT Operator_Name FROM `toperator` WHERE ID = $ID_Operator";
	$result8 = mysqli_query($db, $sql8);
	$row = mysqli_fetch_assoc($result8);
	$Operator_Name = $row['Operator_Name'];
	
echo '<input type="hidden" name="userupdate" value="'.$_SESSION['username'].'">';

echo '<input type="hidden" name="did" value="'.$id.'">';
echo ' 

        <div class="row">  
		<div class="col-25">
        <label for="Operator_Name">Operator Requested</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$Operator_Name.'" style="background-color:gray;color:white;" name="Operator_Name" readonly>
		</div></div>


        <div class="row">  
		<div class="col-25">
        <label for="tcode">Code</label>
		</div>
		<div class="col-75">
        <input type="text" value="'.$Code.'" name="tcode" style="background-color:gray;color:white;" readonly>
		</div></div>
			
			
		<div class="row">  
		<div class="col-25">
        <label for="StartDate">Start Date</label>
		</div>
		<div class="col-75">	
		<input type="text" value="'.$StartDate.'" name="StartDate">
		</div></div>
		
		<div class="row">  
		<div class="col-25">
        <label for="EndDate">End Date</label>
		</div>
		<div class="col-75">
        <input type="text" value="'.$EndDate.'" name="EndDate">
		</div></div>
		
		<div class="row">  
		<div class="col-25">
        <label for="FromLoc">From Loc</label>
		</div>
		<div class="col-75">
        <input type="text" value="'.$FromLoc.'" name="FromLoc">
		</div></div>
		
		<div class="row">  
		<div class="col-25">
        <label for="ToLoc">To Loc</label>
		</div>
		<div class="col-75">
        <input type="text" value="'.$ToLoc.'" name="ToLoc">
		</div></div>
		
		
		<div class="row">  
		<div class="col-25">
        <label for="Issuedby">Issued by</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$Issuedby.'" name="Issuedby">
		</div></div>
		
		<div class="row">  
		<div class="col-25">
        <label for="Requester">Requester</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$Requester.'" name="Requester">
		</div></div>
			
		
		<div class="row">  
		<div class="col-25">
        <label for="ReqMobileNo">Requester Mobile No</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$ReqMobileNo.'" name="ReqMobileNo">
		</div></div>
		
		<div class="row">  
		<div class="col-25">
        <label for="ProjectName">Project Name</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$ProjectName.'" name="ProjectName">
		</div></div>
		
		
		<div class="row">  
		<div class="col-25">
        <label for="IsActive">IsActive</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$IsActive.'" name="IsActive">
		</div></div>
		
		
		<div class="row">  
		<div class="col-25">
        <label for="IsExpire">IsExpire</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$IsExpire.'" name="IsExpire">
		</div></div>';
		
		
		
	
		
		echo '<div class="row">
        <input type="submit" name="update_nokarintrip" value="SAVE" style="background-color:green; color:white; padding:15px; margin:10px; border-radius:25px; cursor:pointer; font-weight:bold; font-family: Comic Sans;">
        </div>';

}
echo '
</form>
';
}
else
{
echo '<p style="font-size:12px; color:green">No data found.</p>'; 
}
?>
</div>



<?php include 'footer.php'; ?>

</body>
</html>
