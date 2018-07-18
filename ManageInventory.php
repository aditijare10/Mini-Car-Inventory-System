<link rel="stylesheet" href="resources/css/sweetalert.css">
<?php 
require 'navbar.php';
require '/Classes/Manufacturer.php';
$obj = new Manufacturer();
$ManufacturerName=$obj->GetManufacturer();
?>
<div class="container">
  <div class="panel panel-primary">
  <div class="panel-heading">Manage Inventory</div>
  <div class="panel-body text-center">
	  <form class="form-inline" method="post" Id="UpdateInventory">
		<div class="form-group">
			<label for="Manufacturer">Select Manufacturer:</label>
			<select class="form-control" Name="ManufacturerId" id="Manufacturer" onChange="getModel(this.value)">
			<option selected disabled value=''>Select Manufacturer</option>
				<?php 
					foreach($ManufacturerName as $NameOfManufacturer){
				?>
						<option value="<?php echo $NameOfManufacturer['Id'] ; ?>"> <?php echo $NameOfManufacturer['ManufacturerName']; ?> </option>
				<?php	}
				
				?>
			</select>
		</div>
		
		<div class="form-group">
			<label for="ModelList">Select Model:</label>
			<select class="form-control" Name="ModelId" Id="ModelList" onChange="setCount(this.value)">
				<option value=""> Select Model </option>	
			</select>
		</div>
		
		<div class="form-group">
		  <label for="ModelCount">Total Model:</label>
		  <input type="number" class="form-control" placeholder="Model Count" name="ModelCount" id="ModelCount">
		</div>
		
		<button type="submit" class="btn btn-success">Update</button>
		<div>
	  </form>
  <div>
</div>  
<script src="resources/js/sweetalert.min.js"></script>
<script>
$("#UpdateInventory").submit(function(e) {
	var Manufacturer = $('#Manufacturer').val();
	if(Manufacturer==''){
		 swal({
                 title:"Warning",
                 text: "Select Manufacturer",
             
                 button: "Close",
			});
		e.preventDefault();
		return ;
	}
	
	var ModelList = $('#ModelList').val();
	if(ModelList==''){
		 swal({
                 title:"Warning",
                 text: "Select Model",
             
                 button: "Close",
			});
		e.preventDefault();
		return ;
	}
	var ModelCount = $('#ModelCount').val();
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
    var url = "./Ajax/UpdateModel.php";
	
    $.ajax({
           type: "POST",
           url: url,
           data: $("#UpdateInventory").serialize(),
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
				   
				    swal({
                      title:"Added",
                      text: "Model has been update",
             
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

function getModel(ManufacturerId){
	var mydata = {"ManufacturerId": ManufacturerId};
	$.ajax({
		type: "POST",
		url: ".	/Ajax/getModel.php",
		data:mydata,
		success: function(data){
			
			$("#ModelList").html(data);
			$('#ModelCount').val('');
		}
	});
}

function setCount(ModelId){
	var mydata = {"ModelId": ModelId};
	$.ajax({
		type: "POST",
		url: ".	/Ajax/getCount.php",
		data:mydata,
		success: function(data){
			var json = $.parseJSON(data);
			$('#ModelCount').val(json);
		}
	});
}

$(document).ready(function(){
    $('#InventiryMenu').addClass('active');
});
</script>

</body>
</html>
