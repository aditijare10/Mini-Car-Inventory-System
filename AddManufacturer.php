<?php 
require 'navbar.php';
?>
<link rel="stylesheet" href="resources/css/sweetalert.css">
<div class="container">
  <div class="panel panel-primary">
  <div class="panel-heading">Add Manufacturer</div>
  <div class="panel-body text-center">
	  <form class="form-inline" Id="AddManufacturer" method="post">
		<div class="form-group">
		  <label for="ManufacturerName">Add Manufacturer Name:</label>
		  <input type="text" class="form-control" placeholder="Enter Manufacturer Name" autocomplete="off" name="ManufacturerName" maxlength="100" id="ManufacturerName">
		</div>
		<button type="submit" class="btn btn-success">Add</button>
	  </form>
  <div>
</div>  
<script src="resources/js/sweetalert.min.js"></script>
<script>
$("#AddManufacturer").submit(function(e) {
	var ManufacturerName = $('#ManufacturerName').val();
	if(ManufacturerName==''){
		 swal({
                 title:"Warning",
                 text: "Enter Manufacturer Name",
             
                 button: "Close",
			});
		e.preventDefault();
		return ;
	}
    var url = "./Ajax/InsertManufacturer.php";
	
    $.ajax({
           type: "POST",
           url: url,
           data: $("#AddManufacturer").serialize(),
           success: function(result)
           {
			   var json = $.parseJSON(result);
			   
			   
			   
			   if(json=='Already_Exist'){
				    swal({
                      title:"Warning",
                      text: "Manufacturer Already Exist",
             
                      button: "Close",
					});
			   }
			   
			   if(json=='success'){
				   $('#ManufacturerName').val('');
				    swal({
                      title:"Added",
                      text: "Manufacturer has been added",
             
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
    $('#ManufacturerMenu').addClass('active');
});
</script>
</body>
</html>
