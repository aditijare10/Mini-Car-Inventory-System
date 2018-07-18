<?php
require '../Classes/Model.php';
$obj = new Model();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($obj->CheckModel($_POST['ManufacturerId'],$_POST['ModelName'])){
		if($obj->AddModel($_POST['ManufacturerId'],$_POST['ModelName'],$_POST['ModelCount'])){
			echo json_encode("success");
		} else {
			echo json_encode("something_went_wrong");
		}
		
	} else {
		
		echo json_encode("Already_Exist");
	}
}
?>