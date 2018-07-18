<?php
require '../Classes/Model.php';
$obj = new Model();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$result = $obj->SoldModel($_POST['ModelId']);
	if($result){
		echo json_encode("success");
	} else {
		echo json_encode("something_went_wrong");
	}
}
?>