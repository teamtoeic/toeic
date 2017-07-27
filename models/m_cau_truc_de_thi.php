<?php
include_once("database.php");
class M_cau_truc_de_thi extends DB{
	function Danh_sach_cau_truc_de_thi()
	{
		$sql="SELECT * from cau_truc_de_thi 
				inner join phan_thi on cau_truc_de_thi.ma_cau_truc= phan_thi.ma_cau_truc
				inner join loai_noi_dung on phan_thi.ma_phan_thi=loai_noi_dung.ma_phan_thi
				inner join chi_tiet_cau_truc on loai_noi_dung.ma_loai_noi_dung=chi_tiet_cau_truc.ma_loai_noi_dung
				where chi_tiet_cau_truc.ma_diem_chuan is null
                GROUP BY cau_truc_de_thi.ma_cau_truc";
		$data = $this->selectquery($sql);
		return $data;
	}

	function Danh_sach_cau_truc_luyen_tap()
	{
		$sql="SELECT * from cau_truc_de_thi 
		inner join phan_thi on cau_truc_de_thi.ma_cau_truc=phan_thi.ma_cau_truc
		inner join loai_noi_dung on phan_thi.ma_phan_thi=loai_noi_dung.ma_phan_thi
		inner join chi_tiet_cau_truc on loai_noi_dung.ma_loai_noi_dung=chi_tiet_cau_truc.ma_loai_noi_dung
		where chi_tiet_cau_truc.ma_diem_chuan is not null
		GROUP BY loai_noi_dung.ma_loai_noi_dung,chi_tiet_cau_truc.ma_diem_chuan";
		$data=$this->selectquery($sql);
		return $data;
	}

	function Danh_sach_cau_truc_de_chuan()
	{
		$sql="SELECT * from cau_truc_de_thi 
		inner join phan_thi on cau_truc_de_thi.ma_cau_truc=phan_thi.ma_cau_truc
		inner join loai_noi_dung on phan_thi.ma_phan_thi=loai_noi_dung.ma_phan_thi
		WHERE cau_truc_de_thi.thoi_gian_co_dinh is not null
		GROUP BY cau_truc_de_thi.ma_cau_truc";
		$data=$this->selectquery($sql);
		return $data;
	}
	public function Doc_cau_truc_theo_ma_cau_truc($ma_cau_truc)
	{
		$sql = "SELECT * FROM  cau_truc_de_thi WHERE ma_cau_truc = :ma_cau_truc";
		$arr = array(":ma_cau_truc"=>$ma_cau_truc);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}
}
?>