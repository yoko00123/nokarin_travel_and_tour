<?php

function update_nokarin_system(){
	
include('connection.php');

$id = $_POST['settingID'];
$settingname = $_POST['settingname'];
$settingvalue = $_POST['settingvalue'];


	$sql = "UPDATE tNokarin_Setting SET Name = ?, Value = ? WHERE ID = $id";
	$statement = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($statement, "ss",  $settingname, $settingvalue );
	mysqli_stmt_execute($statement);
	mysqli_stmt_close($statement);
	
	header("location: systemsetup");
	

	
}

function count_notif(){
include('connection.php');
include('userdata.php');	
$sqlc = "SELECT COUNT('ID') AS 'count' FROM `nokarin_transac` WHERE Receiver = $ID AND IsReceiver_View = 0";
$resultc = mysqli_query($db, $sqlc);
$row = mysqli_fetch_array($resultc);
$nc = $row['count'];
if($nc != '' && $nc > 0){
echo $nc.'  message unread';
}
}

function notif_list(){
	
include('connection.php');
include('userdata.php');


$sql8 = "SELECT * FROM `nokarin_transac` WHERE Receiver = $ID ORDER BY ID DESC LIMIT 10";

	$result8 = mysqli_query($db, $sql8);

	if (mysqli_num_rows($result8) > 0) {
	while($row8 = mysqli_fetch_assoc($result8)){
    $ID = $row8['ID'];
	$subj = $row8['Name'];
	$desc = $row8['Description'];
	$rid = $row8['Receiver'];
	$isv = $row8['IsReceiver_View'];
	
	
	
	$dt = $row8['DateTime'];
		
	echo ' <a '; if($isv == 0){ echo 'onclick="isviewed('.$ID.')"'; }  echo 'style="font-size:14px;'; if($isv == 0){ echo 'color:white; background-color:gray;'; }else{ echo 'color:#264E36; cursor:default;'; } echo '" href="#">';
	echo '<u>'.$subj.'</u><br><span style="font-size:10px;'; if($isv == 0){ echo 'color:white;'; }else{ echo 'color:#343148;'; } echo 'font-family: Arial;">'.$desc.'</span>';
	echo '<br><span style="'; if($isv == 0){ echo 'color:white;'; } else{ echo 'color:gray;'; } echo ' font-size:8px;">'.$dt.'</span></a>';
	echo '<input type="hidden" id="ID" value="'.$ID.'">';echo '<input type="hidden" id="rID" value="'.$rid.'">';
	}
	}else{
		
	echo ' <a style="font-size:8px; color:#264E36; cursor:default;" href="#">No activity yet.</a>';	
	}

}


