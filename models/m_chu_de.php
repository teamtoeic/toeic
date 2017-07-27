<?php
include_once("database.php");
class M_chu_de extends DB{
	public function Doc_chu_de()
	{
		$sql = "SELECT * FROM chu_de 
		where ma_chu_de != 1 and ma_chu_de != 2 and ma_chu_de != 3 and ma_chu_de != 4 and ma_chu_de != 5 and ma_chu_de != 6 and ma_chu_de != 7 group by RAND() ";
		$data = $this->selectquery($sql);
		return $data;
	}
	public function Doc_chu_de_de_chuan()
	{
		$sql = "SELECT * FROM chu_de 
		where ma_chu_de != 1 and ma_chu_de != 2 and ma_chu_de != 3 and ma_chu_de != 4 and ma_chu_de != 5 and ma_chu_de != 6 and ma_chu_de != 7";
		$data = $this->selectquery($sql);
		return $data;
	}
	public function Doc_chu_de_theo_ma_cau_hoi($ma_cau_hoi)
	{
		$sql = "SELECT chu_de.ma_chu_de,chu_de.ma_loai_noi_dung FROM chu_de inner join cau_hoi on chu_de.ma_chu_de = cau_hoi.ma_chu_de inner join loai_noi_dung on chu_de.ma_loai_noi_dung= loai_noi_dung.ma_loai_noi_dung where cau_hoi.ma_cau_hoi = :ma_cau_hoi";
		$arr = array(":ma_cau_hoi"=>$ma_cau_hoi);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}
	public function Doc_chu_de_ket_qua()
	{
		$sql = "SELECT * FROM chu_de 
		where ma_chu_de != 1 and ma_chu_de != 2 and ma_chu_de != 3 and ma_chu_de != 4 and ma_chu_de != 5 and ma_chu_de != 6 and ma_chu_de != 7";
		$data = $this->selectquery($sql);
		return $data;
	}
}
?>