
<?php 
include '../config/function.php';
include '../config/userdata.php';
include '../config/sessionData.php';
//include '../config/checkifadmin.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Home at Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include '../css/style.php'; ?>

</head>
<body>

<?php include 'header.php'; ?>

<!-- !PAGE CONTENT! 
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
-->
  <!-- Header -->
  <!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:10px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
	
	<!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h6 class="w3-center">Hi, <?php echo ucfirst($username); ?></h6>
         <p class="w3-center"><img src="/nokarin/templates/profilepic/<?php if($image !=''){ echo $image; }else { echo 'default.jpg'; } ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
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
          <a style="text-decoration:none;" href="mydriver">
		  <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Drivers</button>
		  </a>
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
  <div class="w3-col m7">
  
   <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
			<?php if($ID_UserTypeLatest == 5 || $ID_UserTypeLatest == 1){ ?>
              <h6 class="w3-opacity">Send announcement to your clients and operators.</h6>
			<?php }else if ($ID_UserTypeLatest == 3){ ?>
			<h6 class="w3-opacity">Send announcement to your drivers.</h6>
		
			<?php }else if ($ID_UserTypeLatest == 7){ ?>
			<h6 class="w3-opacity">Send announcement to your colleagues and operator.</h6>
			<?php }else{} ?>
		    <?php if($ID_UserTypeLatest != 2) { ?>
			 <form method="post" enctype="multipart/form-data">
             <input type="text" name="announcementcontent" class="w3-border w3-padding" style="width:100%; height:90px; background-color:#006E6D; color:white; font-weight:bold;">
			  <?php if ($ID_UserTypeLatest == 3){ ?>
			<select name="sendtodriver" id="sendtodriver">
			<option value="0">All Drivers</option>
			<?php mydrivers(); ?>
			</select>
			  <?php } ?>
              <button type="submit" name="sendannouncement" class="w3-button w3-theme"><i class="fa fa-pencil">
			  </i>Post</button> 
			  </form>
			<?php } ?>
			  <?php
               if(isset($_POST['sendannouncement']))
               {
               send_announcement();
               }
			  ?>
            </div>
          </div>
        </div>
      </div>
      

  <?php if($ID_UserTypeLatest == 5 || $ID_UserTypeLatest == 1){ ?>
  
  
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Messages</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Views</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Shares</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
  </div>
  <?php }  ?>
  <?php check_announcement(); ?>
  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <!--<div class="w3-third">
        <h5>Regions</h5>
        <img src="/w3images/region.jpg" style="width:100%" alt="Google Regional Map">
      </div>-->
      <div class="w3-twothird">
        <h5>News</h5>
        <table class="w3-table w3-striped w3-white">
          <tr>
            <td><i class="fa fa-bell w3-text-blue w3-large"></i></td>
            <td>Publish Nokarin Beta Test.</td>
            <td><i>July 14, 2020</i></td>
          </tr>
		  <!--
          <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Database error.</td>
            <td><i>15 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
            <td>New record, over 40 users.</td>
            <td><i>17 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-comment w3-text-red w3-large"></i></td>
            <td>New comments.</td>
            <td><i>25 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
            <td>Check transactions.</td>
            <td><i>28 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-laptop w3-text-red w3-large"></i></td>
            <td>CPU overload.</td>
            <td><i>35 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>
            <td>New shares.</td>
            <td><i>39 mins</i></td>
          </tr>-->
        </table>
      </div>
    </div>
  </div>
  <?php if($ID_UserTypeLatest == 5 || $ID_UserTypeLatest == 1){ ?>
  <hr>
  <div class="w3-container">
    <h5>General Stats</h5>
    <p>Active Operator</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
    </div>

    <p>Active Users</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
    </div>

    <p>Active Clients</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-blue" style="width:75%">75%</div>
    </div>
  </div>
  <?php } ?>
  <hr>

  <div class="w3-container">
    <h5>TOP OPERATOR</h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
<tr>
        <td>No data yet.</td>
        <td></td>
      </tr>   

   <!-- <tr>
        <td>United States</td>
        <td>65%</td>
      </tr>
      <tr>
        <td>UK</td>
        <td>15.7%</td>
      </tr>
      <tr>
        <td>Russia</td>
        <td>5.6%</td>
      </tr>
      <tr>
        <td>Spain</td>
        <td>2.1%</td>
      </tr>
      <tr>
        <td>India</td>
        <td>1.9%</td>
      </tr>
      <tr>
        <td>France</td>
        <td>1.5%</td>
      </tr>-->
    </table><br>
   <!-- <button class="w3-button w3-dark-grey">More Countries  <i class="fa fa-arrow-right"></i></button>-->
  </div>
  <hr>
  <!--
  <div class="w3-container">
    <h5>Recent Users</h5>
    <ul class="w3-ul w3-card-4 w3-white">
      <li class="w3-padding-16">
        <img src="/w3images/avatar2.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Mike</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="/w3images/avatar5.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jill</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="/w3images/avatar6.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jane</span><br>
      </li>
    </ul>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Recent Comments</h5>
    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="/w3images/avatar3.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>John <span class="w3-opacity w3-medium">Sep 29, 2014, 9:12 PM</span></h4>
        <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>

    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="/w3images/avatar1.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>Bo <span class="w3-opacity w3-medium">Sep 28, 2014, 10:15 PM</span></h4>
        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>
  </div>
  <br>
  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">Target</h5>
        <p>Users</p>
        <p>Active</p>
        <p>Geo</p>
        <p>Interests</p>
      </div>
    </div>
  </div>
-->
</div>
  <!-- Footer -->
  </div>

<?php include 'footer.php'; ?> 	
  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
sessionStorage.removeItem('Username');

</script>
</div>
</body>
</html>