function login(){
	
include('connection.php');

$myusername = $_POST['Username'];
$mypassword = $_POST['Password'];
//$mypassword = hash('sha256', $_POST['Password']);
      
	$sql8 = "SELECT username, IsFirstLog FROM `nokarin_users` WHERE username='$myusername' AND password = '$mypassword'";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	$username = $row8['username'];
	$isfirstlog = $row8['IsFirstLog'];
	
	if($isfirstlog == 0){
	$sqlupdatesurvey3 = "UPDATE nokarin_users SET IsFirstLog = 1 WHERE username = '$myusername' AND password = '$mypassword'";
	$statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	mysqli_stmt_execute($statementus3);
	mysqli_stmt_close($statementus3);
	}
	
$sql = "SELECT id, ID_UserType, IsActive, IsPending FROM nokarin_users WHERE username = '$myusername' AND password = '$mypassword'";
$result = mysqli_query($db,$sql);
$rowt = mysqli_fetch_assoc($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
$IsActive = $rowt['IsActive'];
$IsPending = $rowt['IsPending'];
$regtype = $rowt['ID_UserType']; 
 
if($count == 1 && $IsActive == 1 && $IsPending == 0)
{
$_SESSION['username'] = $username;

header("location: templates/home");		


}else if($count == 1 && $IsActive == 0 && $IsPending == 1){
	
$_SESSION['username'] = $username;

$_SESSION['regtype'] = $regtype;

header("location: templates/pending");			
} 
else
{
    
$error = "Your Login Name or Password is invalid";
echo "<script type='text/javascript'>alert('$error');</script>";
}
   
}

function reg_operator_fulldetails(){

include('connection.php');

	$opname = $_POST['nameop'];
	$contactop = $_POST['contactop'];
	$addressop = $_POST['addressop'];
	$Brand = $_POST['Brand'];
	$YearModel = $_POST['YearModel'];
	$vehicle_color = $_POST['vehicle_color'];
	$Series = $_POST['Series'];
	$Chassis_Number = $_POST['Chassis_Number'];
	$Engine_Number = $_POST['Engine_Number'];
	$Body_Type = $_POST['Body_Type'];
	$plate_number = $_POST['plate_number'];
	$MVFileNo = $_POST['MVFileNo'];
	$VanLocation = $_POST['VanLocation'];
	$ORCR = $_FILES['ORCR']['name'];
	$Insurance = $_POST['Insurance'];
	$copyinsurance = $_FILES['copyinsurance']['name'];
	$copyinsurance1 = $_FILES['copyinsurance1']['name'];


$temp = explode(".", $_FILES["ORCR"]["name"]);
$extension = end($temp);
$newfilename = time().rand().'-ORCR'.".".$extension;
move_uploaded_file(@$_FILES["ORCR"]["tmp_name"], "operatorreq/".$newfilename);

$tempa = explode(".", $_FILES["copyinsurance"]["name"]);
$extensiona = end($tempa);
$newfilenamea = time().rand().'-copyinsurance'.".".$extensiona;
move_uploaded_file(@$_FILES["copyinsurance"]["tmp_name"], "operatorreq/".$newfilenamea);


$tempb = explode(".", $_FILES["copyinsurance1"]["name"]);
$extensionb = end($tempb);
$newfilenameb = time().rand().'-copyinsurance1'.".".$extensionb;
move_uploaded_file(@$_FILES["copyinsurance1"]["tmp_name"], "operatorreq/".$newfilenameb);


$account_num = round(microtime(true) * 1000); 
	
	$sqlupdatesurvey3 = "UPDATE toperator SET Make=?, Year_Model=?, vehicle_color=?, Series=?, Chassis_Number=?, Engine_Number=?, BODY_TYPE=?, PLATE_NUMBER=?, MV_FILE_NO=?, Van_Current_City_Location=?, Copy_of_ORCR=?, Insurance_Name=?, COpy_of_Insurance=?, Copy_of_Insurance1=? WHERE Operator_Name = '$opname'";
	$statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	mysqli_stmt_bind_param($statementus3, "ssssssssssssss",  $Brand, $YearModel, $vehicle_color, $series, $Chassis_Number, $Engine_Number, $Body_Type, $plate_number, $MVFileNo, $VanLocation, $newfilename, $Insurance, $newfilenamea, $newfilenameb );
	mysqli_stmt_execute($statementus3);
	mysqli_stmt_close($statementus3);
	
	$sql10 = "SELECT ID FROM `toperator` WHERE Operator_Name = '$opname'";
	$result10 = mysqli_query($db, $sql10);
	$row10 = mysqli_fetch_assoc($result10);
	$opid = $row10['ID'];
	
	$sqli = "INSERT INTO tnokarin_attachment (FileName, ID_Operator) VALUES (?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "ss", $newfilename, $opid);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	
	$sqli = "INSERT INTO tnokarin_attachment (FileName, ID_Operator) VALUES (?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "ss", $newfilenamea, $opid);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	
	$sqli = "INSERT INTO tnokarin_attachment (FileName, ID_Operator) VALUES (?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "ss", $newfilenameb, $opid);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	
	/*
	$sqlupdatesurvey3 = "UPDATE toperator SET Make=?, Year_Model=?, vehicle_color=?, Series=?, Chassis_Number=?, Engine_Number=?, BODY_TYPE=?, PLATE_NUMBER=?, MV_FILE_NO=?, Van_Current_City_Location=?, Copy_of_ORCR=?, Insurance_Name=?, COpy_of_Insurance=?, Copy_of_Insurance1=?, Drivers_Name=?, CP_Contact_Number=?, Viber_Number=?, Facebook_or_Messenger_Name=?, 2nd_Driver_Name=?, CP_Contact_Number1=?, Viber_Number1=?, Facebook_or_Messenger_Name1=? WHERE Operator_Name = '$opname'";
	$statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	mysqli_stmt_bind_param($statementus3, "ssssssssssssssssssssss",  $Brand, $YearModel, $vehicle_color, $series, $Chassis_Number, $Engine_Number, $Body_Type, $plate_number, $MVFileNo, $VanLocation, $newfilename, $Insurance, $newfilenamea, $newfilenameb, $Driver_Name, $mobilenum, $vibernum, $fbms_name, $sndDriverName, $sndDCPNum,$sndDvibernum, $fbms_name2);
	mysqli_stmt_execute($statementus3);
	mysqli_stmt_close($statementus3);
		
    $sqli = "UPDATE nokarin_users SET username=?, password=? WHERE username = '$opname'";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "ss",  $plate_number, $plate_number);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);

*/
	$sqli = "INSERT INTO nokarin_users (username, password, ID_UserType, account_number) VALUES (?,?,3,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "sss", $plate_number, $plate_number, $account_num);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);

    $sql8 = "SELECT MAX(ID) as maxid FROM `nokarin_users`";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	$maxid = number_format($row8['maxid']);	
	
	$sqlupdatesurvey4 = "UPDATE toperator SET ID_NokarinUser=? WHERE Operator_Name = '$opname'";
	$statementus4 = mysqli_prepare($db, $sqlupdatesurvey4);
	mysqli_stmt_bind_param($statementus4, "i",  $maxid);
	mysqli_stmt_execute($statementus4);
	mysqli_stmt_close($statementus4);
	
	$sqlh = "INSERT INTO tNokarin_Profile (Name, Address, ContactNumber, ID_NokarinUser) VALUES (?,?,?,?)";
	$statementh = mysqli_prepare($db, $sqlh);
	mysqli_stmt_bind_param($statementh, "sssi", $opname, $addressop, $contactop, $maxid);
	mysqli_stmt_execute($statementh);
	mysqli_stmt_close($statementh);
	
    header("location: logout");
	
	
}

function update_operator_fulldetails(){
	
	include('connection.php');
	
	$idop = $_POST['idop'];
	$opname = $_POST['nameop'];
	$contactop = $_POST['contactop'];
	$addressop = $_POST['addressop'];
	$Brand = $_POST['Brand'];
	$YearModel = $_POST['YearModel'];
	$vehicle_color = $_POST['vehicle_color'];
	$Series = $_POST['Series'];
	$Chassis_Number = $_POST['Chassis_Number'];
	$Engine_Number = $_POST['Engine_Number'];
	$Body_Type = $_POST['Body_Type'];
	$plate_number = $_POST['plate_number'];
	$MVFileNo = $_POST['MVFileNo'];
	$VanLocation = $_POST['VanLocation'];
	//$ORCR = $_FILES['ORCR']['name'];
	//$copyinsurance = $_FILES['copyinsurance']['name'];
	//$copyinsurance1 = $_FILES['copyinsurance1']['name'];
	$Insurance = $_POST['Insurance'];
	$AttachmentType = $_POST['AttachmentType'];
	$image = $_FILES['image']['name'];
	
	if($AttachmentType == 1){
		$filetype = '-ORCR';
	}
	if($AttachmentType == 2){
		$filetype = '-copyinsurance';
	}
	if($AttachmentType == 3){
		$filetype = '-copyinsurance1';
	}
	
// if ((((@$_FILES["image"]["type"]=="image/jpeg")  ||  (@$_FILES["image"]["type"]=="application/msword") ||  (@$_FILES["image"]["type"]=="text/pdf") || (@$_FILES["image"]["type"]=="image/png") || 
   // (@$_FILES["image"]["type"]=="image/gif")) || (@$_FILES["image"]["type"]=="video/mp4")) && 
    // (@$_FILES["image"]["size"] < 15000000 )) // 5 mb 5000000 
// {

	
$temp = explode(".", $_FILES["image"]["name"]);
$extension = end($temp);
$newfilename = time().rand().$filetype.".".$extension;
move_uploaded_file(@$_FILES["image"]["tmp_name"], "operatorreq/".$newfilename);
/*
$tempa = explode(".", $_FILES["copyinsurance"]["name"]);
$extensiona = end($tempa);
$newfilenamea = time().rand().'-copyinsurance'.".".$extensiona;
move_uploaded_file(@$_FILES["copyinsurance"]["tmp_name"], "operatorreq/".$newfilenamea);


$tempb = explode(".", $_FILES["copyinsurance1"]["name"]);
$extensionb = end($tempb);
$newfilenameb = time().rand().'-copyinsurance1'.".".$extensionb;
move_uploaded_file(@$_FILES["copyinsurance1"]["tmp_name"], "operatorreq/".$newfilenameb);
*/

	$sqli = "INSERT INTO tnokarin_attachment (FileName, ID_Operator, FileType) VALUES (?,?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "sss", $newfilename, $idop, $AttachmentType);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	/*
	$sqli = "INSERT INTO tnokarin_attachment (FileName, ID_Operator) VALUES (?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "ss", $newfilenamea, $idop);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	
	$sqli = "INSERT INTO tnokarin_attachment (FileName, ID_Operator) VALUES (?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "ss", $newfilenameb, $idop);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	*/
	
	$sqlupdatesurvey3 = "UPDATE toperator SET Make=?, Year_Model=?, vehicle_color=?, Series=?, Chassis_Number=?, Engine_Number=?, BODY_TYPE=?, PLATE_NUMBER=?, MV_FILE_NO=?, Van_Current_City_Location=?, Copy_of_ORCR=?,
	Insurance_Name=?, COpy_of_Insurance=?, Copy_of_Insurance1=?, Operator_Name = ?, Operator_Address=?, Contact_Number =? WHERE ID = $idop";
	$statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	mysqli_stmt_bind_param($statementus3, "sssssssssssssssss",  $Brand, $YearModel, $vehicle_color, $series, $Chassis_Number, $Engine_Number,
	$Body_Type, $plate_number, $MVFileNo, $VanLocation, $newfilename, $Insurance, $newfilenamea, $newfilenameb, $opname, $addressop, $contactop );
	mysqli_stmt_execute($statementus3);
	mysqli_stmt_close($statementus3);
	
	 echo '<div class="alert alert-success">
     <strong>Updated</strong> Your information was updated.
     </div>';
//}
	
}

function count_orcr_attach() {
include('connection.php');
include('userdata.php');	
	$total = "SELECT COUNT(ID) as ID FROM `tnokarin_attachment` WHERE ID_Operator = $sidop AND FileType = 1";
	$result3 = mysqli_query($db, $total);
	$row3 = mysqli_fetch_assoc($result3);
	$idor = number_format($row3['ID']);
	if($idor == 1){
	echo $idor.') file';
	}if($idor > 1){
	echo $idor.') files';	
	}
}
function count_insurance_attach() {
include('connection.php');
include('userdata.php');	
	$total = "SELECT COUNT(ID) as ID FROM `tnokarin_attachment` WHERE ID_Operator = $sidop AND FileType = 2";
	$result3 = mysqli_query($db, $total);
	$row3 = mysqli_fetch_assoc($result3);
	$idor = number_format($row3['ID']);
	if($idor == 1){
	echo $idor.') file';
	}if($idor > 1){
	echo $idor.') files';	
	}
}
function count_insurance_attach1() {
include('connection.php');
include('userdata.php');	
	$total = "SELECT COUNT(ID) as ID FROM `tnokarin_attachment` WHERE ID_Operator = $sidop AND FileType = 3";
	$result3 = mysqli_query($db, $total);
	$row3 = mysqli_fetch_assoc($result3);
	$idor = number_format($row3['ID']);
	if($idor == 1){
	echo $idor.') file';
	}if($idor > 1){
	echo $idor.') files';	
	}
}

function send_announcement(){
	
	
include('connection.php');
include('userdata.php');

$announcementcontent = $_POST['announcementcontent'];
$tdriver = $_POST['sendtodriver'];


	$sql = "SELECT ID FROM `nokarin_transac` WHERE Description = '$announcementcontent'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
   if($count == 0) {

if($tdriver > 0 && $tdriver !=''){
	
	$sqli = "INSERT INTO nokarin_transac (Name, Description, Sender, Receiver) VALUES ('Operator',?,?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "sis", $announcementcontent,$ID,$tdriver);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	
	
}else{


if($announcementcontent !=''){
	$system = 0;
	$sqli = "INSERT INTO nokarin_transac (Name, Description, Sender, Receiver) VALUES ('Announcement',?,?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "sii", $announcementcontent,$system,$system);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	
echo '<div class="alert alert-success">
     <strong>Published!</strong> Announcement is created.
     </div>';	
}else{
	echo '<div class="alert alert-warning">
     <strong>Required</strong> No data inputted.
     </div>';	
}

}
	}else{
		
	echo '<div class="alert alert-info">
     <strong>Try to resubmit?</strong> Try another announcement.
     </div>';
		
	}
	
}

function reg_new_pass(){

include('connection.php');

$uname = $_POST['Username'];
$pass = $_POST['Password'];

	$sqlupdate = "UPDATE nokarin_users SET password=? WHERE username = '$uname'";
	$statementus4 = mysqli_prepare($db, $sqlupdate);
	mysqli_stmt_bind_param($statementus4, "s",  $pass);
	mysqli_stmt_execute($statementus4);
	mysqli_stmt_close($statementus4);
	
    header("location: index");
}

function request_trip(){
	
include('connection.php');

$roperator = $_POST['roperator'];

$requester = $_POST['requester'];
$requestermn = $_POST['requestermn'];
$Projectn = $_POST['Projectn'];

$drivern = $_POST['drivern'];
$locfrom = $_POST['locfrom'];
$locto = $_POST['locto'];
$sameadr = $_POST['sameadr'];	
$passgrcnt = $_POST['passgrcnt'];
$clients = $_POST['clients'];	


	$sqlh = "INSERT INTO tTripTicketIssued (ID_Operator, ID_Driver, FromLoc, ToLoc, IsOperatorDriver, PassengerCount, ID_Client, Requester, ReqMobileNo, ProjectName) VALUES (?,?,?,?,?,?,?,?,?,?)";
	$statementh = mysqli_prepare($db, $sqlh);
	mysqli_stmt_bind_param($statementh, "sssssiisss", $roperator, $drivern, $locfrom, $locto, $sameadr, $passgrcnt, $clients, $requester, $requestermn, $Projectn);
	mysqli_stmt_execute($statementh);
	mysqli_stmt_close($statementh);
	
	echo '<div class="alert alert-success"><strong>Success!</strong> Request sent successfully.</div>';
}

function update_user(){

include('connection.php');

$userupdate = $_POST['userupdate'];
$uid = $_POST['uid'];
$uname = $_POST['username'];
$pass = $_POST['password'];
$isactive = $_POST['changeto'];

	$sqlupdate = "UPDATE nokarin_users SET username=?, password=?,IsActive= $isactive, Editedby=? WHERE ID = $uid";
	$statementus4 = mysqli_prepare($db, $sqlupdate);
	mysqli_stmt_bind_param($statementus4, "sss",  $uname, $pass, $userupdate);
	mysqli_stmt_execute($statementus4);
	mysqli_stmt_close($statementus4);
	
    header("location: users");


}

function reg_operator(){

include('connection.php');
    
	$name = $_POST['name'];
    $address = $_POST['address']; 
    $contactnumber = $_POST['contactnumber']; 
	$regtype = $_POST['regtype'];	
    
	$sql = "SELECT ID FROM nokarin_users WHERE username = '$name'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	if($count == 1) {
		$error = "Your name is already taken";
		echo "<script type='text/javascript'>alert('$error');</script>";
    }else{
	
	$_SESSION['username'] = $name;
	if($regtype > 0){
	$_SESSION['regtype'] = $regtype;
	}
	if($regtype == 3){
    $sql3 = "INSERT INTO toperator (Operator_Name, Operator_Address, Contact_Number) VALUES (?,?,?)";
	$statement3 = mysqli_prepare($db, $sql3);
	mysqli_stmt_bind_param($statement3, "sss", $name, $address, $contactnumber);
	mysqli_stmt_execute($statement3);
	mysqli_stmt_close($statement3);	
	//header("location: templates/brief.php",  true,  301 );  exit;
	echo '<script>window.location.href = "templates/brief.php";</script>';
	}
	if($regtype != 3 && $regtype > 0){
    $account_num = round(microtime(true) * 1000); 
	
	$sqli = "INSERT INTO nokarin_users (username, password, ID_UserType, account_number) VALUES (?,?,?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "ssss", $name, $name, $regtype, $account_num);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);	
	
    $sql8 = "SELECT MAX(ID) as maxid FROM `nokarin_users`";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	$maxid = number_format($row8['maxid']);
	
    $sqlh = "INSERT INTO tNokarin_Profile (Name, Address, ContactNumber, ID_NokarinUser) VALUES (?,?,?,?)";
	$statementh = mysqli_prepare($db, $sqlh);
	mysqli_stmt_bind_param($statementh, "sssi", $name, $address, $contactnumber, $maxid);
	mysqli_stmt_execute($statementh);
	mysqli_stmt_close($statementh);
	//header("location: templates/brief.php",  true,  301 );  exit;
	echo '<script>window.location.href = "templates/brief.php";</script>';
	}
    
	}	
}



