<?php 
include '../config/function.php';
include '../config/sessionData.php';
include '../config/userdata.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Members at Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>

    <h2>Nokarin Staff</h2>
	<div style="overflow-x:auto;">
	<?php nokarin_staff();  ?>
  </div>


<?php include 'footer.php'; ?>

</body>
</html>
