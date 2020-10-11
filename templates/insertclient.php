<?php
$connect = new PDO("mysql:host=localhost;dbname=u491065215_qkCJX", "u491065215_68vKC", "Mcbrontokdatabasebayosel001");

$query = "
INSERT INTO nokarin_client 
(Code, Name, TelephoneNo) 
VALUES (:code_name, :client_name, :telephone_no)
";


for($count = 0; $count<count($_POST['hidden_client_name']); $count++)
{
$account_num = round(microtime(true) * 1000);	

	$data = array(
		':code_name'	=>	$_POST['hidden_code_name'][$count],
		':client_name'	=>	$_POST['hidden_client_name'][$count],
		':telephone_no'	=>	$_POST['hidden_telephone_no'][$count]
	);


	$statement = $connect->prepare($query);
	$statement->execute($data);

}
?>