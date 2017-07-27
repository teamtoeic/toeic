<?php
include_once("database.php");
class M_cau_tra_loi extends DB{
	public function Doc_cau_tra_loi()
	{
		$sql = "SELECT * FROM cau_tra_loi order by RAND()";
		$data = $this->selectquery($sql);
		return $data;
	}
	public function Doc_cau_tra_loi_theo_ma_cau_hoi($ma_cau_hoi)
	{
		$arr=array(':ma_cau_hoi'=>$ma_cau_hoi);
		$sql="SELECT * from cau_tra_loi inner join cau_hoi on cau_tra_loi.ma_cau_hoi=cau_hoi.ma_cau_hoi inner join loai_noi_dung on cau_hoi.ma_loai_noi_dung = loai_noi_dung.ma_loai_noi_dung where cau_tra_loi.ma_cau_hoi=:ma_cau_hoi ";
		$data = $this->selectquery($sql,$arr);
		return $data;
	}
	public function Doc_cau_tra_loi_theo_ma_cau_tra_loi($ma_cau_tra_loi)
	{
		$arr=array(':ma_cau_tra_loi'=>$ma_cau_tra_loi);
		$sql="SELECT * from cau_tra_loi inner join cau_hoi on cau_tra_loi.ma_cau_hoi=cau_hoi.ma_cau_hoi inner join loai_noi_dung on cau_hoi.ma_loai_noi_dung = loai_noi_dung.ma_loai_noi_dung  where cau_tra_loi.ma_cau_tra_loi=:ma_cau_tra_loi ";
		$data = $this->selectrow($sql,$arr);
		return $data;
	}
}
?>