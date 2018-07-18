<link rel="stylesheet" href="resources/css/datatables.min.css">
<link rel="stylesheet" href="resources/css/sweetalert.css">
<?php 
require 'navbar.php';
require '/Classes/Model.php';
$obj = new Model();
$Data = $obj->GetDetails();
?>

<div class="container">
  <div class="panel panel-primary">
  <div class="panel-heading">Mini Car Inventory System</div>
  <div class="panel-body text-center">
	   <table id="InventoryInfo" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Manufacturer Name</th>
                <th>Model Name</th>
                <th>Quantity</th>
				<th>Sold</th>
            </tr>
        </thead>
		<tbody>
			<?php
			if($Data){
				foreach ($Data as $InventoryData) {
			?>
			<tr>
				<td> <?php echo $InventoryData['ManufacturerName']; ?></td>
				<td> <?php echo $InventoryData['ModelName']; ?></td>
				<td> <?php echo $InventoryData['ModelCount']; ?></td>
				<td><button value="<?php echo $InventoryData['ModelId'] ; ?>" type="button" onclick="sold(this.value)" class="btn btn-danger">Sold</button></td>
			</tr>
				<?php
				}
				} ?>
		</tbody>
       
    </table>
		
		
            
  <div>
</div>  

<script src="resources/js/datatables.min.js"></script>
<script src="resources/js/sweetalert.min.js"></script>

  
<script>
$(document).ready(function(){
	$('#HomeMenu').addClass('active');
    $('#InventoryInfo').DataTable();
	
});

function sold(data){
	
	
	
	swal({
                title: "Are you sure?",
                text: "Do you realy want to sold it",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    soldData(data);
                    swal({
                        title: '',
                        text: 'Okay...! Sold.',
                        type: 'success'
                    }, function() {
                        window.location.href = window.location.href;
                    });
                    
                } else {
                    swal("Cancelled", "Okay...!  :)", "error");
                }
            });
	
}

function soldData(data){
	var mydata = {'ModelId':data};
	 $.ajax({
           type: "POST",
           url: "./Ajax/soldModel",
           data: mydata,
           success: function(result)
           {
			   var json = $.parseJSON(result);
			   
			   if(json=='something_went_wrong'){
				    swal({
                      title:"Error",
                      text: "Something went wrong",
             
                      button: "Close",
					});
			   }
			}
	 });
}

</script>
</body>
</html>
