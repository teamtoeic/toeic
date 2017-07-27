<?php
include("models/m_thong_bao.php");
include("models/m_cau_truc_de_thi.php");
include("models/m_bang_chuan.php");
class C_thong_bao{
	public function Hien_thi_thong_bao()
	{

		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$m_bang_chuan = new M_bang_chuan();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$tb=NULL;
		$ma_thong_bao=NULL;
		$m_thong_bao=new M_thong_bao();
		$thong_baos=$m_thong_bao->Doc_danh_sach_thong_bao();
		if($thong_baos!=NULL)
		{
			foreach ($thong_baos as $tb) {
				$ma_thong_bao=$tb["ma_thong_bao"];
				break;
			}
			if(isset($_GET['ma_thong_bao']))
			{
				$ma_thong_bao=$_GET['ma_thong_bao'];
			}
			$thong_bao=$m_thong_bao->Doc_thong_bao_theo_ma($ma_thong_bao);
			
		}
		else{
			$tb="Hiện không có thông báo mới";
		}


		$viewmenu = "views/v_menu_trai.php";
		$menu_phai="views/menu_phai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/giao_dien/v_thong_bao.php";
		include("include/layout.php");
	}

	public function Tim_kiem_thong_bao()
	{
		$m_thong_bao=new M_thong_bao();
		$ds_thong_bao = "";
		if(isset($_GET["keyword"]))
		{
			$keyword = $_GET["keyword"];
			$ds_thong_bao = $m_thong_bao->Tim_thong_bao($keyword);
		}
		return $ds_thong_bao;
	}
}
?>