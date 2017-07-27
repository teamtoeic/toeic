<?php
@session_start();
include_once("models/m_bang_chuan.php");
include_once("models/m_nguoi_dung.php");
include_once("models/m_cau_truc_de_thi.php");
class C_Index
{
	public function Index()
	{
		$m_bang_chuan = new M_bang_chuan();
		$m_nguoi_dung = new M_nguoi_dung();
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$time = date("Y-m-d H:i:s");
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();

		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/v_content.php";
		$viewmenu = "views/v_menu_trai.php";
		include("include/layout.php");
	}
}