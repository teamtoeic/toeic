<?php
include("models/m_cau_truc_de_thi.php");
include("models/m_bang_chuan.php");
class C_thoi_gian{
	function Thoi_gian()
	{
		$thoi_gian_co_dinh = NULL;
		if(isset($_GET["ma_cau_truc"]))
		{
			$ma_cau_truc=$_GET["ma_cau_truc"];
		}
		if(isset($_GET["diem_chuan"]))
		{
			$ma_diem_chuan=$_GET["diem_chuan"];
		}
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$m_bang_chuan = new M_bang_chuan();
		$doc_cau_truc = $m_cau_truc_de_thi->Doc_cau_truc_theo_ma_cau_truc($ma_cau_truc); 
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$viewmenu = "views/v_menu_trai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/de_thi/v_thoi_gian.php";
		include("include/layout.php");
	}
}
?>