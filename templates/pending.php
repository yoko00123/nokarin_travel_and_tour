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
<html lang="en">
<head>
<title>Welcome to Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>

<?php
  include '../style.php';
 ?>
 <style>
.dragArea {
	background-color: #efefef;
	border: 2px dashed #cccccc;
	border-radius: 10px;
    }
.dragArea.over {
	border-color: #00e64d;
	background-color: #ffffff;
    }
#myImg {
    box-shadow: rgba(0,0,0,0.4) 0 2px 5px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}
#myImg:hover {opacity: 0.7;}
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  width:100%;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
  width:100%;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}
</style> 
</head>
<body style="background-image: url(brief_bg_gradient.png);">

<?php include 'header.php'; ?>

<div class="bgimg">
<?php 
if($ID_UserType == 3){
?>  
  <div class="topleft">
    <p style="margin-left:10px; text-align:center; color:blue;">You're account is pending for now, please complete the operator required information below.</p>
  </div>
<?php } ?>  
  <div class="middle">
    <p id="demo" style="font-size:30px"></p>
  </div>
<?php 

if($ID_UserType == 3){
?>  
  <center>
<form method="post" style="width:400px; box-shadow: 10px 10px 5px grey;" enctype="multipart/form-data">
  <div class="container">
  
  <h6 style="text-align:center; color:green;">Welcome <?php echo $myopname; ?> to Nokarin Travel and Tours!</h6>
    <hr>
	<input type="hidden" name="idop" id="idop" value="<?php echo $sidop; ?>">
    <input type="text" name="nameop" id="nameop" style="width:350px;" value="<?php echo $myopname; ?>" required>
	
	<input type="text" name="contactop" id="contactop" style="width:350px;" value="<?php echo $mycontact; ?>" required>
	
	<input type="text" name="addressop" id="addressop" style="width:350px;" value="<?php echo $myopadd; ?>" required>

 <br>
 
 
    <label for="Brand" style="color:gray; font-size:16px; float:left; margin-left:10px;">Car Brand</label>
	<select name="Brand" id="Brand" style="width:350px; color:gray;" required>
	<option value="<?php if($myMake !=''){ echo $myMake; }else { echo '-'; } ?>"><?php if($myMake !=''){ echo $myMake; }else { echo 'Choose Brand'; } ?></option>
	<option value="Toyota">Toyota</option>
	<option value="Hyundai">Hyundai</option>
	<option value="Mitsubishi">Mitsubishi</option>
	<option value="Ford">Ford</option>
	<option value="Honda">Honda</option>
	<option value="Isuzu">Isuzu</option>
	<option value="Kia">Kia</option>
	<option value="Nissan">Nissan</option>
	<option value="Mazda">Mazda</option>
	<option value="Suzuki">Suzuki</option>
	<option value="Subaru">Subaru</option>
	<option value="Chevrolet">Chevrolet</option>
	<option value="BMW">BMW</option>
	<option value="Mercedez-Benz">Mercedez-Benz</option>
	<option value="Audi">Audi</option>
	<option value="Jeep">Jeep</option>
	<option value="Volkswagen">Volkswagen</option>
	<option value="Lexus">Lexus</option>
	<option value="SsangYong">SsangYong</option>
	<option value="Porsche">Porsche</option>
	</select>
	
	<br><br>
	<label for="Body_Type" style="color:gray; font-size:16px; float:left; margin-left:10px;">Body Type</label>
	<select name="Body_Type" id="Body_Type" style="width:350px; color:gray;" required>
	<option value="<?php if($myBODY_TYPE !=''){ echo $myBODY_TYPE; }else { echo '-'; } ?>"><?php if($myBODY_TYPE !=''){ echo $myBODY_TYPE; }else { echo 'Choose Body Type'; } ?></option>
	<option value="Van">Van</option>
	<option value="MiniVan">MiniVan</option>
	<option value="Sedan">Sedan</option>
	<option value="Truck">Truck</option>
	<option value="Coupe">Coupe</option>
	<option value="SUV/MUV">SUV/MUV</option>
	<option value="Convertible">Convertible</option>
	<option value="HatchBack">HatchBack</option>
	</select>
	<br>
    <br>
    
	<label for="YearModel" style="color:gray; font-size:16px; float:left; margin-left:10px;">Year Model</label>
	<select name="YearModel" id="YearModel" style="width:350px; color:gray;" required>
	<option value="<?php if($myYear_Model !=''){ echo $myYear_Model; }else { echo '-'; } ?>"><?php if($myYear_Model !=''){ echo $myYear_Model; }else { echo 'Choose Year'; } ?></option>
	<option value="2020">2020</option>
	<option value="2019">2019</option>
	<option value="2018">2018</option>
	<option value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>
	<option value="2011">2011</option>
	<option value="2010">2010</option>
	<option value="2010">2010</option>
	</select>
	
	<br><br>
    <label for="vehicle_color" style="color:gray; font-size:16px; float:left; margin-left:10px;">Vehicle Color</label>
	<select name="vehicle_color" id="vehicle_color" style="width:350px; color:gray;" required>
	<option value="<?php if($myvehicle_color !=''){ echo $myvehicle_color; }else { echo '-'; } ?>"><?php if($myvehicle_color !=''){ echo $myvehicle_color; }else { echo 'Choose Color'; } ?></option>
	<option value="White">White</option>
	<option value="Silver">Silver</option>
	<option value="Gray">Gray</option>
	<option value="Red">Red</option>
	<option value="Green">Green</option>
	<option value="Black">Black</option>
	<option value="Blue">Blue</option>
	<option value="Orange">Orange</option>
	<option value="Brown">Brown</option>
	</select>
    <br>
    <br>
	<label for="Series" style="color:gray; font-size:16px; float:left; margin-left:10px;">Series</label>
    <input type="text" placeholder="Series" name="Series" value="<?php if($mySeries !=''){ echo $mySeries; }else { echo '-'; } ?>" id="Series" style="width:350px;" required>
	<br>
    <br>
	<label for="Chassis_Number" style="color:gray; font-size:16px; float:left; margin-left:10px;">Chassis Number</label>
    <input type="text" placeholder="Chassis Number" value="<?php if($myChassis_Number !=''){ echo $myChassis_Number; }else { echo '-'; } ?>" name="Chassis_Number" id="Chassis_Number" style="width:350px;" required>
	<br>
    <br>
	<label for="Engine_Number" style="color:gray; font-size:16px; float:left; margin-left:10px;">Engine Number</label>
    <input type="text" placeholder="Engine Number" value="<?php if($myEngine_Number !=''){ echo $myEngine_Number; }else { echo '-'; } ?>" name="Engine_Number" id="Engine_Number" style="width:350px;" required>
	<br>
    <br>
	<label for="plate_number" style="color:gray; font-size:16px; float:left; margin-left:10px;">Plate Number</label>
    <input type="text" placeholder="Plate Number" value="<?php if($myPLATE_NUMBER !=''){ echo $myPLATE_NUMBER; }else { echo '-'; } ?>" name="plate_number" id="plate_number" style="width:350px;" required>
	<br>
    <br>
	<label for="MVFileNo" style="color:gray; font-size:16px; float:left; margin-left:10px;">MV File No</label>
    <input type="text" placeholder="MV File No" value="<?php if($myMV_FILE_NO !=''){ echo $myMV_FILE_NO; }else { echo '-'; } ?>" name="MVFileNo" id="MVFileNo" style="width:350px;" required>
	<br>
	<br>
	<label for="VanLocation" style="color:gray; font-size:16px; float:left; margin-left:10px;">Garage Location</label>
    <input type="text" placeholder="Garage Location" value="<?php if($myGarage_Location !=''){ echo $myGarage_Location; }else { echo '-'; } ?>" id="autocomplete" onFocus="geolocate()" name="VanLocation" style="width:350px;" required>
	<br>
    <br>
	<label for="Insurance" style="color:gray; font-size:16px; float:left; margin-left:10px;">Insurance Name</label>
	<input type="text" placeholder="Insurance Name" value="<?php if($myInsurance_Name !=''){ echo $myInsurance_Name; }else { echo '-'; } ?>" name="Insurance" id="Insurance" style="width:350px;" required>
	<br>
    <hr>
    <br>
	
<div class="w3-bar-block w3-border w3-lime" style="width:300px">
  <div class="w3-bar-item" style="font-size:12px;">ORCR (<?php count_orcr_attach(); ?> uploaded<br><a href="/nokarin/templates/operatorreq/<?php echo $corcr; ?>"  target="_blank"><?php echo $corcr; ?></a></div>
  <div class="w3-bar-item" style="font-size:12px;">Insurance (<?php count_insurance_attach(); ?> uploaded<br><a href="/nokarin/templates/operatorreq/<?php echo $copyofinsurance; ?>"  target="_blank"><?php echo $copyofinsurance; ?></a></div>
  <div class="w3-bar-item" style="font-size:12px;">Other Insurance (<?php count_insurance_attach1(); ?> uploaded<br><a href="/nokarin/templates/operatorreq/<?php echo $copyinsurance1; ?>"  target="_blank"><?php echo $copyinsurance1; ?></a></div>
</div>
<br>
<br>


<!--
<br><br>
 <div class="dragArea" id="dragArea" style="width:160px; height:160px;">
   	
	 <center>
	 <div class="resultImageWrapper">
	 <img src="" alt="" id="myImg" style="width:150px; height:150px;">
     </div>
	</center>
	</div>
	<br>-->
	<label for="AttachmentType" style="color:gray; font-size:16px; float:left; margin-left:10px;">Attachment Type</label>
	<select name="AttachmentType" id="AttachmentType" style="width:350px; color:gray;" required>
	<option value="1">ORCR</option>
	<option value="2">Insurance</option>
	<option value="3">Other Insurance</option>
	</select>
	<br>
	<label for="image" style="color:gray; font-size:16px; text-align:center; margin-left:10px;">Add Other Attachments</label>
	
    <input type="file" name="image" style="display:block;" id="image" accept="image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
    
<hr>
<br>

    <button type="submit" name="mine_updateop" class="button button1"><b>U P D A T E</b></button>
  </div>
<?php
   if(isset($_POST['mine_updateop']))
{
   update_operator_fulldetails();
}
?>
</form>
</center>
<?php 
}
?>  
</div>
<?php include 'footer.php'; ?>

<script>
var placeSearch, autocomplete;

var componentForm = {
  autocomplete: 'long_name'
};

document.getElementById("autocomplete").addEventListener("focus", function() {
var add = document.getElementById("autocomplete").value;	

});

function initAutocomplete() {

  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  autocomplete.setFields(['address_component']);

  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {

  var place = autocomplete.getPlace();

  for (var component in componentForm) {
  }

  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOhfd8ESCVkgIyGw4WklF9FFn2Q6GqOl8&libraries=places&callback=initAutocomplete"
        defer></script>
<!--<script src="//code.jquery.com/jquery-2.1.0.min.js"></script>-->
<script>
	// // Required for drag and drop file access
	// jQuery.event.props.push('dataTransfer');
	// $(function(){
		// var dropTimer;
		// var dropTarget = $('.dragArea');
		// var fileInput = $('#image');
		// dropTarget.on("dragover", function(event) {
			// clearTimeout(dropTimer);
			// if (event.currentTarget == dropTarget[0]) {
				// dropTarget.addClass('over');
			// }
			// return false; // Required for drop to work
		// });
		// dropTarget.on('dragleave', function(event) {
			// if (event.currentTarget == dropTarget[0]) {
				// dropTimer = setTimeout(function() {
					// dropTarget.removeClass('over');
				// }, 200);
			// }
		// });
		// handleDrop = function(files){
			// dropTarget.removeClass('over');
			// var file = files[0]; // Multiple files can be dropped. Lets only deal with the "first" one.
			// if (file.type.match('text.*|image.*|application.*')) {
				// resizeImage(file, 1000, function(result) {
					// $('#myImg').attr('src', result);
					// $('.resultImageWrapper').show();
				// });
			// } else {
				// alert("That file wasn't an image.");
			// }
		// };
		// dropTarget.on('drop', function(event) {
			// event.preventDefault(); // Or else the browser will open the file
			// handleDrop(event.dataTransfer.files);
		// });
		// fileInput.on('change', function(event) {
			// handleDrop(event.target.files);
		// });
		// resizeImage = function(file, size, callback) {
			// var fileTracker = new FileReader;
			// fileTracker.onload = function() {
				// var image = new Image();
				// image.onload = function(){
					// var canvas = document.createElement("canvas");
					// /*
					// if(image.height > size) {
						// image.width *= size / image.height;
						// image.height = size;
					// }
					// */
					// if(image.width > size) {
						// image.height *= size / image.width;
						// image.width = size;
					// }
					// var ctx = canvas.getContext("2d");
					// ctx.clearRect(0, 0, canvas.width, canvas.height);
					// canvas.width = image.width;
					// canvas.height = image.height;
					// ctx.drawImage(image, 0, 0, image.width, image.height);
					// callback(canvas.toDataURL("image/png"));
				// };
				// image.src = this.result;
			// }
			// fileTracker.readAsDataURL(file);
			// fileTracker.onabort = function() {
				// alert("The upload was aborted.");
			// }
			// fileTracker.onerror = function() {
				// alert("An error occured while reading the file.");
			// }
		// };
	// });
</script>
</body>
</html>
