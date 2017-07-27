<?php
include_once("database.php");
class M_thong_bao extends DB{
	function Doc_danh_sach_thong_bao()
	{
		$sql="select * from thong_bao where trang_thai=1 order by ma_thong_bao DESC limit 10";
		$data=$this->selectquery($sql);
		return $data;
	}

	function Doc_thong_bao_theo_ma($id)
	{
		$arr=array(':ma_thong_bao'=>$id);
		$sql="select * from thong_bao where ma_thong_bao=:ma_thong_bao";
		$data=$this->selectrow($sql,$arr);
		return $data;
	}

	function Tim_thong_bao($timkiem)
	{
		$keyword = "%$timkiem%";
		$arr=array(':keyword'=>$keyword);
		$sql="select * from thong_bao where tieu_de like :keyword";
		$data=$this->selectquery($sql,$arr);
		return $data;
	}
}
?>