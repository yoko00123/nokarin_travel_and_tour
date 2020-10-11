
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
<title>Request at Nokarin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}

   #locationField, #controls {
        position: relative;
        width: 480px;
      }
	       #map {
        height: 100%;
      }
  
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
        font-family: "Roboto";
      }
      #address {
        border: 1px solid #000090;
        background-color: #f0f9ff;
        width: 480px;
        padding-right: 2px;
      }
      #address td {
        font-size: 10pt;
      }
      .field {
        width: 99%;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      #locationField {
        height: 20px;
        margin-bottom: 2px;
      }
</style>
<?php include '../css/style.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>




<div class="row">

  <div class="col-75">

    <div class="container">
      <form method="post">
      
        <div class="row">
          <div class="col-50">
            <input type="hidden" name="roperator" value="<?php echo $sidop; ?>">
			
			<label for="requester"><b>Requester Name</b></label>
            <input type="text" placeholder="Requester Name" name="requester" required>
			
			
			<label for="requestermn"><b>Requester Mobile Number</b></label>
            <input type="text" placeholder="Requester Mobile Number" name="requestermn" required>
			
			<label for="passengername"><b>Passenger Name</b></label>
            <input type="text" placeholder="Passenger Name" name="passengername" required>
			
			<label for="estnumbofpass"><b>Estimate Number of Passenger</b></label>
            <input type="number" placeholder="Estimate Number" name="estnumbofpass" required>
			
			<label for="Projectn"><b>Project Name</b></label>
            <input type="text" placeholder="Project Name" name="Projectn" required>
			
			<label for="workforce"><b>Work Force</b></label>
            <input type="text" placeholder="Work Force" name="workforce" required>
			
			<label for="servicetype"><b>Service Type</b></label>
            <input type="text" placeholder="Service Type" name="servicetype" required>
			
			<label for="chargecode"><b>Charge Code</b></label>
            <input type="text" placeholder="Charge Code" name="chargecode" required>
		
			
            <label for="fname"><i class="fa fa-user"></i> Driver</label>
            <select id="drivern" name="drivern" >
			<?php mydrivers(); ?>
			</select>
			
            <label for="autocomplete"><i class="fa fa-location-arrow" aria-hidden="true"></i>From</label>
            <input type="text" id="autocomplete" onFocus="geolocate()" name="locfrom" >
			
			<label for="autocomplete2"><i class="fa fa-location-arrow" aria-hidden="true"></i>To</label>
            <input type="text" id="autocomplete2" onFocus="geolocate()" name="locto" >
			
            <label for="clients"><i class="fa fa-institution"></i>Company</label>
            <select id="clients" name="clients" >
			<?php myClient(); ?>
			</select>
			
			<label for="passgrcnt"><i class="fa fa bus"></i>Passenger Count</label>
            <input type="number" id="passgrcnt" name="passgrcnt" >

            	<!--<div class="row">
		
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
			  
            </div>-->
          </div>
<!--
          <div class="col-50">
        
          
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          -->
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr">I am driving my own unit.
        </label>
        <input type="submit" value="Request" name="requesttrip" class="btn">
<?php
if(isset($_POST['requesttrip']))
{
	request_trip();
} 
?>
      </form>
    </div>
  </div>
  <div class="col-25">
<div class="container">
     <i class="fa fa-users" aria-hidden="true">   Trip Ticket History</i>

      <p style="color:gray; font-size:8px;">ABC123 (July 1, July 6 2020)<span class="">8</span></p>
      <p style="color:gray; font-size:8px;">ABC456 (July 1, July 6 2020)<span class="">7</span></p>
    
      <hr>
    
    </div>
  </div>
</div>

  <!-- Footer -->

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


var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']},
	  document.getElementById('autocomplete2'), {types: ['geocode']}
	  
	  );

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  // var place = autocomplete.getPlace();
console.log('Searching location...');
  // for (var component in componentForm) {
    // document.getElementById(component).value = '';
    // document.getElementById(component).disabled = false;
  // }

  // // Get each component of the address from the place details,
  // // and then fill-in the corresponding field on the form.
  // for (var i = 0; i < place.address_components.length; i++) {
    // var addressType = place.address_components[i].types[0];
    // if (componentForm[addressType]) {
      // var val = place.address_components[i][componentForm[addressType]];
      // document.getElementById(addressType).value = val;
    // }
  // }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
    </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOhfd8ESCVkgIyGw4WklF9FFn2Q6GqOl8&libraries=places&callback=initAutocomplete"
        defer></script>
</body>
</html>
