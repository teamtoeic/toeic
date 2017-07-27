<?php
@session_start();
include_once("models/m_cau_truc_de_thi.php");
include("models/m_phan_thi.php");
include("models/m_loai_noi_dung.php");
include("models/m_cau_hoi.php");
include("models/m_chu_de.php");
include("models/m_cau_tra_loi.php");
include("models/m_bang_chuan.php");
include("models/m_muc_do.php");
class C_de_thi_toeic{
	function Hien_thi_de_thi()
	{
		$m_phan_thi = new M_phan_thi();
		$m_loai_noi_dung = new M_loai_noi_dung();
		$m_cau_hoi = new M_cau_hoi();
		$m_chu_de = new M_chu_de();
		$m_cau_tra_loi = new M_cau_tra_loi();
		$m_bang_chuan = new M_bang_chuan();
		$m_do_kho = new M_do_kho();
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$socau = 0;
		$dem_thu_tu_cau=1;
		$ma_cau_truc = "";
		$ma_diem_chuan = "";
		$hople = true;
		$ds_phan_thi = "";
		if(isset($_POST["bat_dau"]))
		{
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$thoi_gian = date("Y-m-d H:i:s");
			$diem_chuan = "";
			$cau_truc = "";
			$tinh_thoi_gian = "";
			if(isset($_POST["diem_chuan"]))
			{
				$ma_diem_chuan = $_POST["diem_chuan"];
			}
			if(isset($_POST["cau_truc"]))
			{
				$ma_cau_truc = $_POST["cau_truc"];
			}
			if(isset($_POST["tinh_thoi_gian"]))
			{
				$tinh_thoi_gian = $_POST["tinh_thoi_gian"];
				if($tinh_thoi_gian == "")
				{
					$hople = false;
					echo "<script>alert('Không được để rỗng thời gian')</script>";
					echo "<script>window.history.back()</script>";
				}
				/*if($tinh_thoi_gian < 10 || $tinh_thoi_gian > 180)
				{
					$hople = false;
					echo "<script>alert('Không được nhập thời gian < 10 và lớn hơn 180')</script>";
					echo "<script>window.history.back()</script>";
				}*/
			}
			if($hople)
			{
				$check_cau_hoi = array();
				$check_chu_de = array();
				$doc_cau_hoi_theo_chu_de = array();
				$ds_cau_hoi = array();
 				$ds_phan_thi = $m_phan_thi->Doc_phan_thi_theo_ma_cau_truc($ma_cau_truc,$ma_diem_chuan);
 				$doc_cau_truc = $m_cau_truc_de_thi->Doc_cau_truc_theo_ma_cau_truc($ma_cau_truc);
				$ds_loai_noi_dung = $m_loai_noi_dung->Doc_loai_noi_dung();
				$ds_do_kho = $m_do_kho->GetMucDo();
				foreach($ds_loai_noi_dung as $loai_noi_dung)
				{
					$doc_chi_tiet_cau_truc[] = $m_loai_noi_dung->Doc_chi_tiet_cau_truc_theo_ma_loai_noi_dung($loai_noi_dung["ma_loai_noi_dung"]);
				}
				foreach($doc_chi_tiet_cau_truc as $doc_chi_tiet)
				{
					foreach($doc_chi_tiet as $chi_tiet)
					{
						if($ma_diem_chuan == $chi_tiet["ma_diem_chuan"])
						{
							$dem_tong[$chi_tiet["ma_loai_noi_dung"].$chi_tiet["ma_do_kho"]] = 0;
							$tong[$chi_tiet["ma_loai_noi_dung"].$chi_tiet["ma_do_kho"]] = 0;
							$arr_cau_hoi_random[] = $m_cau_hoi->Doc_cau_hoi_random($chi_tiet["ma_loai_noi_dung"],$chi_tiet["ma_do_kho"],$chi_tiet["so_luong_cau"]);
							$tong[$chi_tiet["ma_loai_noi_dung"].$chi_tiet["ma_do_kho"]] = $chi_tiet["so_luong_cau"];
						}
					}
				}
				foreach($arr_cau_hoi_random as $ds_cau_hoi_random)
				{
					foreach($ds_cau_hoi_random as $cau_hoi_random)
					{
						if(!in_array($cau_hoi_random["ma_chu_de"],$check_cau_hoi))
						{
							$check_cau_hoi[] = $cau_hoi_random["ma_chu_de"];
							$ds_cau_hoi[] = $m_cau_hoi->Doc_cau_hoi_theo_ma_chu_de($cau_hoi_random["ma_chu_de"]);		
						}
					}
				}
				foreach($ds_cau_hoi as $c_cau_hoi)
				{ 
					foreach($c_cau_hoi as $t_cau_hoi)
					{   
						$arr_chu_de[] = $m_chu_de->Doc_chu_de_theo_ma_cau_hoi($t_cau_hoi["ma_cau_hoi"]);
					}
				}
				$ds_chu_de = $m_chu_de->Doc_chu_de();
				$ds_cau_tra_loi = $m_cau_tra_loi->Doc_cau_tra_loi();
			}
		}
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$viewmenu = "views/v_menu_trai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/de_thi/v_de_thi.php";
		include("include/layout.php");
	}

