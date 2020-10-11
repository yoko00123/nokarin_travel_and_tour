<?php 
include '../config/function.php';
include '../config/sessionData.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}  
if(isset($_POST['updatedriv']))
{
	//header("location:driversedit");
	
	$did = $_POST['did'];
     redi_update($did);
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
<body>

<?php include 'header.php'; ?>

    <div style="overflow-x:auto;">
	<?php nokarin_drivers();  ?>
  </div>


<?php include 'footer.php'; ?>

</body>
</html>
