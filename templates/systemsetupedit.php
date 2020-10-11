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


<div style="overflow-x:auto;">
	<?php
include('../config/connection.php');

$sql = "SELECT * FROM tNokarin_Setting WHERE ID = $id";
$result3 = mysqli_query($db, $sql);


	if (mysqli_num_rows($result3) > 0) {
		
echo '<form method ="post">';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$Name = $row3['Name'];
	$SettingType = $row3['SettingType'];
	$Value = $row3['Value'];
	
echo '<input type="hidden" name="settingID" value="'.$id.'">';

echo ' 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-gear"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="settingname" type="text" placeholder="Title"  value="'.$Name.'">
    </div>
</div>';


echo ' 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-gears"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="settingtype" type="text" placeholder="Setting Type" value="'.$SettingType.'" 
	  style="background-color:gray;color:white;" readonly>
    </div>
</div>';


echo ' 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-gear"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="settingvalue" type="text" placeholder="Value" value="'.$Value.'">
    </div>
</div>';


        
 echo '<input type="submit" name="updatesystemsetup" value="SAVE" style="background-color:green; color:white; padding:15px; 
 margin:10px; border-radius:25px; cursor:pointer; font-weight:bold; font-family: Comic Sans;">';

}
echo '</form>';
}
else
{
echo '<p style="font-size:12px; color:green">No operator yet.</p>'; 
}
?>
  </div>
<?php
   	if(isset($_POST['updatesystemsetup']))
{
   update_nokarin_system();
}	
?>



<?php include 'footer.php'; ?>

</body>
</html>
