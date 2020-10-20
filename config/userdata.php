<?php
if (!isset($_SESSION)) {
  session_start();
}

include 'sessionData.php';
include('connection.php');

//$user = $_SESSION['loggedin_user'];

$sql = "SELECT ID, ID_UserType, account_number, IsActive, IsPending FROM `nokarin_users` WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

$ID = $row['ID'];
$ID_UserTypeLatest = $row['ID_UserType'];
$IsActiveuser = $row['IsActive'];
$IsPendinguser = $row['IsPending'];

if($ID_UserTypeLatest == 7) {
    
$sqld = "SELECT ID_Operator FROM `nokarin_drivers` WHERE FirstName = '$username'";
$resultd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($resultd);    
$idopd = $rowd['ID_Operator'];     
}

$acctnumber = $row['account_number'];

$sql2 = "SELECT * FROM `tNokarin_Profile` WHERE ID_NokarinUser = $ID";
$result2 = mysqli_query($db, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$Name = $row2['Name'];
$Address = $row2['Address'];
$ContactNumber = $row2['ContactNumber'];
$image = $row2['image'];

$sql3 = "SELECT * FROM `toperator` WHERE ID_NokarinUser = $ID";
$result3 = mysqli_query($db, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$countopid = mysqli_num_rows($result3);
if($countopid = 1){
$sidop = $row3['ID'];    
$myopname = $row3['Operator_Name'];
$myopadd = $row3['Operator_Address'];
$mycontact = $row3['Contact_Number'];

$myMake = $row3['Make'];
$myYear_Model = $row3['Year_Model'];
$myvehicle_color = $row3['vehicle_color'];
$mySeries= $row3['Series'];
$myChassis_Number = $row3['Chassis_Number'];
$myEngine_Number = $row3['Engine_Number'];
$myBODY_TYPE= $row3['BODY_TYPE'];
$myPLATE_NUMBER = $row3['PLATE_NUMBER'];
$myMV_FILE_NO= $row3['MV_FILE_NO'];
$myVan_Current_City_Location= $row3['Van_Current_City_Location'];
$myGarage_Location = $row3['Garage_Location'];
//$corcr = $row3['Copy_of_ORCR'];
$myInsurance_Name = $row3['Insurance_Name'];
//$copyofinsurance = $row3['Copy_of_Insurance'];
//$copyofinsurance1 = $row3['Copy_of_Insurance1'];

$sql4a = "SELECT FileName FROM `tnokarin_attachment` WHERE ID_Operator = $sidop AND FileType = 1 ORDER BY ID DESC LIMIT 1";
$result4a = mysqli_query($db, $sql4a);
$row4a = mysqli_fetch_assoc($result4a);
$corcr = $row4a['FileName'];

$sql4b = "SELECT FileName FROM `tnokarin_attachment` WHERE ID_Operator = $sidop AND FileType = 2 ORDER BY ID DESC LIMIT 1";
$result4b = mysqli_query($db, $sql4b);
$row4b = mysqli_fetch_assoc($result4b);
$copyofinsurance = $row4b['FileName'];

$sql4c = "SELECT FileName FROM `tnokarin_attachment` WHERE ID_Operator = $sidop AND FileType = 3 ORDER BY ID DESC LIMIT 1";
$result4c = mysqli_query($db, $sql4c);
$row4c = mysqli_fetch_assoc($result4c);
$copyinsurance1 = $row4c['FileName'];

}



$sql4 = "SELECT Name FROM `tusertype` WHERE ID = $ID_UserTypeLatest";
$result4 = mysqli_query($db, $sql4);
$row4 = mysqli_fetch_assoc($result4);
$usertype = $row4['Name'];

?>