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
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="https://bayosel.com/nokarin/nokarinlogo.ico" style="width:250px; height:250px" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black"><br><br><br>
            <h2><?php echo $Name; ?></h2>
          </div>
        </div>
        <div class="w3-container">
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>-</p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $Address; ?></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>-</p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $ContactNumber; ?></p>
          <hr>
         
          <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>
          <p>Adobe Photoshop</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
          </div>
          <p>Photography</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:80%">
              <div class="w3-center w3-text-white">80%</div>
            </div>
          </div>
          <p>Illustrator</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">75%</div>
          </div>
          <p>Media</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
          </div>
          <br>

          <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b></p>
          <p>English</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
          </div>
          <p>Spanish</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:55%"></div>
          </div>
          <p>German</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
          </div>
          <br>
        </div>
      </div><br>
    
    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
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
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

  <!-- Footer -->

<?php include 'footer.php'; ?>

</body>
</html>
