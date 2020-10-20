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
<title>Members All Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>

<link rel="stylesheet" href="../css/modal.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'header.php'; ?>

    <h2>MEMBERS</h2>
	<div style="overflow-x:auto;">
	<?php members();  ?>
  </div>


<?php include 'footer.php'; ?>

</body>
</html>