function redi_update($did){
	//$did = $_POST['did'];
	$_SESSION['did'] = $did;
	header("location:driversedit");
}


function nokarin_drivers() 
{
include 'userdata.php';
include('connection.php');

$sql2 = "SELECT ID, FirstName, LastName, ContactNumber, ID_Operator, LicenseNo FROM nokarin_drivers WHERE ID_Operator = $sidop ORDER BY ID DESC";
$result3b = mysqli_query($db, $sql2);
echo '<div class="table100 ver2 m-b-110"  style="overflow-x:auto;">
       <table data-vertable="ver2">';

	if (mysqli_num_rows($result3b) > 0) {
		
echo '

<thead>
    <tr class="row100 head">
	  <th class="column100 column1" data-column="column1">Action</th>
      <th class="column100 column2" data-column="column2">Full Name</th>
	  <th class="column100 column3" data-column="column3">Contact No</th>
      <th class="column100 column4" data-column="column4">License No</th>
    </tr>
	</thead>
	<tbody>
	';
		
	while($row3b = mysqli_fetch_assoc($result3b)){
	$id = $row3b['ID'];
	$FirstName = $row3b['FirstName'];
	$LastName = $row3b['LastName'];
	$Contact_Number = $row3b['ContactNumber'];
	$ID_Operator = $row3b['ID_Operator'];
	$LicenseNo = $row3b['LicenseNo'];
	
	
	$sql8 = "SELECT vehicle_color, PLATE_NUMBER, BODY_TYPE FROM `toperator` WHERE ID = $ID_Operator";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	$vehicle_color = $row8['vehicle_color'];
	$PLATE_NUMBER = $row8['PLATE_NUMBER'];
	$BODY_TYPE = $row8['BODY_TYPE'];

echo '
<form method="post">
<tr class="row100">
        <input type="hidden" name="did" value="'.$id.'">
		<td class="column100 column1" data-column="column1"><input type="submit" name="updatedriv" value="UPDATE"></td>
        <td class="column100 column2" data-column="column2">'.$FirstName.' '.$LastName.'</td>
		<td class="column100 column3" data-column="column3">'.$Contact_Number.'</td>
        <td class="column100 column4" data-column="column4">'.$LicenseNo.'</td>
        </tr></form>';

}
echo '';
}
else
{
echo '<p style="font-size:12px; color:green">No driver yet.</p>'; 
}	
echo '</tbody></table></div>';
}

