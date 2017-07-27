<?php
include_once("database.php"); 
class M_bang_chuan extends DB{
	public function GetBangChuan()
	{
		$sql = "SELECT * FROM bang_chuan_cua_diem ";
		$data = $this->selectquery($sql);
		return $data;
	}
	public function GetCauHoi()
	{
		$sql  = "SELECT * FROM cau_hoi order by RAND() limit 2";
		$data = $this->selectquery($sql);
		return $data;
	}
	public function GetCauTraLoi($ma_cau_hoi)
	{
		$sql  = "SELECT * FROM cau_tra_loi Where ma_cau_hoi = :ma_cau_hoi order by RAND()";
		$arr = array(":ma_cau_hoi"=>$ma_cau_hoi);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
	public function GetCauTraLoiTheoMa($ma_cau_tra_loi)
	{
		$sql  = "SELECT * FROM cau_tra_loi Where ma_cau_tra_loi = :ma_cau_tra_loi";
		$arr = array(":ma_cau_tra_loi"=>$ma_cau_tra_loi);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}

	public function Doc_cau_tra_loi_theo_ma_phan_thi($ma_cau_truc)
	{
		$arr=array(':ma_cau_truc'=>$ma_cau_truc);
		$sql="SELECT * from cau_tra_loi inner join cau_hoi on cau_tra_loi.ma_cau_hoi=cau_hoi.ma_cau_hoi inner join loai_noi_dung on cau_hoi.ma_loai_noi_dung = loai_noi_dung.ma_loai_noi_dung inner join cau_truc_de_thi on loai_noi_dung.ma_cau_truc = cau_truc_de_thi.ma_cau_truc where cau_truc_de_thi.ma_cau_truc=:ma_cau_truc ";
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
}
?>
