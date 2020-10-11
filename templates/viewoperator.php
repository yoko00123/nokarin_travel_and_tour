<?php 
include '../config/function.php';
include '../config/sessionData.php';
include '../config/connection.php';
include '../config/userdata.php';


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
<title>View Operator at Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
</head>
<body onload="callModal()">

<?php include 'header.php'; ?>

<?php
	
	$sql3 = "SELECT vehicle_color, PLATE_NUMBER, BODY_TYPE FROM `toperator` WHERE ID = $id";
	$result3 = mysqli_query($db, $sql3);
	$row3 = mysqli_fetch_assoc($result3);
	$PLATE_NUMBER = $row3['PLATE_NUMBER'];
	$BODY_TYPE = $row3['BODY_TYPE'];
	
	$sql8 = "SELECT FirstName, LastName, ContactNumber FROM `nokarin_drivers` WHERE ID_Operator = $id";
    $result8 = mysqli_query($db, $sql8);
    if (mysqli_num_rows($result8) > 0) {
	
?>
  
  <div id="id01" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-large w3-display-topright">&times;</span>
        <h4>View Trip Ticket</h4>
      </header>
  
      <form method="POST" class="w3-container" action="#">
        <div class="w3-section">
		
          <label for="clientname"><b>Client Name</b></label>
		  <select class="w3-input w3-border w3-margin-bottom" name="clients" required>
          <?php myClientName(); ?>			
          </select>
		  
		  <label for="clientname"><b>My Drivers</b></label>
		  <select class="w3-input w3-border w3-margin-bottom" name="mydrivers" >
          <?php mydrivers(); ?>
          </select>
		  
		  
          <label><b>Requester Name</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Requester Name" name="requestern" required>
          <input class="w3-button w3-block w3-green w3-section w3-padding" formaction="
		  <?php echo '../fpdf/tripticketperemp?opID='.$id;?>" value="View" type="submit">
          
        </div>
</form>

      <footer class="w3-container w3-teal">
        <p>Nokarin Form 2020</p>
      </footer>
    </div>
  </div>
	<?php }else { ?>
<div id="id01" class="w3-modal w3-animate-opacity">
    <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-large w3-display-topright">&times;</span>
         <p style="margin:20px;">No driver available.<br><a href="members">Back<a></p>     
	 </header>
</div>
	<?php } ?>	


<?php include 'footer.php'; ?>

<script>
function callModal() {
document.getElementById('id01').style.display='block';	
}
</script>

</body>
</html>
