<?php
include_once("database.php");
class M_loai_noi_dung extends DB{
	public function Doc_loai_noi_dung()
	{
		$sql = "SELECT * FROM loai_noi_dung";
		$data = $this->selectquery($sql);
		return $data;
	}
	public function Doc_chi_tiet_cau_truc_theo_ma_loai_noi_dung($ma_loai_noi_dung)
	{
		$sql = "SELECT * FROM chi_tiet_cau_truc WHERE chi_tiet_cau_truc.ma_loai_noi_dung = :ma_loai_noi_dung";
		$arr = array(":ma_loai_noi_dung"=>$ma_loai_noi_dung);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
	public function Dem_tong_so_cau_loai_noi_dung($ma_phan_thi)
	{
		$sql = "SELECT *, SUM(loai_noi_dung.so_luong_cau_hoi) as tong_cau_phan_thi FROM loai_noi_dung inner join phan_thi on loai_noi_dung.ma_phan_thi=phan_thi.ma_phan_thi where phan_thi.ma_phan_thi = :ma_phan_thi";
		$arr = array(":ma_phan_thi"=>$ma_phan_thi);
		$data=$this->selectrow($sql,$arr);
		return $data;
	}

	public function Doc_loai_noi_dung_theo_phan_thi($ma_phan_thi)
	{
		$sql = "SELECT * FROM loai_noi_dung where ma_phan_thi = :ma_phan_thi";
		$arr = array(":ma_phan_thi"=>$ma_phan_thi);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
}
?>