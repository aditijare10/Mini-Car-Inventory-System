<?php
require '../Classes/Model.php';
$obj = new Model();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($obj->GetModel($_POST['ManufacturerId'])){
		echo $obj->GetModel($_POST['ManufacturerId']);
		
	}
}
?>