function clients() 
{

include('connection.php');

$sql = "SELECT * FROM nokarin_client ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);
echo '<div class="table100 ver2 m-b-110"  style="overflow-x:auto;">
      <table data-vertable="ver2">';

	if (mysqli_num_rows($result3) > 0) {
		
echo '

<thead>
    <tr class="row100 head">
	  <th class="column100 column1" data-column="column1">Action</th>
      <th class="column100 column3" data-column="column3">Code</th>
	  <th class="column100 column3" data-column="column3">Name</th>
      <th class="column100 column4" data-column="column4">Contact Number</th>
    </tr>
	</thead>
	<tbody>
	';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$Code = $row3['Code'];
	$Name = $row3['Name'];
	$TelephoneNo = $row3['TelephoneNo'];
	

	
echo '
<tr class="row100">
        <td class="column100 column1" data-column="column1"><a href="clientsedit?ID='.$id.'">UPDATE</a></td>
        <td class="column100 column2" data-column="column2">'.$Code.'</td>
		<td class="column100 column2" data-column="column2">'.$Name.'</td>
        <td class="column100 column3" data-column="column3">'.$TelephoneNo.'</td></tr>';	
		
}
}else{
echo '<p style="font-size:12px; color:green">No client yet.</p>'; 
}	
echo '</tbody></table></div>';
}


