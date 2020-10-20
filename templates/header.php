


<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="position:fixed;width:100%;">
      <a class="navbar-brand" href="home"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a>
          </li>
		  
          <?php if($ID_UserTypeLatest == 5 || $ID_UserTypeLatest == 1){?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" 
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Operator</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
             <a class="dropdown-item" href="members">Members</a>             
			 <a class="dropdown-item" href="clients">Clients</a>
              <a class="dropdown-item" href="tripapproval">Trip Ticket Approval</a>
			</div>
          </li>
		    <?php } ?>
           <?php if($ID_UserTypeLatest == 5 ){?>
		   <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com"  id="dropdown04" 
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="Users">Users</a>
              <a class="dropdown-item" href="nokarinmem">Nokarin Members</a>
	          <a class="dropdown-item" href="#">Operator Setup</a>
              <a class="dropdown-item" href="clients">Client Setup</a>
	         <a class="dropdown-item" href="systemsetup">System Setup</a>
     		</div>
          </li>
		   <?php } ?>
		    <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com"  id="dropdown04" 
			data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
			  <a class="dropdown-item" href="profile">Profile</a>
              <a class="dropdown-item" href="updateinfo">Update Info</a>
              <?php if(($ID_UserTypeLatest == 1 || $ID_UserTypeLatest == 3 || $ID_UserTypeLatest == 5) && $IsActiveuser == 1){ ?>
			  <a class="dropdown-item" href="mydriver">My Driver/s</a>
	          <a class="dropdown-item" href="adddriver">Add Driver</a>
              <a class="dropdown-item" href="managetrip">Manage Trip Tickets</a>
	         <a class="dropdown-item" href="requesttrip">Request Trip</a>
		     <?php } ?>
     		</div>
          </li>
		   <li class="nav-item">
            <a class="nav-link " href="aboutus">About Us</a>
          </li>
		  <!--<i onclick="dropnotif()" class="dropdownnotif fa fa-bell-o fa-2x" style="color:white; cursor:pointer; margin-top:5px;" aria-hidden="true">
         <a href="#"><span class="badge" style="font-size:16px; text-decoration:none;  margin-bottom:20px;"><?php count_notif(); ?></span></a>
         <div class="dropdownnotif-content" id="ddown">
	     <?php notif_list(); ?>
     	</div>
          </i>-->
		   <li class="nav-item">
            <a class="nav-link " href="release">Release</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link " href="logout">Log Out</a>
          </li>

		  
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Registration No. <?php echo $acctnumber; ?></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Search">
        </form>
      </div>
    </nav>
	
<script>
function dropnotif(){
var isd = parseInt(sessionStorage.getItem("IsDrop"));	
	if(isd == 1){
	document.getElementById('ddown').style.display = "none";
	sessionStorage.setItem("IsDrop", 0);
	}else{
    document.getElementById('ddown').style.display = "block";
    sessionStorage.setItem("IsDrop", 1);
    }
}
function isviewed(ID){
		   $.ajax({
                    type: 'POST',
                    url: '../config/updatenotif.php',
                    dataType: 'html',
                    data: {
                        'ID' :ID 
                    },
                });	
location.reload();				
}
</script>
<br><br><br><br><br><br>

