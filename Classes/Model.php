<?php
class Model{
	
	private $db;
	function __construct() {
        require 'Database.php';
        $this->db = new Database();
    }
	
	public function CheckModel($ManufacturerId,$ModelName){
		$result=$this->db->CheckModel($ManufacturerId,$ModelName);
		return $result;		
	}
	
	public function AddModel($ManufacturerId,$ModelName,$ModelCount){
		$result=$this->db->AddModel($ManufacturerId,$ModelName,$ModelCount);
		return $result;		
	}
	
	public function GetModel($ManufacturerId){
		$result=$this->db->GetModel($ManufacturerId);
		return $result;		
	}
	
	public function GetCount($ModelId){
		$result=$this->db->GetCount($ModelId);
		return $result;		
	}
	
	public function UpdateModel($ManufacturerId,$ModelId,$ModelCount){
		$result=$this->db->UpdateModel($ManufacturerId,$ModelId,$ModelCount);
		return $result;		
	}
	
	public function GetDetails(){
		$result=$this->db->GetDetails();
		return $result;		
	}
	
	public function SoldModel($ModelId){
		$result=$this->db->SoldModel($ModelId);
		return $result;		
	}
	
}
?>