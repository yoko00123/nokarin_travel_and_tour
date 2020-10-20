<?php 
include '../config/function.php';
include '../config/userdata.php';
include '../config/sessionData.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Users Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>

    <h2>Users</h2>
<div style="overflow-x:auto;">
	<?php users_mem();  ?>
</div>


<?php include 'footer.php'; ?>

</body>
</html>
