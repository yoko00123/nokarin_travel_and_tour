
<?php
ob_end_clean();
include('../config/connection.php');
require('fpdf.php');



   // $opname = $_POST['opname']; 
   // $opaddress = $_POST['opaddress']; 
   
   	if(isset($_GET['opname'])){
		$opname = $_GET['opname'];
		$_SESSION['opname'] = $opname;
	}else{$opname = "error";}
   
$sql = "SELECT DateApproved FROM `toperator` WHERE Operator_Name = '$opname'";
$result = mysqli_query($db,$sql);
$rowt = mysqli_fetch_assoc($result);
$DateApproved = $rowt['DateApproved'];

$DateExpire = date('M d, Y',strtotime(date($DateApproved, mktime()) . " + 1095 day"));

$DateApprovedF = date("M d, Y", strtotime($DateApproved));

	if(isset($_GET['opname'])){
		$opname = $_GET['opname'];
		$_SESSION['opname'] = $opname;
	}else{$opname = "error";}

	if(isset($_GET['opaddress'])){
		$opaddress = $_GET['opaddress'];
		$_SESSION['opaddress'] = $opaddress;
	}else{$opaddress = "error";}


	if(isset($_GET['bodytype'])){
		$bodytype = $_GET['bodytype'];
		$_SESSION['bodytype'] = $bodytype;
	}else{$bodytype = "bodytype";}	


	if(isset($_GET['platenumber'])){
		$platenumber = $_GET['platenumber'];
		$_SESSION['platenumber'] = $platenumber;
	}else{$platenumber = "platenumber";}	


	if(isset($_GET['make'])){
		$make = $_GET['make'];
		$_SESSION['make'] = $make;
	}else{$make = "make";}	


	if(isset($_GET['YearModel'])){
		$YearModel = $_GET['YearModel'];
		$_SESSION['YearModel'] = $YearModel;
	}else{$YearModel = "YearModel";}	


	if(isset($_GET['Series'])){
		$Series = $_GET['Series'];
		$_SESSION['Series'] = $Series;
	}else{$Series = "Series";}	


	if(isset($_GET['chassisno'])){
		$chassisno = $_GET['chassisno'];
		$_SESSION['chassisno'] = $chassisno;
	}else{$chassisno = "chassisno";}	


	if(isset($_GET['engineno'])){
		$engineno = $_GET['engineno'];
		$_SESSION['engineno'] = $engineno;
	}else{$engineno = "engineno";}	


	if(isset($_GET['mvfileno'])){
		$mvfileno = $_GET['mvfileno'];
		$_SESSION['mvfileno'] = $mvfileno;
	}else{$mvfileno = "mvfileno";}		
	
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


// First page
$pdf->AddPage();
$pdf-> Ln(5);
$pdf->SetFont('Arial','u',12);

$pdf->Cell(190,10,'CONTRACT OF LEASE',0,0,'C');
$pdf-> Ln(20);

$pdf->SetFont('Arial','B',10);
$pdf->Write(5,"KNOW ALL BY MEN THESE PRESENTS:");



$pdf-> Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Write(5,"This Contract of Lease is being executed and entered into by end between:");
$pdf-> Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Write(5,''.ucfirst($opname).' of legal age, Filipino and a resident '.$opaddress.' hereinafter referred to as the "LESSOR".');
$pdf-> Ln(10);

$pdf->SetFont('Arial','',10);
$pdf->Cell(190,10,'-AND-',0,0,'C');
$pdf-> Ln(10);


$pdf->SetFont('Arial','',10);
$pdf->Write(5,"NOKARIN TRAVEL AND TOUR, a duly organized company existing under the laws of the Republic of the Philippines with business address located at 998 SITIO DANGA COLGANTE, 2016 Apalit, Philippines represented by Rosemarie Carlos hereinafter referred to as the 'LESSEE'.");
$pdf-> Ln(10);


$pdf->SetFont('Arial','B',10);

$pdf->Cell(190,10,'WITNESSETH THAT:',0,0,'C');
$pdf-> Ln(10);


$pdf->SetFont('Arial','',10);
$pdf->Write(5,"WHEREAS the LESSOR is the registered owner of a certain motor vehicle which is particularly describe as follows:");
$pdf-> Ln(10);


//table here

// Column headings
//  $header = array('MAKE', '', 'CHASSIS NO', '');
  // Data loading
  // $data = $pdf->LoadData('countries.txt');
  // $pdf->SetFont('Arial','',10);
  // $pdf->AddPage();
  // $pdf->BasicTable($header,$data);
  //table here

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.4);

