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
<title>Setup@Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  color: gray;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

</style>

</head>
<body>

<?php include 'header.php'; ?>

<?php
include('../config/connection.php');

$sql = "SELECT * FROM tNokarin_Setting ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);


	if (mysqli_num_rows($result3) > 0) {
		
echo '<form method ="post">';

	echo '<table id="customers">
          <tr>
		  <th>ACTION</th>
          <th>Name</th>
          <th>SettingType</th>
          <th>Value</th>
          </tr>';
		
	while($row3 = mysqli_fetch_assoc($result3)){
		
	$id = $row3['ID'];
	$Name = $row3['Name'];
	$SettingType = $row3['SettingType'];
	$Value = $row3['Value'];
	echo '
	<tr>
	<td><a href ="systemsetupedit?ID='.$id.'">UPDATE</a></td>
    <td>'.$Name.'</td>
    <td>'.$SettingType.'</td>
    <td>'.$Value.'</td>
    </tr>';
	
	}
	echo '</form>';	
	}else{}
?>
<?php include 'footer.php'; ?>

</body>
</html>
