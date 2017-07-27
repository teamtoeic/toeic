<?php
include_once("database.php");
class M_cau_hoi extends DB{
	public function Doc_cau_hoi_random($ma_loai_noi_dung,$ma_do_kho,$so_luong_cau_hoi){
		$sql = "SELECT * FROM loai_noi_dung inner join cau_hoi on loai_noi_dung.ma_loai_noi_dung = cau_hoi.ma_loai_noi_dung where loai_noi_dung.ma_loai_noi_dung = :ma_loai_noi_dung and cau_hoi.ma_do_kho = :ma_do_kho order by RAND() limit $so_luong_cau_hoi";
		$arr = array(":ma_loai_noi_dung"=>$ma_loai_noi_dung,":ma_do_kho"=>$ma_do_kho);
		$data=$this->selectquery($sql,$arr);
		return $data;
	}
	public function Doc_cau_hoi_theo_ma_chu_de($ma_chu_de)
	{
		$sql = "SELECT * FROM cau_hoi WHERE cau_hoi.ma_chu_de = :ma_chu_de";
		$arr = array(":ma_chu_de"=>$ma_chu_de);
		$data=$this->selectquery($sql,$arr);
		return $data;
	}
	public function Dem_cau_hoi_theo_ma_chu_de($ma_chu_de)
	{
		$sql = "SELECT *, COUNT(cau_hoi.ma_chu_de) as tong_chu_de FROM cau_hoi WHERE cau_hoi.ma_chu_de = :ma_chu_de";
		$arr = array(":ma_chu_de"=>$ma_chu_de);
		$data=$this->selectrow($sql,$arr);
		return $data;
	}
	public function Doc_cau_hoi_theo_ma_cau_hoi($ma_cau_hoi)
	{
		$sql = "SELECT * FROM cau_hoi WHERE ma_cau_hoi = :ma_cau_hoi";
		$arr = array(":ma_cau_hoi"=>$ma_cau_hoi);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}

	public function Doc_cau_hoi_theo_loai_noi_dung($ma_loai_noi_dung,$so_luong_cau_hoi)
	{
		$sql = "SELECT * FROM  cau_hoi where cau_hoi.ma_loai_noi_dung = :ma_loai_noi_dung order by cau_hoi.ma_cau_hoi limit $so_luong_cau_hoi";
		$arr = array(":ma_loai_noi_dung"=>$ma_loai_noi_dung);
		$data=$this->selectquery($sql,$arr);
		return $data;
	}
}
?>