<?php 
include '../config/function.php';
include '../config/sessionData.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
} 

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
		$_SESSION['ID'] = $id;
	}else{$id = "error";} 
	
 	if(isset($_POST['updateclient']))
{
   update_nokarin_client();
}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Clients Nokarin</title>
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

$sql = "SELECT * FROM nokarin_client WHERE ID = $id ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);


	if (mysqli_num_rows($result3) > 0) {
		
echo '<form method ="post">';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$Code = $row3['Code'];
	$Name = $row3['Name'];
	$Address = $row3['Address'];
	$TelephoneNo = $row3['TelephoneNo'];
	$MobileNo = $row3['MobileNo'];

	
echo '<input type="hidden" name="userupdate" value="'.$_SESSION['username'].'">';

echo '<input type="hidden" name="memid" value="'.$id.'">';

echo '   
        <div class="row">  
		<div class="col-25">
        <label for="Code">Code</label>
		</div>
		<div class="col-75">
        <input type="text" value="'.$Code.'" name="Code">
		</div></div>
		 
		<div class="row">  
		<div class="col-25">
		<label for="name">Name</label>
		</div>
		<div class="col-75">
        <input type="text" value="'.$Name.'" name="name">
		</div></div>
		 
		<div class="row">  
		<div class="col-25">
        <label for="address">Address</label>
		</div>
		<div class="col-75">
	    <input type="text" value="'.$Address.'" name="address">
	    </div></div>
	   
	   
	    <div class="row">  
		<div class="col-25">
	    <label for="contactnum">Telephone No</label>
		</div>
		<div class="col-75">
        <input type="text" value="'.$TelephoneNo.'" name="contactnum">
		</div></div>
		
		
		<div class="row">  
		<div class="col-25">
		<label for="mobilenum">Mobile</label>
		</div>
		<div class="col-75">
		<input type="text" value="'.$MobileNo.'" name="mobilenum">
		</div></div>
		
	<div class="row">
	<input type="submit" name="updateclient" value="SAVE" style="background-color:green; color:white; padding:15px; margin:10px; border-radius:25px; cursor:pointer; font-weight:bold; font-family: Comic Sans;">
	</div>
	';

}
echo '</form>';
}
else
{
echo '<p style="font-size:12px; color:green">No client yet.</p>'; 
}
?>
</div>
  


<?php include 'footer.php'; ?>

</body>
</html>
