<?php 
include '../config/function.php';
include '../config/userdata.php';
include '../config/sessionData.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
} 	 
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile at Nokarin</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
</head>
<body class="w3-light-grey">

<?php include 'header.php'; ?>


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:10px">    

  <!-- The Grid -->
  <div class="w3-row">
  
    <div class="w3-col m3">
	
	<!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">Hi, <?php echo $username; ?></h4>
         <p class="w3-center"><img src="/nokarin/templates/profilepic/<?php  if($image !=''){ echo $image; }else { echo 'default.jpg'; } ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $usertype; ?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php echo $Address; ?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Statistic</button>
       
          <button class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Schedule</button>
          <?php if ($ID_UserTypeLatest == 3){ ?>
          <button class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Drivers</button>
		  <?php } ?>
		
        </div>      
      </div>
      <br>
      
      <!-- Interests --> 
      <div class="w3-card w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Route</p>
          <p>
            <span class="w3-tag w3-small w3-theme-d5">Accenture Boni-SM North</span>
           
          </p>
        </div>
      </div>
      <br>
	</div>

    <!-- Right Column -->
	 <?php if ($ID_UserTypeLatest == 3){ ?>
    <div class="w3-twothird" style="margin-left:10px;">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <!--<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Files</h2>-->
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Lease of Contract</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-suitcase fa-fw w3-margin-right"></i><a href="../fpdf/renderCOL?opname=<?php echo $myopname.'&opaddress='.$myopadd; ?>" target="_blank">View<span class="w3-tag w3-teal w3-round"></span></h6>
      
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Copy of ORCR</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-suitcase fa-fw w3-margin-right"></i><a href="/nokarin/templates/operatorreq/<?php echo $corcr; ?>" target="_blank">View</a></h6>
           <p><a style="color:blue;" href="/nokarin/templates/operatorreq/<?php echo $corcr; ?>" download>Download</a></p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Copy of Insurance</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-suitcase fa-fw w3-margin-right"></i><a href="/nokarin/templates/operatorreq/<?php echo $copyofinsurance; ?>" target="_blank">View</a></h6>
          <p><a style="color:blue;" href="/nokarin/templates/operatorreq/<?php echo $copyofinsurance; ?>" download>Download</a></p>
		  <hr>
        </div>
		  <div class="w3-container">
          <h5 class="w3-opacity"><b>Copy of Insurance 1</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-suitcase fa-fw w3-margin-right"></i><a href="/nokarin/templates/operatorreq/<?php echo $copyofinsurance1; ?>" target="_blank">View</a></h6>
          <p><a style="color:blue;" href="/nokarin/templates/operatorreq/<?php echo $copyofinsurance1; ?>" download>Download</a></p>
		  <hr>
        </div>
      </div>
         <!--
      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
          <p>Web Development! All I need to know in one place</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>London Business School</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
          <p>Master Degree</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>School of Coding</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
          <p>Bachelor Degree</p><br>
        </div>
      </div>-->

    <!-- End Right Column -->
    </div>
	 <?php } ?>
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

  <!-- Footer -->

<?php include 'footer.php'; ?>

</body>
</html>
