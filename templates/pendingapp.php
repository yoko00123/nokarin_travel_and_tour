<?php 
include '../config/function.php';
include '../config/userdata.php';
include '../config/sessionData.php';
include '../config/checkifadmin.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Pending at Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>

<div class="row">

  <div class="main">
    <h2>Pending App</h2>
	<div style="overflow-x:auto;">
	<?php members_pending();  ?>
  </div>
  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
