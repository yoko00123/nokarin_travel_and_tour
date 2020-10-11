
<?php

include('../config/connection.php');
require('fpdf.php');



   // $opname = $_POST['opname']; 
   // $opaddress = $_POST['opaddress'];
 


	// if(isset($_GET['requestern'])){
		// $requestern = $_GET['requestern'];
		// $_SESSION['requestern'] = $requestern;
	// }else{$requestern = "-";}
	
	

	if(isset($_GET['opID'])){
		$opid = $_GET['opID'];
		$_SESSION['opID'] = $opid;
	}else{$opid = 0;}	

$tripticket = $_POST['tripticket'];
if($tripticket = '' || $tripticket == null){
$tripticket = 'Please submit request trip';	
}
$requestern = $_POST['requestern'];
$mydriid = $_POST['mydrivers'];



	if(isset($_GET['platenumber'])){
		$platenumber = $_GET['platenumber'];
		$_SESSION['platenumber'] = $platenumber;
	}else{$platenumber = "platenumber";}	
	
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{
	// HTML parser
	$html = str_replace("\n",' ',$html);
	$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
	foreach($a as $i=>$e)
	{
		if($i%2==0)
		{
			// Text
			if($this->HREF)
				$this->PutLink($this->HREF,$e);
			else
				$this->Write(5,$e);
		}
		else
		{
			// Tag
			if($e[0]=='/')
				$this->CloseTag(strtoupper(substr($e,1)));
			else
			{
				// Extract attributes
				$a2 = explode(' ',$e);
				$tag = strtoupper(array_shift($a2));
				$attr = array();
				foreach($a2 as $v)
				{
					if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
						$attr[strtoupper($a3[1])] = $a3[2];
				}
				$this->OpenTag($tag,$attr);
			}
		}
	}
}

function OpenTag($tag, $attr)
{
	// Opening tag
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,true);
	if($tag=='A')
		$this->HREF = $attr['HREF'];
	if($tag=='BR')
		$this->Ln(5);
}

function CloseTag($tag)
{
	// Closing tag
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,false);
	if($tag=='A')
		$this->HREF = '';
}

function SetStyle($tag, $enable)
{
	// Modify style and select corresponding font
	$this->$tag += ($enable ? 1 : -1);
	$style = '';
	foreach(array('B', 'I', 'U') as $s)
	{
		if($this->$s>0)
			$style .= $s;
	}
	$this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
	// Put a hyperlink
	$this->SetTextColor(0,0,255);
	$this->SetStyle('U',true);
	$this->Write(5,$txt,$URL);
	$this->SetStyle('U',false);
	$this->SetTextColor(0);
}
}

// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}

// Simple table
function BasicTable($header, $data)
{
	// Header
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
}

$pdf = new PDF();
//for ($x = 0; $x <= 10; $x++) {
	
