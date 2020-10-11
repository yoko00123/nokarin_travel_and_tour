<?php 
include '../config/function.php';
include '../config/userdata.php';
include '../config/sessionData.php';

if(!isset($_SESSION['username']))
{
header("location:../index");
} 

$dids = $_SESSION['did'];

if(isset($_POST['updatedrivnow']))
{
update_nokarin_driv();
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

$sql = "SELECT ID, FirstName, LastName, ContactNumber, LicenseNo, Image, IsActive FROM nokarin_drivers WHERE ID = $dids ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);


	if (mysqli_num_rows($result3) > 0) {
		
echo '<form method ="post">';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$FirstName = $row3['FirstName'];
	$LastName = $row3['LastName'];
	$ContactNumber = $row3['ContactNumber'];
	$LicenseNo = $row3['LicenseNo'];
    $Image = $row3['Image'];
	$IsActive = $row3['IsActive'];
	
echo '<input type="hidden" name="userupdate" value="'.$_SESSION['username'].'">';

echo '<input type="hidden" name="did" value="'.$id.'">';
echo ' 

        <div class="row">  
		<div class="col-25">
        <label for="dimage">Image</label>
		</div>
		<div class="col-75">
        <input type="file" value="'.$Image.'" name="dimage">
		</div></div>
			
			
		<div class="row">  
		<div class="col-25">
        <label for="dfirstname">First Name</label>
		</div>
		<div class="col-75">	
		<input type="text" value="'.$FirstName.'" name="dfirstname">
		</div></div>
		
		<div class="row">  
		<div class="col-25">
        <label for="dlastname">Last Name</label>
		</div>
		<div class="col-75">
        <input type="text" value="'.$LastName.'" name="dlastname">
		</div></div>
		
		<div class="row">  
		<div class="col-25">
        <label for="dcontactnum">Contact Number</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$ContactNumber.'" name="dcontactnum">
		</div></div>
		
		<div class="row">  
		<div class="col-25">
        <label for="dstatus">Status</label>
		</div>
		<div class="col-75">
		<select name="dstatus" id="dstatus">
		<option value="0">InActive</option>
		<option value="1">Active</option>
		<option value="2">Hold</option>
		<option value="3">Cancelled</option>
		</select>
		
		<input type="text" value="'; if ($IsActive == 0){ echo 'InActive'; }
		else if($status == 1){ echo 'Active'; }
		else if($status == 2){ echo 'Hold'; }
		else if($status == 3){ echo 'Cancelled'; }
		else{} 
		echo '" name="dstatus2" readonly>
		</div></div>';
		
		
		echo '
		<div class="row">  
		<div class="col-25">
        <label for="dLicenseNo">License No</label>
		</div>
		<div class="col-75">
		<input type="text" name="dLicenseNo" value="'.$LicenseNo.'">
        </div></div>';
		
		echo '
		<div class="row">  
		<div class="col-25">
        <label for="dLicenseNo">Username</label>
		</div>
		<div class="col-75">
		<input type="text" style="background-color:gray; color:white;" name="u" value="'.$FirstName.'" readonly>
        </div></div>';
		
		
		echo '
		<div class="row">  
		<div class="col-25">
        <label for="dLicenseNo">Password(LicenseNo)</label>
		</div>
		<div class="col-75">
		<input type="text" style="background-color:gray; color:white;" name="p" value="'.$LicenseNo.'" readonly>
        </div></div>';
		
		echo '<div class="row">
        <input type="submit" name="updatedrivnow" value="SAVE" style="background-color:green; color:white; padding:15px; margin:10px; border-radius:25px; cursor:pointer; font-weight:bold; font-family: Comic Sans;">
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