$pdf->SetFont('Arial','',8);


$pdf->Cell(30, 8, "MAKE", 1, 0, 'L', true);
$pdf->Cell(55, 8, $make, 1, 0, 'C', true);
$pdf->Cell(30, 8, "CHASSIS NO", 1, 0, 'L', true);
$pdf->Cell(45, 8, $chassisno, 1, 0, 'C', true);
$pdf->Ln(8);

// Data rows   
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);

    $pdf->Cell(30, 8, "SERIES", "LTR", 0, 'L');
    $pdf->Cell(55, 8, $Series, 1, 0, 'C', true);
	$pdf->Cell(30, 8, "ENGINE NO", "LTR");
    $pdf->Cell(45, 8, $engineno, 1, 0, 'C', true);
	$pdf->Ln(5);

    $pdf->Cell(30, 8, "BODY TYPE", "LTR", 0, 'L');
    $pdf->Cell(55, 8, $bodytype, 1, 0, 'C', true);
	$pdf->Cell(30, 8, "PLATE NUMBER", "LTR");
    $pdf->Cell(45, 8, $platenumber, 1, 0, 'C', true);
	$pdf->Ln(5);
	
	$pdf->Cell(30, 8, "YEAR MODEL", "LBTR", 0, 'L');
    $pdf->Cell(55, 8, $YearModel, 1, 0, 'C', true);
	$pdf->Cell(30, 8, "MV FILE NO", "LBTR");
    $pdf->Cell(45, 8, $mvfileno, 1, 0, 'C', true);
	$pdf->Ln(20);



$pdf->SetFont('Arial','',10);
$pdf->Write(5,"WHEREAS, the LESSEE desires to engage the services of the LESSOR to provide transport services on a per trip basis and the LESSOR has expressed his willingness and capability to render the said services to the LESSEE, subject to the terms and conditions herein below set forth;");
$pdf-> Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->Write(5,"NOW, THEREFORE, for and in consideration of the foregoing premises and the terms and conditions herein set forth the LESSOR hereby leased to the LESSEE, and the LESSE hereby accepts from the LESSOR, the LEASED MOTOR VEHICLE, and subject and in accordance with the terms and conditions they have mutually agreed upon as follows:");
$pdf-> Ln(20);


//SECTION I.	

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'SECTION I.',0,0,'');

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'TERMS OF LEASE - This lease shall be for a period of THREE (3) years commencing');
$pdf-> Ln(5);

$pdf->Cell(150,10,' 
on '.$DateApprovedF.' until '.$DateExpire.' which is subject for renewal.',0,0,'');
$pdf-> Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'SECTION II.',0,0,'');

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'COMPENSATION - Consideration shall be on a per trip basis depending on the length ');
$pdf-> Ln(5);
$pdf->Cell(150,10,'of time and distance travelled based on fair matrix and/or agreement of the client/s which can be determined on the',0,0,'');
$pdf-> Ln(5);
$pdf->Cell(150,10,'service agreement issued by Nokarin Travel and Tour.',0,0,'');
$pdf-> Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'SECTION III.',0,0,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'RENEWAL - Two (2) months before the expiration of this contract, if both parties agree on its renewal, ');
$pdf-> Ln(5);
$pdf->Cell(150,10,' a renewed contract would be executed and both parties shall affix signatures.',0,0,'');

$pdf-> Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'SECTION IV.',0,0,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'USE OF THE VEHICLE - The LESSEE shall use the motor vehicle of the LESSOR  ');
$pdf-> Ln(5);
$pdf->Cell(150,10,'only for the purposes agreed upon such as recreational trips, tour packages, and other related and ',0,0,'');
$pdf-> Ln(5);
$pdf->Cell(150,10,' similar travel to cater to the clientele of the LESSEE.',0,0,'');

$pdf-> Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'SECTION V.',0,0,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'AUTHORIZED DRIVER - The aforementioned motor vehicle will be driven by the authorized driver of  ');
$pdf-> Ln(5);
$pdf->Cell(150,10,'the herein LESSEE, and the same must wear an identification card with picture, ',0,0,'');

$pdf-> Ln(5);
$pdf->Cell(150,10,' full name and drivers license number during its operation as a Transport Service, thereafter.',0,0,'');

$pdf-> Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'SECTION VI.',0,0,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'MAINTENANCE/REPAIR - Upon signing the contact, the LESSOR is responsible for the maintenance ');
$pdf-> Ln(5);
$pdf->Cell(150,10,'of the aforementioned motor vehicle such as gasoline, oil, preventive maintenance, replacement of tires and the  ',0,0,'');

