<?php 
include '../config/function.php';
include '../config/sessionData.php';
include '../config/userdata.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}  
if(isset($_POST['updatedriv']))
{
	//header("location:driversedit");
	
	$did = $_POST['did'];
     redi_update($did);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Driver at Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/style.php'; ?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="bootstrap.min.css" />
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
		
</head>
<body>

<?php include 'header.php'; ?>

    <div style="overflow-x:auto;">




        <div class="container">
		
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" style="z-index:0" name="add" id="add" class="w3-button w3-large w3-circle w3-xlarge w3-ripple w3-teal">+</button>
			
			</div>
			<br />
			<form method="post" id="user_form">
			<input type="hidden" name="opid" value="<?php echo $sidop; ?>">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="user_data">
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Contact Number</th>
							<th>License No</th>
							<th>SELECT</th>
							<th>Remove</th>
						</tr>
					</table>
				</div>
				<div align="center">
					<input type="submit" name="insert" id="insert"  class="w3-button w3-block w3-green" value="Submit" style="font-weight:bold;">
				</div>
			</form>

			<br />
		</div>
		<div id="user_dialog" title="Add Data">
			<div class="form-group">
				<label>First Name</label>
				<input type="text" name="first_name" id="first_name" class="form-control" />
				<span id="error_first_name" class="text-danger"></span>
			</div>
			<div class="form-group">
				<label>Last Name</label>
				<input type="text" name="last_name" id="last_name" class="form-control" />
				<span id="error_last_name" class="text-danger"></span>
			</div>
			<div class="form-group">
				<label>Contact No</label>
				<input type="text" name="Contact" id="Contact" class="form-control" />
				<span id="error_Contact" class="text-danger"></span>
			</div>
			<div class="form-group">
				<label>License No</label>
				<input type="text" name="License" id="License" class="form-control" />
				<span id="error_License" class="text-danger"></span>
			</div>
			<div class="form-group" align="center">
				<input type="hidden" name="row_id" id="hidden_row_id" />
				<button type="button" name="save" id="save" class="btn btn-info">Save</button>
			</div>
		</div>
		<div id="action_alert" title="Action">

		</div>




  </div>


<?php include 'footer.php'; ?>

</body>

<script>  
$(document).ready(function(){ 
	
	var count = 0;

	$('#user_dialog').dialog({
		autoOpen:false,
		width:400
	});

	$('#add').click(function(){
		$('#user_dialog').dialog('option', 'title', 'Add Data');
		$('#first_name').val('');
		$('#last_name').val('');
		$('#Contact').val('');
		$('#License').val('');
		$('#error_first_name').text('');
		$('#error_last_name').text('');
		$('#first_name').css('border-color', '');
		$('#last_name').css('border-color', '');
		$('#save').text('Save');
		$('#user_dialog').dialog('open');
	});

	$('#save').click(function(){
		var error_first_name = '';
		var error_last_name = '';
		var first_name = '';
		var last_name = '';
		var contactnumb = '';
		var licenseno = '';
		if($('#first_name').val() == '')
		{
			error_first_name = 'First Name is required';
			$('#error_first_name').text(error_first_name);
			$('#first_name').css('border-color', '#cc0000');
			first_name = '';
		}
		else
		{
			error_first_name = '';
			$('#error_first_name').text(error_first_name);
			$('#first_name').css('border-color', '');
			first_name = $('#first_name').val();
		}	
		if($('#last_name').val() == '')
		{
			error_last_name = 'Last Name is required';
			$('#error_last_name').text(error_last_name);
			$('#last_name').css('border-color', '#cc0000');
			last_name = '';
		}
		else
		{
			error_last_name = '';
			$('#error_last_name').text(error_last_name);
			$('#last_name').css('border-color', '');
			last_name = $('#last_name').val();
		}
		if($('#last_name').val() != '')
		{
		    contactnumb = $('#Contact').val();
		}
		if($('#last_name').val() != '')
		{
		    licenseno = $('#License').val();
		}
		if(error_first_name != '' || error_last_name != '')
		{
			return false;
		}
		else
		{
			if($('#save').text() == 'Save')
			{
				count = count + 1;
				output = '<tr id="row_'+count+'">';
				output += '<td>'+first_name+' <input type="hidden" name="hidden_first_name[]" id="first_name'+count+'" class="first_name" value="'+first_name+'" /></td>';
				output += '<td>'+last_name+' <input type="hidden" name="hidden_last_name[]" id="last_name'+count+'" value="'+last_name+'" /></td>';
				output += '<td>'+contactnumb+' <input type="hidden" name="hidden_contactnumb[]" id="contactnumb'+count+'" value="'+contactnumb+'" /></td>';
				output += '<td>'+licenseno+' <input type="hidden" name="hidden_licenseno[]" id="licenseno'+count+'" value="'+licenseno+'" /></td>';
				output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+count+'">View</button></td>';
				output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
				output += '</tr>';
				$('#user_data').append(output);
			}
			else
			{
				var row_id = $('#hidden_row_id').val();
				output = '<td>'+first_name+' <input type="hidden" name="hidden_first_name[]" id="first_name'+row_id+'" class="first_name" value="'+first_name+'" /></td>';
				output += '<td>'+last_name+' <input type="hidden" name="hidden_last_name[]" id="last_name'+row_id+'" value="'+last_name+'" /></td>';
				output += '<td>'+contactnumb+' <input type="hidden" name="hidden_contactnumb[]" id="contactnumb'+row_id+'" value="'+contactnumb+'" />cc</td>';
				output += '<td>'+licenseno+' <input type="hidden" name="hidden_licenseno[]" id="licenseno'+row_id+'" value="'+licenseno+'" />cc</td>';
				output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+row_id+'">View</button></td>';
				output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Remove</button></td>';
				$('#row_'+row_id+'').html(output);
			}

			$('#user_dialog').dialog('close');
		}
	});

	$(document).on('click', '.view_details', function(){
		var row_id = $(this).attr("id");
		var first_name = $('#first_name'+row_id+'').val();
		var last_name = $('#last_name'+row_id+'').val();
		var contactnumb = $('#Contact'+row_id+'').val();
		var licenseno = $('#License'+row_id+'').val();
		$('#first_name').val(first_name);
		$('#last_name').val(last_name);
		$('#Contact').val(contactnumb);
		$('#License').val(licenseno);
		$('#save').text('Edit');
		$('#hidden_row_id').val(row_id);
		$('#user_dialog').dialog('option', 'title', 'Edit Data');
		$('#user_dialog').dialog('open');
	});

	$(document).on('click', '.remove_details', function(){
		var row_id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this driver data?"))
		{
			$('#row_'+row_id+'').remove();
		}
		else
		{
			return false;
		}
	});

	$('#action_alert').dialog({
		autoOpen:false
	});

	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var count_data = 0;
		$('.first_name').each(function(){
			count_data = count_data + 1;
		});
		if(count_data > 0)
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"insert.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#user_data').find("tr:gt(0)").remove();
					$('#action_alert').html('<p>Data Inserted Successfully</p><br><a href="mydriver" style="color:blue;">Check my driver login details.</a>');
					$('#action_alert').dialog('open');
				}
			})
		}
		else
		{
			$('#action_alert').html('<p>Please Add atleast one data</p>');
			$('#action_alert').dialog('open');
		}
	});
	
});  
</script>
</html>
