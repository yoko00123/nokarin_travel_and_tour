<?php
$connect = new PDO("mysql:host=localhost;dbname=u491065215_qkCJX", "u491065215_68vKC", "Mcbrontokdatabasebayosel001");

$query = "
INSERT INTO nokarin_drivers 
(FirstName, LastName, ContactNumber, LicenseNo, ID_Operator) 
VALUES (:first_name, :last_name, :contact_number, :licenseno, :opid)
";



$query2 = "
INSERT INTO nokarin_users 
(username, password, ID_UserType, account_number, IsActive) 
VALUES (:first_name, :licenseno, 7, :accountnum, 1)
";

for($count = 0; $count<count($_POST['hidden_first_name']); $count++)
{
$account_num = round(microtime(true) * 1000);	
	$opid = $_POST['opid'];
	$data = array(
		':first_name'	=>	$_POST['hidden_first_name'][$count],
		':last_name'	=>	$_POST['hidden_last_name'][$count],
		':contact_number' =>	$_POST['hidden_contactnumb'][$count],
		':licenseno'	=>	$_POST['hidden_licenseno'][$count],
		':opid' => $opid	
	);
	$data2 = array(
		':first_name'	=>	$_POST['hidden_first_name'][$count],
		':licenseno'	=>	$_POST['hidden_licenseno'][$count],	
		':accountnum'	=>	$account_num	
	);
	$statement2 = $connect->prepare($query2);
	$statement = $connect->prepare($query);
	$statement->execute($data);
	$statement2->execute($data2);
}
?>