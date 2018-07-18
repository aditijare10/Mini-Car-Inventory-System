<?php
class Database{
	
	private $connection;
	function __construct() {
        require 'Config.php';
		$this->connection = new mysqli(HOST, USER, PASSWORD, DB) OR DIE("Impossible to access to DB : " . $connection->connect_error());
    }
	
	
	public function CheckManufacturer($ManufacturerName){
		$sql = "select * from manufacturer_info where ManufacturerName = '$ManufacturerName'";
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0) {
			return false;
		} else {
		 	return true;
		}
		
	}
	
	public function AddManufacturer($ManufacturerName){
		date_default_timezone_set('Asia/kolkata');
		$curr_date_time=date("Y-m-d H:i:s");
		$sql="INSERT INTO manufacturer_info (ManufacturerName, Status, CreatedOn, UpdatedOn) VALUES ('$ManufacturerName','active','$curr_date_time','$curr_date_time')";
		
		if ($this->connection->query($sql) === TRUE) {
			return true;	
		} else {
			return false;
		}
	}
	
	public function CheckModel($ManufacturerId,$ModelName){
		$sql = "select * from model_info where ManufacturerId = '$ManufacturerId' and ModelName='$ModelName'";
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0) {
			return false;
		} else {
		 	return true;
		}
		
	}
	
	public function AddModel($ManufacturerId,$ModelName,$ModelCount){
		date_default_timezone_set('Asia/kolkata');
		$curr_date_time=date("Y-m-d H:i:s");
		
		$sql="INSERT INTO model_info(ManufacturerId, ModelName, Status, CreatedOn, UpdatedOn) VALUES ($ManufacturerId,'$ModelName','active','$curr_date_time','$curr_date_time')";
		if ($this->connection->query($sql) === TRUE) {
			$ModelId = $this->connection->insert_id;
			$sql="INSERT INTO model_transaction(ModelId, ModelCount, CreatedOn, UpdatedOn) VALUES ($ModelId,$ModelCount,'$curr_date_time','$curr_date_time')";
			if ($this->connection->query($sql) === TRUE) {
				return true;
			}
			else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function GetManufacturer(){
		$sql = "select Id,ManufacturerName from manufacturer_info where Status='active' Order By Id ASC";
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$output[] = $row;
			}
			return $output;
		} else {
		 	return false;
		}
	}
	
	public function GetModel($ManufacturerId){
		$sql = "select Id,ModelName from model_info where Status='active' and ManufacturerId='$ManufacturerId' Order By Id ASC";
		$result = $this->connection->query($sql);
		$output = '<option disabled selected value=""> Select Model </option>';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$output.= "<option value=".$row['Id'].">".$row['ModelName']."</option>";
			}
			return $output;
		} else {
		 	return false;
		}
	}
	
	public function GetCount($ModelId){
		$sql = "select ModelCount from model_transaction where ModelId=$ModelId";
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$output = $row['ModelCount'];
			}
			return $output;
		} else {
		 	return false;
		}
	}
	
	public function UpdateModel($ManufacturerId,$ModelId,$ModelCount){
		date_default_timezone_set('Asia/kolkata');
		$curr_date_time=date("Y-m-d H:i:s");
		$sql="Update model_transaction set ModelCount='$ModelCount',UpdatedOn='$curr_date_time' where ModelId='$ModelId'";
		
		if ($this->connection->query($sql) === TRUE) {
			return true;	
		} else {
			return false;
		}
	}
	
	public function GetDetails(){
		$sql="SELECT
				ModelId,ModelCount,
				(
				SELECT
					ManufacturerName
				FROM
					manufacturer_info
				WHERE
					Id =(
					SELECT
						ManufacturerId
					FROM
						model_info
					WHERE
						Id = model_transaction.ModelId
				)
			) AS ManufacturerName,
			(
				SELECT
					ModelName
				FROM
					model_info
				WHERE
					Id = model_transaction.ModelId
			) AS ModelName
			FROM
				`model_transaction`";
		$result = $this->connection->query($sql);	
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$output[]=$row;
			}
			return $output;
		} else {
		 	return false;
		}
			
		
	}
	
	public function SoldModel($ModelId){
		$Count=0;
		date_default_timezone_set('Asia/kolkata');
		$curr_date_time=date("Y-m-d H:i:s");
		$sql="select ModelCount from model_transaction where ModelId='$ModelId'";
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$Count = $row['ModelCount'];
			}
			
		} else {
		 	return false;
		}
		
		if($Count>1){
			$ModelCount = $Count-1;
			$sql="Update model_transaction set ModelCount='$ModelCount',UpdatedOn='$curr_date_time' where ModelId='$ModelId'";
			
			if ($this->connection->query($sql) === TRUE) {
				return true;	
			} else {
				return false;
			}
		}
		
		if($Count==1){
			$sql="Delete from model_transaction where ModelId='$ModelId'";
			
			if ($this->connection->query($sql) === TRUE) {
				return true;	
			} else {
				return false;
			}
			
		}
	}
}
?>