$pdf-> Ln(5);
$pdf->Cell(150,10,'herein LESSOR agrees to be responsible for all damage to the vehicle and for its loss or destruction for causes attributable to',0,0,'');


$pdf-> Ln(5);
$pdf->Cell(150,10,' LESSOR"s fault and further to maintain the vehicle in good working condition.',0,0,'');

$pdf-> Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'SECTION VII.',0,0,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'INJURY OR DAMAGE TO THE THIRD PERSON - The LESSOR hereby assumes full responsibility for  ');
$pdf-> Ln(5);
$pdf->Cell(150,10,'any damage which may be caused to the person or property of any third person or to any employee, agent, assigns, officer of  ',0,0,'');

$pdf-> Ln(5);
$pdf->Cell(150,10,'the LESSOR arising from the use of the motor vehicle and further holds the LESSEE free and harmless from any',0,0,'');


$pdf-> Ln(5);
$pdf->Cell(150,10,' such claim for injury or damage. ',0,0,'');
$pdf-> Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'IN WITNESS WHEREOF,');
$pdf->SetFont('Arial','',10);
$pdf-> Ln(5);
$pdf->Cell(150,10,' the CONTRACTING PARTIES have hereunto set their hands this _____ of _____   at Caloocan City',0,0,'');
$pdf-> Ln(30);

$pdf->SetFont('Arial','u',12);
$pdf->Cell(190,10,'Rosemarie Carlos',0,0,'C');
$pdf-> Ln(5);
$pdf->SetFont('Arial','u',8);
$pdf->Cell(190,10,'(Signature OverPrinted Name)',0,0,'C');
$pdf-> Ln(5);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,10,'LESSOR',0,0,'C');
$pdf-> Ln(20);
$pdf->SetFont('Arial','u',10);
$pdf->Write(5,"SIGNED IN THE PRESENT OF:");
$pdf-> Ln(10);

$pdf->SetFont('Arial','u',9);
$pdf->Write(5,"ROMMEL CARLOS");

$pdf->SetFont('Arial','u',9);
$pdf->Cell(160,10,'_________________',0,0,'R');

$pdf-> Ln(5);
$pdf->SetFont('Arial','',9);
$pdf->Write(5,"WITNESS");

$pdf->Cell(160,10,'WITNESS',0,0,'R');

$pdf-> Ln(10);

$pdf->SetFont('Arial','B',8);
$pdf->Write(5,"REPUBLIC OF THE PHILIPPINES");
$pdf-> Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Write(5,"PASIG CITY");

$pdf-> Ln(15);
$pdf->AddPage();
$pdf->SetFont('Arial','i',10);

$pdf->Cell(190,10,'ACKNOWLEDGEMENT',0,0,'C');
$pdf-> Ln(15);

$pdf->SetFont('Arial','',8);
$pdf->Cell(50,10,'BEFORE ME, a Notary Public for and in <CITY>, PHILIPPINES, both parties personally appeared with their Identification Cards hereto attached,');
$pdf-> Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(150,10,'known to me  and to me known to be the same person who executed the foregoing instrument and acknowledged to me that the same  ',0,0,'');
$pdf-> Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(150,10,' is their own free voluntary act and deed. The foregoing instrument refers to a "CONTRACT OF LEASE" consisting of THREE (3) Pages,',0,0,'');
$pdf-> Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(150,10,'including this page whereon the acknowledgement is written, duly signed by the Lessor and Lessee, together with their instrumental witnesses',0,0,'');
$pdf-> Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(150,10,'on each and every page thereof.',0,0,'');
$pdf-> Ln(10);
$pdf->SetFont('Arial','',8);
$pdf->Cell(150,10,' WITNESS MY HAND and SEAL this _____ day of _________ at <COMPANY>, Philippines.',0,0,'');
$pdf-> Ln(10);
$pdf->SetFont('Arial','',8);
$pdf->Cell(150,10,'Doc. No:',0,0,'');
$pdf-> Ln(5);
$pdf->Cell(150,10,'Page No:',0,0,'');
$pdf-> Ln(5);
$pdf->Cell(150,10,'Book No:',0,0,'');
$pdf-> Ln(5);
$pdf->Cell(150,10,'Series of 2019',0,0,'');
$pdf-> Ln(5);

//$pdf->SetFont('Arial','',10);
//$pdf->Cell(30,20,',  at <CITY ex. Makati City> ');

//$pdf->SetFont('','U');
//$link = $pdf->AddLink();


$pdf->Output();
?>