function members() 
{

include('connection.php');

$sql = "SELECT * FROM toperator ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);
echo '<div class="table100 ver2 m-b-110"  style="overflow-x:auto;">
<table data-vertable="ver2">';

	if (mysqli_num_rows($result3) > 0) {
		
echo '

<thead>
    <tr class="row100 head">
	  <th class="column100 column1" data-column="column1">LOGIN</th>
	  <th class="column100 column1" data-column="column1">Action</th>
	  <th class="column100 column8" data-column="column8">View Attachment</th>
      <th class="column100 column2" data-column="column2">Operator Name</th>
      <th class="column100 column3" data-column="column3">Operator Address</th>
      <th class="column100 column4" data-column="column4">Contact Number</th>
	  <th class="column100 column5" data-column="column5">Status</th>
	  <th class="column100 column6" data-column="column6">Issue COL</th>
	  <th class="column100 column7" data-column="column7">Driver/s</th>
	  <th class="column100 column8" data-column="column8">Trip Ticket</th>
	  
	  
    </tr>
	</thead>
	<tbody>
	';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$Operator_Name = $row3['Operator_Name'];
	$Operator_Address = $row3['Operator_Address'];
	$Contact_Number = $row3['Contact_Number'];
	$status = $row3['status'];
	$vehicle_color = $row3['vehicle_color'];
	
	$PLATE_NUMBER = $row3['PLATE_NUMBER'];
	$BODY_TYPE = $row3['BODY_TYPE'];
	$Make = $row3['Make'];
	$Year_Model = $row3['Year_Model'];
	$Series = $row3['Series'];
	$Chassis_Number = $row3['Chassis_Number'];
	$Engine_Number = $row3['Engine_Number'];
	$MV_FILE_NO = $row3['MV_FILE_NO'];
	$ID_NokarinUser = $row3['ID_NokarinUser'];
	
	
	$sql10 = "SELECT username, password FROM `nokarin_users` WHERE ID = $ID_NokarinUser";
	$result10 = mysqli_query($db, $sql10);
	$row10 = mysqli_fetch_assoc($result10);
	$usernames = $row10['username'];
	$passwords = $row10['password'];
	
	$sql8 = "SELECT FirstName, LastName, ContactNumber FROM `nokarin_drivers` WHERE ID_Operator = $id AND TripTicketActive = 1";
	$result8 = mysqli_query($db, $sql8);
	//$row8 = mysqli_fetch_assoc($result8);
	

	
echo '


  <!-- Modal -->
  <div class="modal fade" id="myModal'.$ID_NokarinUser.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Login Details</h4>
        </div>
        <div class="modal-body">
          <p>Username: '.$usernames.'</p>
		  <p>Password: '.$passwords.'</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<tr class="row100">
        <td class="column100 column3" data-column="column3"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal'.$ID_NokarinUser.'">SHOW</button></td>
	    <td class="column100 column1" data-column="column1"><a href="membersedit?ID='.$id.'">UPDATE</a></td>
		<td class="column100 column1" data-column="column1"><a href="checkattachment?ID='.$id.'">CHECK</a></td>
        <td class="column100 column2" data-column="column2"><a href="viewoperator?ID='.$id.'">'.$Operator_Name.'</a></td>
        <td class="column100 column3" data-column="column3">'.$Operator_Address.'</td>
        <td class="column100 column4" data-column="column4">'.$Contact_Number.'</td>
		<td class="column100 column5" data-column="column5"><input type="text" style="color:#264E36; font-weight:bold;" value="'; if ($status == 0){ echo 'PENDING'; }else if($status == 1){ echo 'APPROVED'; }else if($status == 2){ echo 'HOLD'; }else if($status == 3){ echo 'CANCELLED'; }else{} 
		echo '" name="status" readonly></td>
		<td class="column100 column6" data-column="column6"><a target="_blank" href="../fpdf/renderCOL?opname='.$Operator_Name.'&opaddress='.$Operator_Address.'&bodytype='.$BODY_TYPE.'&platenumber='.$PLATE_NUMBER.'&make='.$Make.'&YearModel='.$Year_Model.'&Series='.$Series.'&chassisno='.$Chassis_Number.'&engineno='.$Engine_Number.'&mvfileno='.$MV_FILE_NO.'">View</a></td>';
		

	if (mysqli_num_rows($result8) > 0) {
		echo '<td class="column100 column7" data-column="column7">
		      <select name="drivers">';	   
	while($row8 = mysqli_fetch_assoc($result8)){
	$FirstName = $row8['FirstName'];
	$LastName = $row8['LastName'];
	$ContactNumber = $row8['ContactNumber'];
	 
	 echo '<option>'.$FirstName.' '.$LastName.'</option>';			
		
		}
		echo '</select></td>';
		echo '<td class="column100 column8" data-column="column8"><a target="_blank" href="../fpdf/tripticket?opid='.$id.'">View</a></td>';		
		
		}else{	
			
		echo '<td class="column100 column7" data-column="column7">No driver</td>';	
		echo '<td class="column100 column8" data-column="column8">-</td>';	
		}

echo '</tr>';	

}
echo '';
}
else
{
echo '<p style="font-size:12px; color:green">No operator yet.</p>'; 
}	
echo '</tbody></table></div>';
}


function nokarin_staff() 
{

include('connection.php');

$sql = "SELECT * FROM tNokarin_Profile ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);
echo '<div class="table100 ver2 m-b-110"  style="overflow-x:auto;">
<table data-vertable="ver2">';

	if (mysqli_num_rows($result3) > 0) {
		
echo '

<thead>
    <tr class="row100 head">
	 
      <th class="column100 column2" data-column="column2">Full Name</th>
      <th class="column100 column3" data-column="column3">Address</th>
      <th class="column100 column4" data-column="column4">Contact Number</th>
    </tr>
	</thead>
	<tbody>
	';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$Name = $row3['Name'];
	$Address = $row3['Address'];
	$Contact_Number = $row3['ContactNumber'];
echo '
<tr class="row100">
       
        <td class="column100 column2" data-column="column2">'.$Name.'</td>
        <td class="column100 column3" data-column="column3">'.$Address.'</td>
        <td class="column100 column4" data-column="column4">'.$Contact_Number.'</td>';
	
		

echo '</tr>';	

}
echo '';
}
else
{
echo '<p style="font-size:12px; color:green">No staff yet.</p>'; 
}	
echo '</tbody></table></div>';
}
//

function mydrivers(){
	
include('connection.php');
include 'userdata.php';

$sql8 = "SELECT ID, FirstName, LastName, ContactNumber FROM `nokarin_drivers` WHERE ID_Operator = $sidop";

	$result8 = mysqli_query($db, $sql8);

	if (mysqli_num_rows($result8) > 0) {
	while($row8 = mysqli_fetch_assoc($result8)){
	$id = $row8['ID'];
	$FirstName = $row8['FirstName'];
	$LastName = $row8['LastName'];
	$ContactNumber = $row8['ContactNumber'];
	echo '<option value="'.$id.'">'.$FirstName.' '.$LastName.'</option>';	
	}
	}else{}
}


