<div>
<img src="img/tikling_island16-ss_diaries.jpg" style="width:100%; height:380px;
  object-fit: cover;">
</div>


<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

li a:hover, .dropdownnotif:hover .dropbtn {
  background-color: red;
}
li.dropdown {
  display: inline-block;
}
li.dropdownnotif {
  display: inline-block;
}


.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  
}
.dropdownnotif-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 320px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  font-size:16px;
  left:0;
  margin-top:15px;
}
.dropdownnotif-content .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
  font-size:12px;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}
.dropdownnotif-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}
.dropdown-content a:hover {background-color: #f1f1f1;}
.dropdownnotif-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}
/*
.dropdownnotif:hover .dropdownnotif-content {
  display: block;
}*/

</style>
</head>
<body>

<ul>
  <li><a href="home">Home</a></li>
  <?php if($ID_UserTypeLatest == 5 || $ID_UserTypeLatest == 1){?>
    <li class="dropdown">
	
    <a href="members" class="dropbtn"> Operator Members</a>
    <div class="dropdown-content">
      <a href="clients">Clients</a>
      <a href="tripapproval">Trip Ticket Approval</a>
    </div>
  </li>
  <?php } ?>
  <?php if($ID_UserTypeLatest == 5 ){?>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Admin</a>
    <div class="dropdown-content">
      <a href="users">Users</a>
      <a href="nokarinmem">Nokarin Members</a>
      <a href="#">Operator Setup</a>
	  <a href="clients">Client Setup</a>
	  <a href="systemsetup">System Setup</a>
       
	</div>
  </li>
    <?php } ?>
  <li class="dropdown">
    <a href="profile" class="dropbtn">Profile</a>
    <div class="dropdown-content">
      <a href="updateinfo">Update Info</a>
      <a href="mydriver">My Driver/s</a>
      <a href="adddriver">Add Driver</a>
      <a href="requesttrip">Request Trip</a>
      <a href="managetrip">Manage Trip Tickets</a>
      
       
	</div>
  </li>
   <li><a href="aboutus">About Us</a></li>
   
  <i onclick="dropnotif()" class="dropdownnotif fa fa-bell-o fa-2x" style="color:white; cursor:pointer; margin-top:5px;" aria-hidden="true">
  <a href="#"><span class="badge" style="font-size:16px; text-decoration:none;  margin-bottom:20px;"><?php count_notif(); ?></span></a>
     <div class="dropdownnotif-content" id="ddown">
	 <?php notif_list(); ?>
	</div>
  </i>
   <li><a href="release">Release</a></li>
   <li><a href="logout">Log Out</a></li>
   <li><a href="profile"> Registration No. <?php echo $acctnumber; ?></a></li>
</ul>
<script>
function dropnotif(){
var isd = parseInt(sessionStorage.getItem("IsDrop"));	
	if(isd == 1){
	document.getElementById('ddown').style.display = "none";
	sessionStorage.setItem("IsDrop", 0);
	}else{
    document.getElementById('ddown').style.display = "block";
    sessionStorage.setItem("IsDrop", 1);
	
	/*

	*/
	
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
/*
var dnotif = document.getElementById('ddown');
window.onclick = function(event) {
  if (event.target == dnotif  ) {
    dnotif.style.display = "none";
  }
}
*/
</script>

