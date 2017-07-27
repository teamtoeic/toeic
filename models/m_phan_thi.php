<?php
include_once("database.php");
class M_phan_thi extends DB{
	public function Doc_phan_thi_theo_ma_cau_truc($ma_cau_truc,$ma_diem_chuan)
	{
		if($ma_diem_chuan == "")
		{
			$sql = "SELECT * FROM phan_thi inner join loai_noi_dung on phan_thi.ma_phan_thi = loai_noi_dung.ma_phan_thi left join chi_tiet_cau_truc on loai_noi_dung.ma_loai_noi_dung = chi_tiet_cau_truc.ma_loai_noi_dung WHERE phan_thi.ma_cau_truc = :ma_cau_truc and chi_tiet_cau_truc.ma_diem_chuan is NULL group by phan_thi.ma_phan_thi";
			$arr = array(":ma_cau_truc"=>$ma_cau_truc);
		}
		else
		{
			$sql = "SELECT * FROM phan_thi inner join loai_noi_dung on phan_thi.ma_phan_thi = loai_noi_dung.ma_phan_thi inner join chi_tiet_cau_truc on loai_noi_dung.ma_loai_noi_dung = chi_tiet_cau_truc.ma_loai_noi_dung WHERE phan_thi.ma_cau_truc = :ma_cau_truc and chi_tiet_cau_truc.ma_diem_chuan = :ma_diem_chuan group by phan_thi.ma_phan_thi";
			$arr = array(":ma_cau_truc"=>$ma_cau_truc,":ma_diem_chuan"=>$ma_diem_chuan);
		}
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
	public function Doc_phan_thi_theo_ma_phan_thi($ma_phan_thi)
	{
		$sql = "SELECT * FROM phan_thi WHERE ma_phan_thi = :ma_phan_thi";
		$arr = array(":ma_phan_thi"=>$ma_phan_thi);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}

	public function Doc_phan_thi_theo_cau_truc($ma_cau_truc)
	{
		$sql = "SELECT * FROM phan_thi inner join loai_noi_dung on phan_thi.ma_phan_thi = loai_noi_dung.ma_phan_thi WHERE phan_thi.ma_cau_truc = :ma_cau_truc group by phan_thi.ma_phan_thi";
		$arr = array(":ma_cau_truc"=>$ma_cau_truc);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
	
	public function Dem_tong_so_cau_phan_thi($ma_cau_truc)
	{
		$sql = "SELECT *, SUM(phan_thi.so_luong_cau_phan_thi) as tong_so_cau FROM phan_thi inner join cau_truc_de_thi on phan_thi.ma_cau_truc = cau_truc_de_thi.ma_cau_truc where cau_truc_de_thi.ma_cau_truc = :ma_cau_truc";
		$arr = array(":ma_cau_truc"=>$ma_cau_truc);
		$data=$this->selectrow($sql,$arr);
		return $data;
	}
}
?>