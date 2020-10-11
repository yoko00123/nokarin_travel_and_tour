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
	
 	if(isset($_POST['updateuser']))
{
   update_user();
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
<?php
include('../config/connection.php');

$sql = "SELECT ID, username, password, IsActive FROM nokarin_users WHERE ID = $id ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);


	if (mysqli_num_rows($result3) > 0) {
		
echo '<form method ="post">
	<table>
    <tr>
	  <th>UserName</th>
      <th>Password</th>
      <th>Status</th>
	  <th>Change To</th>
	  <th></th>
	</tr>';
		
	while($row3 = mysqli_fetch_assoc($result3)){
		
	$id = $row3['ID'];
	$username = $row3['username'];
	$password = $row3['password'];
	$IsActive = $row3['IsActive'];

echo '<input type="hidden" name="userupdate" value="'.$_SESSION['username'].'">';

echo '<input type="hidden" name="uid" value="'.$id.'">';
echo '  <tr style="background-color:#AAF0D1; font-size:20px;" >
        <td><input type="text"  value="'.$username.'" name="username"></td>
        <td><input type="text" value="'.$password.'" name="password"></td>
        
		<td><input type="text" style="background-color:gray;color:white;" value="'; if ($IsActive == 0){ echo 'INACTIVE'; }else if($IsActive == 1){ echo 'ACTIVE'; }else{} 
		echo '" name="status" readonly></td>
		 <td><select name="changeto"><option value="0">INACTIVE</option><option value="1">ACTIVE</option></select></td>
        
        <td><input type="submit" name="updateuser" value="SAVE" style="background-color:green; color:white; padding:15px; margin:10px; border-radius:25px; cursor:pointer; font-weight:bold; font-family: Comic Sans;"></td>
        </tr>';

}
echo '</table></form>';
}
else
{
echo '<p style="font-size:12px; color:green">No user yet.</p>'; 
}
?>

 </div>

<?php include 'footer.php'; ?>

</body>
</html>
