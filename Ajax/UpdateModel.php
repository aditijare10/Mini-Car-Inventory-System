<?php
require '../Classes/Model.php';
$obj = new Model();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($obj->UpdateModel($_POST['ManufacturerId'],$_POST['ModelId'],$_POST['ModelCount'])){
		echo json_encode("success");
	} else {
		echo json_encode("something_went_wrong");
	}
	
}
?>