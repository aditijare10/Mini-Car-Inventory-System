<?php
require '../Classes/Manufacturer.php';
$obj = new Manufacturer();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($obj->CheckManufacturer($_POST['ManufacturerName'])){
		if($obj->AddManufacturer($_POST['ManufacturerName'])){
			echo json_encode("success");
		} else {
			echo json_encode("something_went_wrong");
		}
	} else {
		
		echo json_encode("Already_Exist");
	}
}
?>