function check_announcement() {
	
include('connection.php');	
include 'userdata.php';

$sql = "SELECT ID FROM `nokarin_transac` ORDER BY ID DESC";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
	$idn = $row['ID'];

if($ID_UserTypeLatest == 7) {	
$sqlt = "SELECT ID, Description, DateTime, ID_Operator FROM `nokarin_transac` WHERE (Receiver = $ID OR Name = 'Announcement' OR ID_Operator = $idopd) AND ID = $idn";	
}else{
$sqlt = "SELECT ID, Description, DateTime, ID_Operator FROM `nokarin_transac` WHERE (Receiver = $ID OR Name = 'Announcement' OR ID_Operator = $sidop) AND ID = $idn";
}
	$resultt = mysqli_query($db, $sqlt);
	$rowt = mysqli_fetch_assoc($resultt);

		$idt = $rowt['ID'];
		$Description = $rowt['Description'];
		$DateTime = $rowt['DateTime'];
		$ID_Operator = $rowt['ID_Operator'];

    if($ID_UserTypeLatest == 7) {	
	$sql8 = "SELECT Operator_Name FROM `toperator` WHERE ID = $idopd";
	}else{
	$sql8 = "SELECT Operator_Name FROM `toperator` WHERE ID = $sidop";
	}
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	$opname = $row8['Operator_Name'];

if($idt !='')
{	

	   echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="announce.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity" style="font-size:10px;">'.$DateTime.'</span>
        <h4>Announcement -'; if($ID_Operator != ''){ echo ' '.$opname.' </h4><br>'; } else{ echo ' Admin</h4><br>'; }
		
       echo '<hr class="w3-clear">
        <p>'.$Description.'</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div> '; 
} 

	}
	}else{}

}

function mydrivers_name(){
	
include('connection.php');
//include 'userdata.php';

if(isset($_GET['ID'])){
$id = $_GET['ID'];
$_SESSION['ID'] = $id;
}else{$id = 0;} 

$sql8 = "SELECT ID, FirstName, LastName, ContactNumber FROM `nokarin_drivers` WHERE ID_Operator = $id";

	$result8 = mysqli_query($db, $sql8);

	if (mysqli_num_rows($result8) > 0) {
	while($row8 = mysqli_fetch_assoc($result8)){
	$id = $row8['ID'];
	$FirstName = $row8['FirstName'];
	$LastName = $row8['LastName'];
	$ContactNumber = $row8['ContactNumber'];
	echo '<option value="'.$FirstName. ' '.$LastName.'">'.$FirstName.' '.$LastName.'</option>';	
	}
	}else{}
}

function mydrivers_contact(){
	
include('connection.php');
//include 'userdata.php';

if(isset($_GET['ID'])){
$id = $_GET['ID'];
$_SESSION['ID'] = $id;
}else{$id = 0;} 

$sql8 = "SELECT ContactNumber FROM `nokarin_drivers` WHERE ID_Operator = $id";

	$result8 = mysqli_query($db, $sql8);

	if (mysqli_num_rows($result8) > 0) {
	while($row8 = mysqli_fetch_assoc($result8)){

	$ContactNumber = $row8['ContactNumber'];
	echo $ContactNumber;	
	}
	}else{}
}


function myClient(){
	
include('connection.php');

$sql8 = "SELECT ID, Name FROM `nokarin_client`";

	$result8 = mysqli_query($db, $sql8);

	if (mysqli_num_rows($result8) > 0) {
	while($row8 = mysqli_fetch_assoc($result8)){
	$id = $row8['ID'];
	$Name = $row8['Name'];
	echo '<option value="'.$id.'">'.$Name.'</option>';	
	}
	}else{}
}

function myClientName(){
	
include('connection.php');

$sql8 = "SELECT ID, Name FROM `nokarin_client`";

	$result8 = mysqli_query($db, $sql8);

	if (mysqli_num_rows($result8) > 0) {
	while($row8 = mysqli_fetch_assoc($result8)){
	$id = $row8['ID'];
	$Name = $row8['Name'];
	echo '<option value="'.$Name.'">'.$Name.'</option>';	
	}
	}else{}
}


function mytripticket() 
{

include('connection.php');
include('userdata.php');

$sql = "SELECT * FROM tTripTicketIssued WHERE ID_Operator = $sidop ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);
echo '<div class="table100 ver2 m-b-110"  style="overflow-x:auto;">
<table data-vertable="ver2">';

	if (mysqli_num_rows($result3) > 0) {
		
echo '

<thead>
    <tr class="row100 head">
	  <th class="column100 column1" data-column="column1">TripTicket No.</th>
	  <th class="column100 column1" data-column="column1">SR No.</th>
      <th class="column100 column2" data-column="column2">Start Date</th>
      <th class="column100 column3" data-column="column3">End Date</th>
      <th class="column100 column4" data-column="column4">Service Date</th>
	  <th class="column100 column4" data-column="column4">Status</th>
	  <th class="column100 column4" data-column="column4">ACTION</th>
     
    </tr>
	</thead>
	<tbody>
	';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$ID_Driver = $row3['ID_Driver'];
	$Code = $row3['Code'];
    $StartDate = $row3['StartDate'];
	$EndDate = $row3['EndDate'];
	$FromLoc = $row3['FromLoc'];
	$ToLoc = $row3['ToLoc'];
	$SRNumber = $row3['SRNumber'];
	$SRNumber = $row3['Service_Date'];
	$IsActive = $row3['IsActive'];
	$IsExpire = $row3['IsExpire'];
	
	$sql8 = "SELECT FirstName, LastName FROM `nokarin_drivers` WHERE ID = $ID_Driver AND ID_Operator = $sidop";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	$FirstName = $row8['FirstName'];
	$LastName = $row8['LastName'];
    
echo '
<tr class="row100">
       <td class="column100 column1" data-column="column1"><a href="#">'.$Code.'</a></td>
        <td class="column100 column2" data-column="column2">'.$SRNumber.'</td>
		<td class="column100 column2" data-column="column2">'.$StartDate.'</td>
        <td class="column100 column3" data-column="column3">'.$EndDate.'</td>
        <td class="column100 column4" data-column="column4">'.$SRNumber.'</td>
		<td class="column100 column4" data-column="column4">'; if($IsActive == 1){ echo 'Active'; }else{ echo 'Inactive'; }

		echo '</td>
		<td class="column100 column4" data-column="column4"><a href="viewtripdates?ID='.$id.'">View Dates</a></td>
 </tr>';	

}
echo '';
}
else
{
echo '<p style="font-size:12px; color:green">No trip ticket yet.</p>'; 
}	
echo '</tbody></table></div>';
}