	function Hien_thi_de_chuan()
	{
		$m_phan_thi = new M_phan_thi();
		$m_loai_noi_dung = new M_loai_noi_dung();
		$m_cau_hoi = new M_cau_hoi();
		$m_chu_de = new M_chu_de();
		$m_bang_chuan = new M_bang_chuan();
		$m_cau_tra_loi = new M_cau_tra_loi();
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$socau = 0;
		$dem_thu_tu_cau=1;
		$ma_cau_truc = "";
		$ma_diem_chuan = "";
		$hople = true;
		$ds_phan_thi = "";
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$thoi_gian = date("Y-m-d H:i:s");
		$cau_truc = "";
		$ma_diem_chuan = NULL;
		if(isset($_GET["cau_truc"]))
		{
			$ma_cau_truc = $_GET["cau_truc"];
		}
			$doc_cau_truc = $m_cau_truc_de_thi->Doc_cau_truc_theo_ma_cau_truc($ma_cau_truc);
			$tinh_thoi_gian = $doc_cau_truc["thoi_gian_co_dinh"];
			$check_cau_hoi = array();
			$check_chu_de = array();
			$doc_cau_hoi_theo_chu_de = array();
			$ds_cau_hoi = array();
			$ds_phan_thi = $m_phan_thi->Doc_phan_thi_theo_cau_truc($ma_cau_truc);
			foreach($ds_phan_thi as $phan_thi)
			{
				$ds_loai_noi_dung[] = $m_loai_noi_dung->Doc_loai_noi_dung_theo_phan_thi($phan_thi["ma_phan_thi"]);
			}
			foreach($ds_loai_noi_dung as $loai_noi_dungs)
			{
				foreach($loai_noi_dungs as $loai_noi_dung)
				{
					$ds_cau_hoi[] = $m_cau_hoi->Doc_cau_hoi_theo_loai_noi_dung($loai_noi_dung["ma_loai_noi_dung"],$loai_noi_dung["so_luong_cau_hoi"]);
				} 
			}
			foreach($ds_cau_hoi as $c_cau_hoi)
			{ 
				foreach($c_cau_hoi as $t_cau_hoi)
				{   
					$arr_chu_de[] = $m_chu_de->Doc_chu_de_theo_ma_cau_hoi($t_cau_hoi["ma_cau_hoi"]);
				}
			}
			$ds_chu_de = $m_chu_de->Doc_chu_de_de_chuan();
			$ds_cau_tra_loi = $m_cau_tra_loi->Doc_cau_tra_loi();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$viewmenu = "views/v_menu_trai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/de_thi/v_de_chuan.php";
		include("include/layout.php");
	}
}
?>
