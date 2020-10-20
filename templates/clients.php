<?php 
include '../config/function.php';
include '../config/sessionData.php';
include '../config/userdata.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Clients at Nokarin</title>
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
 <div class="container">
    
		<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" style="z-index:0" name="add" id="add" class="w3-button w3-large w3-circle w3-xlarge w3-ripple w3-teal">+</button>
			
			</div>
			<br />
	
	
	<div style="overflow-x:auto;">
	
	<form method="post" id="user_form">
	<?php clients();  ?>
	
	
			<div class="table-responsive">
					<table class="table table-striped table-bordered" id="user_data">
						<tr>
						    <th>UPDATE</th>
							<th>Code Name</th>
						    <th>Client Name</th>
							<th>Contact No</th>
							<th>Remove</th>
						</tr>
					</table>
				</div>
	
			<div align="center">
					<input type="submit" name="insert" id="insert" class="w3-button w3-block w3-green" value="INSERT" style="font-weight:bold;">
			</div>
	
	</form>
  </div>
  </div>
  
  
  		<div id="user_dialog" title="Add Data">
			<div class="form-group">
				<label>Code</label>
				<input type="text" name="code_name" id="code_name" class="form-control" />
				<span id="error_code_name" class="text-danger"></span>
			</div>
			
			<div class="form-group">
				<label>Client Name</label>
				<input type="text" name="client_name" id="client_name" class="form-control" />
				<span id="error_client_name" class="text-danger"></span>
			</div>
			<div class="form-group">
				<label>Contact No</label>
				<input type="text" name="telephone_no" id="telephone_no" class="form-control" />
				<span id="error_telephone_no" class="text-danger"></span>
			</div>
	
			<div class="form-group" align="center">
				<input type="hidden" name="row_id" id="hidden_row_id" />
				<button type="button" name="save" id="save" class="btn btn-info">Save</button>
			</div>
		</div>
		<div id="action_alert" title="Action">

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
		$('#code_name').val('');
		$('#client_name').val('');
		$('#telephone_no').val('');
		
		$('#error_code_name').text('');
		$('#error_client_name').text('');
		$('#error_telephone_no').text('');
	
	    $('#code_name').css('border-color', '');
		$('#client_name').css('border-color', '');
		$('#telephone_no').css('border-color', '');
	
		$('#save').text('Save');
		$('#user_dialog').dialog('open');
	});

	$('#save').click(function(){
		var error_client_name = '';
		var error_code_name = '';
	     var code_name = '';
		 var client_name = '';
		 var telephone_no = '';
		 
		 if($('#code_name').val() == '')
		{
			error_first_name = 'Code Name is required';
			$('#error_code_name').text(error_code_name);
			$('#code_name').css('border-color', '#cc0000');
			error_code_name = '';
		}
		else
		{
			error_code_name = '';
			$('#error_code_name').text(error_code_name);
			$('#error_code').css('border-color', '');
			error_code = $('#code_name').val();
		}	
	
		if($('#client_name').val() == '')
		{
			error_first_name = 'Client Name is required';
			$('#error_client_name').text(error_client_name);
			$('#client_name').css('border-color', '#cc0000');
			client_name = '';
		}
		else
		{
			error_client_name = '';
			$('#error_client_name').text(error_client_name);
			$('#client_name').css('border-color', '');
			client_name = $('#client_name').val();
		}	
		
			if($('#code_name').val() != '')
		{
		    code_name = $('#code_name').val();
		}
		if($('#telephone_no').val() != '')
		{
		    telephone_no = $('#telephone_no').val();
		}
	
		if(error_client_name != '' )
		{
			return false;
		}
		else
		{
			if($('#save').text() == 'Save')
			{
				count = count + 1;
				output = '<tr id="row_'+count+'">';
				
				output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+count+'">View</button></td>';
				output += '<td>'+code_name+' <input type="hidden" name="hidden_code_name[]" id="code_name'+count+'" value="'+code_name+'" /></td>';
				output += '<td>'+client_name+' <input type="hidden" name="hidden_client_name[]" id="client_name'+count+'" class="client_name" value="'+client_name+'" /></td>';
				output += '<td>'+telephone_no+' <input type="hidden" name="hidden_telephone_no[]" id="telephone_no'+count+'" value="'+telephone_no+'" /></td>';
                output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
				output += '</tr>';
				$('#user_data').append(output);
			}
			else
			{
				var row_id = $('#hidden_row_id').val();
				output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+row_id+'">View</button></td>';
				output = '<td>'+code_name+' <input type="hidden" name="hidden_code_name[]" id="code_name'+row_id+'" class="code_name" value="'+code_name+'" /></td>';
				output = '<td>'+client_name+' <input type="hidden" name="hidden_client_name[]" id="client_name'+row_id+'" class="client_name" value="'+client_name+'" /></td>';
				output = '<td>'+telephone_no+' <input type="hidden" name="hidden_telephone_no[]" id="telephone_no'+row_id+'" class="telephone_no" value="'+telephone_no+'" /></td>';
                output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Remove</button></td>';
				$('#row_'+row_id+'').html(output);
			}

			$('#user_dialog').dialog('close');
		}
	});

	$(document).on('click', '.view_details', function(){
		var row_id = $(this).attr("id");
	    var code_name = $('#code_name'+row_id+'').val();	
	    var client_name = $('#client_name'+row_id+'').val();
		var telephone_no = $('#telephone_no'+row_id+'').val();
		
		$('#code_name').val(code_name);
		$('#client_name').val(client_name);
		$('#telephone_no').val(telephone_no);
		

		$('#save').text('Edit');
		$('#hidden_row_id').val(row_id);
		$('#user_dialog').dialog('option', 'title', 'Edit Data');
		$('#user_dialog').dialog('open');
	});

	$(document).on('click', '.remove_details', function(){
		var row_id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this client data?"))
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
		$('.client_name').each(function(){
			count_data = count_data + 1;
		});
		if(count_data > 0)
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"insertclient.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#user_data').find("tr:gt(0)").remove();
					// $('#action_alert').html('<p>Client Inserted Successfully</p>');
					// $('#action_alert').dialog('open');
					window.location.reload();
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
