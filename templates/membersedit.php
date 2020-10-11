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
	
 	if(isset($_POST['updatemem']))
{
   update_nokarin_mem();
}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Members Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>



  
    <h2>MEMBERS</h2>
	<div style="overflow-x:auto;">
	<?php
include('../config/connection.php');

$sql = "SELECT ID, Operator_Name, Operator_Address, Contact_Number, status FROM toperator WHERE ID = $id ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);


	if (mysqli_num_rows($result3) > 0) {
		
echo '<form method ="post">';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$Operator_Name = $row3['Operator_Name'];
	$Operator_Address = $row3['Operator_Address'];
	$Contact_Number = $row3['Contact_Number'];
    $status = $row3['status'];
	
echo '<input type="hidden" name="userupdate" value="'.$_SESSION['username'].'">';

echo '<input type="hidden" name="memid" value="'.$id.'">';

echo ' 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="opname" type="text" placeholder="Operator Name" value="'.$Operator_Name.'">
    </div>
</div>';


echo ' 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-address-book"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="opadd" type="text" placeholder="Operator Name" value="'.$Operator_Address.'">
    </div>
</div>';


echo ' 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="opnumb" type="text" placeholder="Operator Name" value="'.$Contact_Number.'">
    </div>
</div>';

echo ' 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-check"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="opnumb" type="text" placeholder="Operator Name" value="'; 
		if ($status == 0){ echo 'PENDING'; }else if($status == 1){ echo 'APPROVED'; }
		else if($status == 2){ echo 'HOLD'; }else if($status == 3){ echo 'CANCELLED'; }else{} 
		echo '" name="status" readonly">
    </div>
</div>';

echo '<div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-gear"></i></div>
       <div class="w3-rest">
<label for="changeto" style="color:gray;">Change to</label>
 <select class="w3-input w3-border" name="changeto"><option value="1">APPROVED</option><option value="2">HOLD</option>
 <option value="3">CANCELLED</option></select>
  </div>
</div>
 ';
        
 echo '<input type="submit" name="updatemem" value="SAVE" style="background-color:green; color:white; padding:15px; margin:10px; border-radius:25px; cursor:pointer; font-weight:bold; font-family: Comic Sans;">';

}
echo '</form>';
}
else
{
echo '<p style="font-size:12px; color:green">No operator yet.</p>'; 
}


	?>
  </div>



<?php include 'footer.php'; ?>

</body>
</html>