function users_mem() 
{

include('connection.php');

$sql = "SELECT * FROM nokarin_users ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);
echo '<div class="table100 ver2 m-b-110"  style="overflow-x:auto;">
<table data-vertable="ver2">';

	if (mysqli_num_rows($result3) > 0) {
		
echo '

<thead>
    <tr class="row100 head">
	  <th class="column100 column1" data-column="column1">ACTION</th>
      <th class="column100 column2" data-column="column2">User Name</th>
      <th class="column100 column3" data-column="column3">Name</th>
      <th class="column100 column4" data-column="column4">IsActive</th>
    </tr>
	</thead>
	<tbody>
	';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$username = $row3['username'];
	$accountnumber = $row3['account_number'];
    $isactive = $row3['IsActive'];
	
	$sql8 = "SELECT Name FROM `tNokarin_Profile` WHERE ID_NokarinUser = $id";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	$Name = $row8['Name'];
    
echo '
<tr class="row100">
       <td class="column100 column1" data-column="column1"><a href="usersedit?ID='.$id.'">UPDATE</a></td>
        <td class="column100 column2" data-column="column2">'.$username.'</td>
        <td class="column100 column3" data-column="column3">'.$Name.'</td>
        <td class="column100 column4" data-column="column4">'.$isactive.'</td>';
	
		

echo '</tr>';	

}
echo '';
}
else
{
echo '<p style="font-size:12px; color:green">No user yet.</p>'; 
}	
echo '</tbody></table></div>';
}
//trip approval


function trip_approval($IsActive, $IsExpire) 
{
	
	$IsActive1 = (int)$IsActive;
	$IsExpire1 = (int)$IsExpire;

include('connection.php');

$sql = "SELECT * FROM tTripTicketIssued WHERE IsActive = $IsActive1 AND IsExpire = $IsExpire1 ORDER BY ID DESC";
$result3 = mysqli_query($db, $sql);



echo '<div class="table100 ver2 m-b-110"  style="overflow-x:auto;">
<table data-vertable="ver2">';

	if (mysqli_num_rows($result3) > 0) {
		
echo '

<thead>
    <tr class="row100 head">
	  <th class="column100 column2" data-column="column2">ACTION</th>
	  <th class="column100 column2" data-column="column2">TripTicket#</th>
      <th class="column100 column3" data-column="column3">Start Date</th>
	  <th class="column100 column4" data-column="column4">End Date</th>
      <th class="column100 column5" data-column="column5">Operator</th>
	  <th class="column100 column6" data-column="column6">IsActive</th>
	  <th class="column100 column7" data-column="column7">IsExpire</th>
	  <th class="column100 column7" data-column="column7">Action</th>
	  <th class="column100 column7" data-column="column7">Status</th>
    </tr>
	</thead>
	<tbody>
	';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	$id = $row3['ID'];
	$Code = $row3['Code'];
	$ID_Operator = $row3['ID_Operator'];
	$StartDate = $row3['StartDate'];
	$EndDate = $row3['EndDate'];
	$IsActive = $row3['IsActive'];
	$IsExpire = $row3['IsExpire'];
	
	$ID_Operator2 = (int)$ID_Operator;
	//echo $ID_Operator2;
	$sql8 = "SELECT Operator_Name FROM `toperator` WHERE ID = $ID_Operator2";
	$result8 = mysqli_query($db, $sql8);
	$row = mysqli_fetch_assoc($result8);
	$Operator_Name = $row['Operator_Name'];
	//echo $Operator_Name;

?>
<script>
function toggleCheck<?php echo $id;?>() {
	
  var checkbox = document.getElementById(<?php echo "'checkbox".$id."'"; ?>);
  var idis = <?php echo $id.';'; ?>
    if (checkbox.checked){
	  document.getElementById(<?php echo "'".$id."'"; ?>).innerHTML = 'ACTIVE';
	  var isactive = 1;
    }else{
     document.getElementById(<?php echo "'".$id."'"; ?>).innerHTML = 'DISABLE';
	 var isactive = 0;
    }
	   $.ajax({
                    type: 'POST',
                    url: '../config/updatetrip.php',
                    dataType: 'html',
                    data: {
                        'isactive' : isactive,
						'id': idis
                    }
                });
  }
</script>

<?php
	
    
   echo '<tr class="row100">
        <td class="column100 column2" data-column="column2"><a href="updatetrip?ID='.$id.'">UPDATE</a></td>
        <td class="column100 column2" data-column="column2">'.$Code.'</td>
        <td class="column100 column3" data-column="column3">'.$StartDate.'</td>
        <td class="column100 column4" data-column="column4">'.$EndDate.'</td>
		<td class="column100 column5" data-column="column5">'.$Operator_Name.'</td>
		<td class="column100 column6" data-column="column6">'.$IsActive.'</td>
		<td class="column100 column7" data-column="column7">'.$IsExpire.'</td>
		<td class="column100 column7" data-column="column7">
		<label class="switch">
        <input type="checkbox" name="'.$id.'" id="checkbox'.$id.'" '; if($IsActive == 1 || $IsActive == '1'){ echo 'checked disabled'; } echo ' onchange="toggleCheck'.$id.'()">
        <div class="slider"></div>
        </label></td>
		<td class="column100 column7" data-column="column7"><span id="'.$id.'"></span></td>
        </tr>';	

}

}
else
{
echo '<p style="font-size:12px; color:green">No trip ticket request.</p>'; 
}	
echo '</tbody></table></div>';
}

//
function update_nokarin_mem(){

include('connection.php');

    $userupdate = $_POST['userupdate'];
    $memid = $_POST['memid'];
    $opname = $_POST['opname'];	
    $opadd = $_POST['opadd']; 
    $opnumb = $_POST['opnumb']; 
    $status = $_POST['changeto']; 
	
	 $sqlupdatesurvey3 = "UPDATE toperator SET Operator_Name=?, Operator_Address=?, Contact_Number=?, status=? WHERE ID = $memid";
	 $statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	 mysqli_stmt_bind_param($statementus3, "ssss",  $opname, $opadd, $opnumb, $status );
	 mysqli_stmt_execute($statementus3);
	 mysqli_stmt_close($statementus3);
	 
	$sql = "SELECT ID_NokarinUser FROM `toperator` WHERE ID = $memid";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($result);
	$ID_NokarinUser = $row['ID_NokarinUser'];
	 
	 if($status == 1){
	 
	 $ispending = 0; 
	 $isactiveu = 1;
	 $approveddetails = 'Congrats! You are now member of Nokarin Travel and Tours. You can now <a href="adddriver">Add Driver</a> to you account.';
	 $system = 0;
	 
	$sqli = "INSERT INTO nokarin_transac (Name, Description, Sender, Receiver) VALUES ('Approved',?,?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "sii", $approveddetails,$system,$ID_NokarinUser);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	
	$dateapproved = date("Y/m/d");
	
	 $sqlupdatesurvey3 = "UPDATE toperator SET DateApproved=? WHERE ID = $memid";
	 $statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	 mysqli_stmt_bind_param($statementus3, "s",  $dateapproved );
	 mysqli_stmt_execute($statementus3);
	 mysqli_stmt_close($statementus3);
	 
	 }if($status == 0 || $status == 2 || $status == 3 ) {
	 
	 $ispending = 1; 
	 $isactiveu = 0; 
	 
	$pendingdetails = "You're account is temporarily on hold. Please wait for further announcement and instruction from our Nokarin Officers.";
	$system = 0;
	 
	$sqli = "INSERT INTO nokarin_transac (Name, Description, Sender, Receiver) VALUES ('Hold',?,?,?)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "sii", $pendingdetails,$system,$ID_NokarinUser);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);

	 }
	 	

     
	 $sqlupdatesurvey2 = "UPDATE nokarin_users SET IsPending= ?, IsActive = ? WHERE ID = $ID_NokarinUser";
	 $statementus2 = mysqli_prepare($db, $sqlupdatesurvey2);
	 mysqli_stmt_bind_param($statementus2, "ii",  $ispending, $isactiveu );
	 mysqli_stmt_execute($statementus2);
	 mysqli_stmt_close($statementus2);
	 
	 header("location: members");
	
}

