<link rel="stylesheet" href="resources/css/sweetalert.css">
<?php 
require 'navbar.php';
require '/Classes/Manufacturer.php';
$obj = new Manufacturer();
$ManufacturerName=$obj->GetManufacturer();
?>
<div class="container">
  <div class="panel panel-primary">
  <div class="panel-heading">Add Model</div>
  <div class="panel-body text-center">
	  <form class="form-inline" method="post" Id="AddModel">
		<div class="form-group">
			<label for="ManufacturerId">Select Manufacturer:</label>
			<select class="form-control" Name="ManufacturerId" id="ManufacturerId">
				<?php 
					if($ManufacturerName){
						foreach($ManufacturerName as $NameOfManufacturer){
				?>
							<option value="<?php echo $NameOfManufacturer['Id'] ; ?>"> <?php echo $NameOfManufacturer['ManufacturerName']; ?> </option>
				<?php	}
					} else {
						?>
						<option value=""> Select Manufacturer </option>
				<?php 
				}
				?>
			</select>
		</div>
		
		<div class="form-group">
		  <label for="ModelName" class="sr-only">Add Model Name:</label>
		  <input type="text" class="form-control" placeholder="Enter Model Name" autocomplete="off" maxlength="100" name="ModelName" id="ModelName">
		</div>
		
		<div class="form-group">
		  <label for="ModelCount" class="sr-only">Add Number Of Model:</label>
		  <input type="number" require="true" class="form-control" placeholder="Enter Number of Model" maxlength="5" name="ModelCount" id="ModelCount">
		</div>
		
		<button type="submit" class="btn btn-success">Add</button>
		<div>
	  </form>
  <div>
</div>  
<script src="resources/js/sweetalert.min.js"></script>
<script>
$("#AddModel").submit(function(e) {
	
	var ModelName = $('#ModelName').val();
	var ManufacturerId = $('#ManufacturerId').val();
	var ModelCount = $('#ModelCount').val();
	
	if(ManufacturerId==''){
		 swal({
                 title:"Warning",
                 text: "Please Select Manufacturer",
             
                 button: "Close",
			});
		e.preventDefault();
		return ;
	}
	
	if(ModelName==''){
		 swal({
                 title:"Warning",
                 text: "Enter Model Name",
             
                 button: "Close",
			});
		e.preventDefault();
		return ;
	}
	
	if(ModelCount==''){
		 swal({
                 title:"Warning",
                 text: "Enter Number Of Model",
             
                 button: "Close",
			});
		e.preventDefault();
		return ;
	} 
	if(ModelCount<=0) {
		swal({
                 title:"Warning",
                 text: "Enter Valid Number Of Model",
             
                 button: "Close",
			});
		e.preventDefault();
		return ;
	}
	
    var url = "./Ajax/InsertModel.php";
	
    $.ajax({
           type: "POST",
           url: url,
           data: $("#AddModel").serialize(),
           success: function(result)
           {
			   var json = $.parseJSON(result);
			   if(json=='Already_Exist'){
				    swal({
                      title:"Warning",
                      text: "Model Already Exist",
             
                      button: "Close",
					});
			   }
			   
			   if(json=='success'){
				   $('#ModelName').val('');
				   $('#ModelCount').val('');
				    swal({
                      title:"Added",
                      text: "Model has been added",
             
                      button: "Close",
					});
					
			   }
			   
			   if(json=='something_went_wrong'){
				    swal({
                      title:"Error",
                      text: "Something went wrong",
             
                      button: "Close",
					});
			   }
				
           }
         });

    e.preventDefault();
});



$(document).ready(function(){
    $('#ModelMenu').addClass('active');
});
</script>

</body>
</html>
