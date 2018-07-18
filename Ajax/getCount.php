<?php
require '../Classes/Model.php';
$obj = new Model();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$result = $obj->GetCount($_POST['ModelId']);
	echo json_encode($result);
	
}
?>