function update_nokarin_client(){

include('connection.php');

    $userupdate = $_POST['userupdate'];
    $memid = $_POST['memid'];
    $Code = $_POST['Code'];	
    $name = $_POST['name']; 
    $address = $_POST['address']; 
    $contactnum = $_POST['contactnum']; 
	$mobilenum = $_POST['mobilenum']; 
	
	 $sqlupdatesurvey3 = "UPDATE nokarin_client SET Code=?, Name=?, Address=?, TelephoneNo=?, MobileNo=? WHERE ID = $memid";
	 $statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	 mysqli_stmt_bind_param($statementus3, "sssss",  $Code, $name, $address, $contactnum, $mobilenum );
	 mysqli_stmt_execute($statementus3);
	 mysqli_stmt_close($statementus3);
	 header("location: clients");
	
}


function update_nokarin_driv(){

include('connection.php');

    $did = $_POST['did'];
    $dimage = $_POST['dimage'];
    $dfirstname = $_POST['dfirstname'];	
    $dlastname = $_POST['dlastname']; 
    $dcontactnum = $_POST['dcontactnum']; 
	$dLicenseNo = $_POST['dLicenseNo']; 
    $dstatus = $_POST['dstatus']; 
	
	 $sqlupdatesurvey3 = "UPDATE nokarin_drivers SET FirstName=?, LastName=?, ContactNumber=?, LicenseNo=?, Image=?, IsActive=? WHERE ID = $did";
	 $statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	 mysqli_stmt_bind_param($statementus3, "ssssss",  $dfirstname, $dlastname, $dcontactnum, $dLicenseNo, $dimage, $dstatus );
	 mysqli_stmt_execute($statementus3);
	 mysqli_stmt_close($statementus3);
	 header("location: mydriver");
	
}

function update_my_nokarin_info(){

include('connection.php');


    $uname = $_POST['uname'];
    $Address = $_POST['Address'];
    $Contact = $_POST['Contact'];	
    $Username = $_POST['Username']; 
    $Password = $_POST['Password']; 
    $Password2 = $_POST['Password2']; 
	$ID_User = $_POST['ID_User'];
	$profilepic = $_FILES['profilepic']['name'];
	
		    if (((@$_FILES["profilepic"]["type"]=="image/jpeg")  || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif")) && (@$_FILES["profilepic"]["size"] < 5000000 )) // 5 mb
	   {

	 if (file_exists("profilepic/".@$_FILES["profilepic"]["name"]))
        {
		echo @$_FILES["profilepic"]["name"]."Already Exists";
		}			
		else{
			
  $timestart = round(microtime(true) * 1000);
  $temp = explode(".", $_FILES["profilepic"]["name"]);
  $extension = end($temp);
  $newfilename = time().rand().'-nokarinprof'.".".$extension;
	
  move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "profilepic/".$newfilename);		
	
	 $sqlupdatesurvey3 = "UPDATE tNokarin_Profile SET Name=?, Address=?, ContactNumber=?, image=? WHERE ID_NokarinUser = $ID_User";
	 $statementus3 = mysqli_prepare($db, $sqlupdatesurvey3);
	 mysqli_stmt_bind_param($statementus3, "ssss",  $uname, $Address, $Contact, $newfilename );
	 mysqli_stmt_execute($statementus3);
	 mysqli_stmt_close($statementus3);
	 
	 echo '
	 <style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}	 
</style>	 
	 <div class="alert success">
   <span class="closebtn">&times;</span>  
   <strong>Successfully updated.</strong>
    </div>

<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>	
	
	';
	 
	 if($Username !=''){
	 $sqlupdatesurvey2 = "UPDATE nokarin_users SET username=? WHERE ID = $ID_User";
	 $statementus2 = mysqli_prepare($db, $sqlupdatesurvey2);
	 mysqli_stmt_bind_param($statementus2, "s",  $Username );
	 mysqli_stmt_execute($statementus2);
	 mysqli_stmt_close($statementus2); 
	 header("location: logout");
	 }else{
	 //header("location: home");
	 }
	 
	 if($Password != ''){
	 $sqlupdatesurvey2b = "UPDATE nokarin_users SET password=? WHERE ID = $ID_User";
	 $statementus2b = mysqli_prepare($db, $sqlupdatesurvey2b);
	 mysqli_stmt_bind_param($statementus2b, "s",  $Password2 );
	 mysqli_stmt_execute($statementus2b);
	 mysqli_stmt_close($statementus2b); 
     header("location: logout");	
	}else{
	 //header("location: home");
	}
	
    }
	}else{
		
	echo '<div class="alert warning">
   <span class="closebtn">&times;</span>  
   <strong>Not valid image.</strong>
    </div>
';	
	}
}

  function members_pending() 
{

include('connection.php');

$sql = "SELECT Operator_Name, Operator_Address, Contact_Number FROM toperator WHERE status = 0 ORDER BY ID DESC LIMIT 20";
$result3 = mysqli_query($db, $sql);


	if (mysqli_num_rows($result3) > 0) {
		
echo '	<table>
    <tr>
      <th>Operator Name</th>
      <th>Operator Address</th>
      <th>Contact Number</th>
    </tr>';
		
	while($row3 = mysqli_fetch_assoc($result3)){
	
	$Operator_Name = $row3['Operator_Name'];
	$Operator_Address = $row3['Operator_Address'];
	$Contact_Number = $row3['Contact_Number'];

echo '<tr>
        <td>'.$Operator_Name.'</td>
        <td>'.$Operator_Address.'</td>
        <td>'.$Contact_Number.'</td>
        </td></tr>';

}
echo '</table>';
}
else
{
echo '<p style="font-size:12px; color:green">No operator yet.</p>'; 
}	
}



?>