//ORDER BY ID DESC
 $sql = "SELECT * FROM `tTripTicketIssued` WHERE IsActive = 1 AND IsExpire = 0 AND Code <>'' AND ID_Operator = $opid AND ID_Driver = $mydriid";
 $result3 = mysqli_query($db, $sql); 
 //$row3 = mysqli_fetch_array($result3);

	  if (mysqli_num_rows($result3) > 0) {
	  while($row3 = mysqli_fetch_assoc($result3)){
		 
	$ID_Driver = $row3['ID_Driver'];
	$tripticketno = $row3['Code'];
	$ID_Operator = $row3['ID_Operator'];
	
	$sql7 = "SELECT * FROM `toperator` WHERE ID = $ID_Operator";
	$result7 = mysqli_query($db, $sql7);
	$row7 = mysqli_fetch_assoc($result7);
	
	$Operator_Name = $row7['Operator_Name'];
	$Operator_Address = $row7['Operator_Address'];
	$Contact_Number = $row7['Contact_Number'];
	$status = $row7['status'];
	$vehicle_color = $row7['vehicle_color'];
	
	$PLATE_NUMBER = $row7['PLATE_NUMBER'];
	$BODY_TYPE = $row7['BODY_TYPE'];
	$Make = $row7['Make'];
	$Year_Model = $row7['Year_Model'];
	$Series = $row7['Series'];
	$Chassis_Number = $row7['Chassis_Number'];
	$Engine_Number = $row7['Engine_Number'];
	$MV_FILE_NO = $row7['MV_FILE_NO'];
	
	$sql8 = "SELECT * FROM `nokarin_drivers` WHERE ID = $mydriid";
	$result8 = mysqli_query($db, $sql8);
	$row8 = mysqli_fetch_assoc($result8);
	
	$FirstName = $row8['FirstName'];
	$LastName = $row8['LastName'];
	$ContactNumber = $row8['ContactNumber'];
	
	
// First page
$pdf->AddPage();
$pdf->Image('../nokarinlogo.jpg',10,5,-1100);


$pdf-> Ln(12);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(255,0,0);
$pdf->SetDrawColor(255,255,255);

$pdf->SetFont('Arial','',8);
$pdf->Cell(30, 5, '', 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'C', true);
$pdf->Cell(35, 5, "Trip Ticket No.:", 1, 0, 'C', true);
$pdf->Cell(55, 5, $tripticketno, 1, 0, 'L', true);

$pdf->SetTextColor(0,0,0);
$pdf-> Ln(5);
$pdf->SetFont('Arial','',8);

$pdf->SetTextColor(0,0,0);
$pdf->Cell(115,5,"SR Number:",0,0,'R');
$pdf->Cell(70,5,"____________________________",0,0,'L');

$pdf-> Ln(10);

//table here
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetDrawColor(255,255,255);


$pdf->SetFont('Arial','',8);


$pdf->Cell(30, 5, "Client Name:", 1, 0, 'L', true);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(0.4);
$pdf->Cell(53, 5, $clients, 'B', 0, 'L', true);
$pdf->Cell(53, 5, '', 'B', 0, 'L', true);
$pdf->Cell(40, 5, '', 'B', 0, 'L', true);
$pdf->Ln(5);

//table here
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetDrawColor(255,255,255);

$pdf->Cell(35, 5, "Requester's Name", 1, 0, 'L', true);
$pdf->Cell(60, 5, $requestern, 1, 0, 'L', true);
$pdf->Cell(35, 5, "Service Date / Day", 1, 0, 'L', true);
$pdf->Cell(50, 5, '', 1, 0, 'C', true);
$pdf->Ln(5);


$pdf->Cell(35, 5, "Requester's Mobile Number ", 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'L', true);
$pdf->Cell(35, 5, "Driver Name", 1, 0, 'L', true);
$pdf->Cell(50, 5, $FirstName.' '.$LastName, 1, 0, 'L', true);
$pdf->Ln(5);


$pdf->Cell(35, 5, "Passenger's Name", 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'L', true);
$pdf->Cell(35, 5, "Driver Mobile Number:", 1, 0, 'L', true);
$pdf->Cell(50, 5, $ContactNumber, 1, 0, 'L', true);
$pdf->Ln(5);
	

$pdf->Cell(35, 5, "Est. Number of Passengers", 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'C', true);
$pdf->Cell(35, 5, "Vehicle Type", 1, 0, 'L', true);
$pdf->Cell(50, 5, $BODY_TYPE, 1, 0, 'L', true);
$pdf->Ln(5);
	
	
	
$pdf->Cell(35, 5, "Project Name", 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'C', true);
$pdf->Cell(35, 5, "Plate number", 1, 0, 'L', true);
$pdf->Cell(50, 5, $PLATE_NUMBER, 1, 0, 'L', true);
$pdf->Ln(5);
	
	
	
$pdf->Cell(35, 5, "Workforce", 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'C', true);
$pdf->Cell(35, 5, "Requested Reporting Time", 1, 0, 'L', true);
$pdf->Cell(50, 5, '', 1, 0, 'C', true);
$pdf->Ln(5);
	
	
	
$pdf->Cell(35, 5, "Service Type", 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'C', true);
$pdf->Cell(35, 5, "Reporting Time Out", 1, 0, 'L', true);
$pdf->Cell(50, 5, '', 1, 0, 'C', true);
$pdf->Ln(5);
	
	
	
$pdf->Cell(35, 5, "Charge Code", 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'C', true);
$pdf->Cell(35, 5, "Odometer Out", 1, 0, 'L', true);
$pdf->Cell(50, 5, '', 1, 0, 'C', true);
$pdf->Ln(5);
	
	
$pdf->Cell(35, 5, "Total Reporting Hours", 1, 0, 'L', true);
$pdf->Cell(60, 5, '', 1, 0, 'C', true);
$pdf->Cell(35, 5, "Odometer In", 1, 0, 'L', true);
$pdf->Cell(50, 5, '', 1, 0, 'C', true);
$pdf->Ln(5);

$pdf->Write(5,"_______________________________________________________________________________________________________________________");
$pdf->Ln(5);
$pdf->Cell(60, 5, "Trip Records", 1, 0, 'L', true);
$pdf->Cell(30, 5, 'Time', 1, 0, 'C', true);
$pdf->Cell(30, 5, "Odometer Reading", 1, 0, 'L', true);
$pdf->Cell(20, 5, "No.of Pax", 1, 0, 'L', true);
$pdf->Cell(20, 5, "Official/PA", 1, 0, 'L', true);
$pdf->Cell(20, 5, 'CONFIRMED BY', 1, 0, 'C', true);

$pdf->Ln(5);
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(25, 5, "ORIGIN", 1, 0, 'L', true);
$pdf->Cell(25, 5, 'DESTINATION', 1, 0, 'C', true);
$pdf->Cell(15, 5, "IN", 1, 0, 'L', true);
$pdf->Cell(15, 5, "OUT", 1, 0, 'L', true);
$pdf->Cell(20, 5, "START", 1, 0, 'L', true);
$pdf->Cell(20, 5, "END", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "PAX'S SIGNATURE", 1, 0, 'C', true);

$pdf->Ln(5);

$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(25, 5, '', 1, 0, 'C', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(15, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(20, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(190, 5, "***ABOVE TRIPS ARE TRUE AND CORRECT***", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->Cell(100, 5, "Printed Name of Driver :", 1, 0, 'L', true);
$pdf->Cell(90, 5, "Printed Name of Passenger/s :", 1, 0, 'L', true);
$pdf->Ln(5);
$pdf->Cell(100, 5, "Signature :", 1, 0, 'L', true);
$pdf->Cell(90, 5, "Signature :", 1, 0, 'L', true);
$pdf->Ln(5);

$pdf->SetFont('Arial','',5);
$pdf->Cell(190, 5, "*** NOTE: Before you leave the vehicle, please ensure that your personal belongings or valuables are not left behind.", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190, 5, "Breakdown of Expenses (to be filled out by Transportation Company's Dispatcher / Accounting):", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->SetFillColor(128, 128, 128);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(80, 5, "Vehicle Rental Fee", 1, 0, 'C', true);
$pdf->Cell(110, 5, "Other Charges", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',5);

$pdf->Cell(40, 5, "Vehicle Rental Fee", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'C', true);

$pdf->Cell(30, 5, "Parking Fee", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "Reference No/s.	", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);

$pdf->Ln(5);
$pdf->Cell(40, 5, "Total Service Hours (Inc. OT)", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);

$pdf->Cell(30, 5, "Toll Fee", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "Reference No/s.	", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);


$pdf->Ln(5);
$pdf->SetFillColor(128, 128, 128);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(80, 5, "Driver's Overtime", 1, 0, 'C', true);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(30, 5, "Waiting Time Charge per Hour", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "Start of Waiting Time", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);


$pdf->Ln(5);
$pdf->Cell(40, 5, "Start of Overtime", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);

$pdf->Cell(30, 5, "Total Waiting Time Charge", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(30, 5, "End of Waiting Time", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);

$pdf->Ln(5);
$pdf->Cell(40, 5, "End of Overtime", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);

$pdf->Cell(30, 5, "Total of Other Charges", 1, 0, 'L', true);
$pdf->Cell(25, 5, "", 1, 0, 'L', true);
$pdf->Cell(55, 5, "", 1, 0, 'L', true);

$pdf->Ln(5);
$pdf->Cell(40, 5, "Total Overtime Hours", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);

$pdf->Cell(30, 10, "TOTAL AMOUNT DUE", 1, 0, 'L', true);
$pdf->Cell(80, 10, "", 1, 0, 'L', true);

$pdf->Ln(5);
$pdf->Cell(40, 5, "Overtime Rate per Hour", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);
$pdf->Ln(5);
$pdf->Cell(40, 5, "Night Differential Fee", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);
$pdf->Cell(110, 5, "Prepared By :", 1, 0, 'L', true);
$pdf->Ln(5);
$pdf->Cell(40, 5, "Total Overtime Charge", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);
$pdf->Cell(55, 10, "Signature :", 1, 0, 'L', true);
$pdf->Cell(55, 10, "Date :", 1, 0, 'L', true);
$pdf->Ln(5);
$pdf->SetFillColor(128, 128, 128);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(80, 5, "Fuel Consumption", 1, 0, 'C', true);
$pdf->Ln(5);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40, 5, "Total Kilometers Ran", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);
$pdf->Cell(110, 20, "REMARKS:", 1, 0, 'L', true);

//NEW
$pdf->Ln(5);
$pdf->Cell(40, 5, "Total Fuel Consumed", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);
$pdf->Ln(5);
$pdf->Cell(40, 5, "Fuel Rate per Km.", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);
$pdf->Ln(5);
$pdf->SetFillColor(128, 128, 128);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(40, 5, "Total Fuel Charge", 1, 0, 'L', true);
$pdf->Cell(40, 5, "", 1, 0, 'L', true);
//$pdf->Output();


//}
	  }
      }else{}

$pdf->AddPage();
$pdf->Output();
// }

// }
// else
// {}



?>