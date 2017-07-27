<?php
include_once("database.php"); 
class M_do_kho extends DB{
	public function GetMucDo()
	{
		$sql = "SELECT * FROM do_kho";
		$data = $this->selectquery($sql);
		return $data;
	}
}
?>