<?php
include '../config/function.php';
include '../config/sessionData.php';
include '../config/userdata.php';
if(!isset($_SESSION['username']))
{
header("location:../index");
}  

if(isset($_GET['ID'])){
$ID = $_GET['ID'];
$_SESSION['ID'] = $ID;
}else{$ID = 0;}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View Trip Nokarin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../css/dstyle.php'; ?>

</head>
<body>

<?php include 'header.php'; ?>
<div class="table-wrapper">
        <div class="table-title">
            
                
                <div class="col-sm-6">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-info active">
                            <input type="radio" name="status" value="all" checked="checked"> All
                        </label>
                        <label class="btn btn-success">
                            <input type="radio" name="status" value="active"> Active
                        </label>
                        <label class="btn btn-warning">
                            <input type="radio" name="status" value="inactive"> Inactive
                        </label>
                        <label class="btn btn-danger">
                            <input type="radio" name="status" value="expired"> Expired
                        </label>							
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SR No</th>
                    <th>FCR No</th>
                    <th>Sevice Date</th>
                    <th>Driver Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr data-status="active">
                    <td>1</td>
                    <td><a href="soengsouy.com">soengsouy.com</a></td>
                    <td><a href="soengsouy.com" class="btn btn-sm manage">Manage</a></td>
					<td>04/10/2019</td>
					<td>Khmer</td>
					<td><span class="label label-success">Active</span></td>
                </tr>
                <tr data-status="inactive">
                    <td>2</td>
                    <td><a href="soengsouy.com">soengsouy.net</a></td>
                    <td><a href="#" class="btn btn-sm manage">Manage</a></td>
					<td>05/08/2018</td>
					<td>Pursat</td>
					<td><span class="label label-warning">Inactive</span></td>
                </tr>
               
            </tbody>
        </table>
    </div> 

<?php include 'footer.php'; ?>
<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
$(document).ready(function()
{
    $(".btn-group .btn").click(function()
    {
		var inputValue = $(this).find("input").val();
        if(inputValue != 'all')
        {
			var target = $('table tr[data-status="' + inputValue + '"]');
			$("table tbody tr").not(target).hide();
			target.fadeIn();
		} else {
			$("table tbody tr").fadeIn();
		}
	});
	// Changing the class of status label to support Bootstrap 4
    var bs = $.fn.tooltip.Constructor.VERSION;
    var str = bs.split(".");
    if(str[0] == 4)
    {
        $(".label").each(function()
        {
        	var classStr = $(this).attr("class");
            var newClassStr = classStr.replace(/label/g, "badge");
            $(this).removeAttr("class").addClass(newClassStr);
        });
    }
});
</script>
</body>
</html>
