<?php
class Manufacturer{
	
	private $db;
	function __construct() {
        require 'Database.php';
        $this->db = new Database();
    }
	
	public function CheckManufacturer($ManufacturerName){
		$result=$this->db->CheckManufacturer($ManufacturerName);
		return $result;		
	}
	
	public function AddManufacturer($ManufacturerName){
		$result=$this->db->AddManufacturer($ManufacturerName);
		return $result;		
	}
	
	public function GetManufacturer(){
		$result=$this->db->GetManufacturer();
		return $result;
	}
}
?>