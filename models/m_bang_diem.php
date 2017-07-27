<?php 
include_once("database.php");
class M_bang_diem extends DB
{
	public function Doc_bang_diem_theo_ma_phan_thi($ma_phan_thi)
	{
		$sql = "SELECT * FROM bang_xu_ly WHERE ma_phan_thi = :ma_phan_thi";
		$arr = array(":ma_phan_thi"=>$ma_phan_thi);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
	public function Check_diem_theo_ma_phan_thi($ma_phan_thi)
	{
		$sql = "SELECT ma_phan_thi FROM bang_xu_ly WHERE ma_phan_thi = :ma_phan_thi";
		$arr = array(":ma_phan_thi"=>$ma_phan_thi);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}
	public function Danh_sach_diem_bonus_theo_ma_phan_thi()
	{
		$sql = "SELECT * FROM diem_bonus";
		$data = $this->selectquery($sql);
		return $data;
	}
}
?>