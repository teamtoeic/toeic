<?php
include("models/m_thong_bao.php");
include("models/m_cau_truc_de_thi.php");
include("models/m_bang_chuan.php");
class C_gioi_thieu
{
	function Hien_thi_gioi_thieu(){
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$m_bang_chuan = new M_bang_chuan();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$m_thong_bao=new M_thong_bao();
		$thong_baos=$m_thong_bao->Doc_danh_sach_thong_bao();
		
		$viewmenu = "views/v_menu_trai.php";
		$menu_phai="views/menu_phai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/giao_dien/v_gioi_thieu.php";
		include("include/layout.php");
	}
}
?>