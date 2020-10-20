<?php

    include('connection.php');

    $ID = $_POST['ID'];
		 
	$sqlupdatesurvey4 = "UPDATE nokarin_transac SET IsReceiver_View=1 WHERE ID = $ID";
	$statementus4 = mysqli_prepare($db, $sqlupdatesurvey4);
	mysqli_stmt_execute($statementus4);
	mysqli_stmt_close($statementus4);
		
	
	?>