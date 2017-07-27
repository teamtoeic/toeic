<?php
include_once("database.php");
//ma_cau_hoi, ma_cau_tra_loi, ma_nguoi_dung, ghi_chu
class M_bang_tam extends DB
{
	function Doc_bang_tam()
	{
		$sql="select bang_tam.*,noi_dung_cau_hoi,dap_an_tra_loi from bang_tam
		inner join cau_hoi on bang_tam.ma_cau_hoi=cau_hoi.ma_cau_hoi
		inner join cau_tra_loi on bang_tam.ma_cau_tra_loi=cau_tra_loi.ma_cau_tra_loi";
		$data=$this->selectquery($sql);
		return $data;
	}

	public function ThemBangTam($ma_cau_hoi, $ma_cau_tra_loi, $ma_nguoi_dung, $ghi_chu,$ma_diem_chuan,$ma_cau_truc)
	{
		$arr=array(':ma_cau_hoi'=>$ma_cau_hoi,':ma_cau_tra_loi'=>$ma_cau_tra_loi,':ma_nguoi_dung'=>$ma_nguoi_dung,':ghi_chu'=>$ghi_chu,':ma_diem_chuan'=>$ma_diem_chuan,':ma_cau_truc'=>$ma_cau_truc);
		$sql="INSERT INTO bang_tam values(:ma_cau_hoi, :ma_cau_tra_loi, :ma_nguoi_dung, :ghi_chu,:ma_diem_chuan,:ma_cau_truc)";
		$data=$this->selectquery($sql,$arr);
		return $data;
	}
	public function Doc_bang_tam_theo_ma_nguoi_dung($ma_nguoi_dung)
	{
		$sql = "SELECT * FROM bang_tam WHERE ma_nguoi_dung = :ma_nguoi_dung and bang_tam.time = (SELECT bang_tam.time FROM bang_tam WHERE ma_nguoi_dung = :ma_nguoi_dung order by bang_tam.time DESC limit 1 ) ";
		$arr = array(":ma_nguoi_dung"=>$ma_nguoi_dung);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
	public function Doc_bang_tam_theo_ma_nguoi_dung_row($ma_nguoi_dung)
	{
		$sql = "SELECT * FROM bang_tam WHERE ma_nguoi_dung = :ma_nguoi_dung and bang_tam.time = (SELECT bang_tam.time FROM bang_tam WHERE ma_nguoi_dung = :ma_nguoi_dung order by bang_tam.time DESC limit 1 ) ";
		$arr = array(":ma_nguoi_dung"=>$ma_nguoi_dung);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}
	public function Xoa_bang_tam_theo_nguoi_dung($ma_nguoi_dung)
	{
		$sql = "DELETE FROM bang_tam WHERE ma_nguoi_dung = ':ma_nguoi_dung'";
		$arr = array(":ma_nguoi_dung"=>$ma_nguoi_dung);
		$data = $this->selectquery($sql);
		return $data;
	}
	public function Doc_bai_lam($ma_nguoi_dung)
	{
		$sql = "SELECT * FROM bang_tam WHERE ma_nguoi_dung = :ma_nguoi_dung group by time";
		$arr = array(":ma_nguoi_dung"=>$ma_nguoi_dung);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}

	public function Doc_bai_lam_theo_thoi_gian_row($ma_nguoi_dung,$thoi_gian_lam_bai)
	{
		$sql = "SELECT * FROM bang_tam WHERE bang_tam.ma_nguoi_dung = :ma_nguoi_dung and bang_tam.time = :thoi_gian_lam_bai";
		$arr = array(":ma_nguoi_dung"=>$ma_nguoi_dung,":thoi_gian_lam_bai"=>$thoi_gian_lam_bai);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}

	public function Doc_bai_lam_theo_thoi_gian($ma_nguoi_dung,$thoi_gian_lam_bai)
	{
		$sql = "SELECT * FROM bang_tam WHERE bang_tam.ma_nguoi_dung = :ma_nguoi_dung and bang_tam.time = :thoi_gian_lam_bai";
		$arr = array(":ma_nguoi_dung"=>$ma_nguoi_dung,":thoi_gian_lam_bai"=>$thoi_gian_lam_bai);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
}
?>