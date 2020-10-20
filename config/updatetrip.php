<?php

    include('connection.php');
	include('userdata.php');

    $isactive = $_POST['isactive'];
	$id = $_POST['id'];
	$Sender =& $ID;
	
	if($isactive == 1 || $isactive =='1'){
		
	$length = 5;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	
	$sql8 = "SELECT ID_Client, ID_Operator FROM `tTripTicketIssued` WHERE ID = $id";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	$ID_Client = $row8['ID_Client'];
	$ID_Operator = $row8['ID_Operator'];
	
	$sql10 = "SELECT ID_NokarinUser FROM `toperator` WHERE ID = $ID_Operator";
	$result10 = mysqli_query($db, $sql10);
	$row10 = mysqli_fetch_assoc($result10);
	$ID_NokarinUser = $row10['ID_NokarinUser'];

	
	$sql9 = "SELECT Code FROM `nokarin_client` WHERE ID = $ID_Client";
	$result9 = mysqli_query($db, $sql9);
	$row9 = mysqli_fetch_assoc($result9);
	$Code = $row9['Code'];
	
	$Code .= '-'.$randomString;
	
	
	$sqlupdatesurvey4 = "UPDATE tTripTicketIssued SET Code=?, IsActive=? WHERE ID = $id";
	$statementus4 = mysqli_prepare($db, $sqlupdatesurvey4);
	mysqli_stmt_bind_param($statementus4, "ss", $Code, $isactive);
	mysqli_stmt_execute($statementus4);
	mysqli_stmt_close($statementus4);
	
	$header = 'Approved Request';
	$descrip = 'Congrats! Your trip ticket request was approved.';
	$sqli = "INSERT INTO nokarin_transac (Name, Description, Sender, Receiver, IsReceiver_View) VALUES (?,?,?,?,0)";
	$statementi = mysqli_prepare($db, $sqli);
	mysqli_stmt_bind_param($statementi, "ssii", $header, $descrip, $Sender, $ID_NokarinUser);
	mysqli_stmt_execute($statementi);
	mysqli_stmt_close($statementi);
	
     
    }else{
		 
	$sqlupdatesurvey4 = "UPDATE tTripTicketIssued SET IsActive=0 WHERE ID = $id";
	$statementus4 = mysqli_prepare($db, $sqlupdatesurvey4);
	mysqli_stmt_execute($statementus4);
	mysqli_stmt_close($statementus4);
		
	}
	?>