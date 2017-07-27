<?php 
@session_start();
include_once("models/m_cau_truc_de_thi.php");
include_once("models/m_bang_chuan.php");
include_once("models/m_phan_thi.php");
include_once("models/m_loai_noi_dung.php");
include_once("models/m_chu_de.php");
include_once("models/m_bang_diem.php");
include_once("models/m_cau_hoi.php");
include_once("models/m_cau_tra_loi.php");
include_once("models/m_bang_tam.php");
class C_ket_qua
{
	public function Ket_qua()
	{
		$m_bang_chuan = new M_bang_chuan();
		$m_phan_thi = new M_phan_thi();
		$m_loai_noi_dung = new m_loai_noi_dung();
		$m_chu_de = new M_chu_de();
		$m_bang_diem = new M_bang_diem();
		$m_cau_hoi = new M_cau_hoi();
		$m_cau_tra_loi = new M_cau_tra_loi();
		$m_bang_tam = new M_bang_tam();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$arr_chu_de = array();
		$dung = 0;
		$a = array();
		$hople =true;
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$time = date("Y-m-d H:i:s");
		if(isset($_SESSION["nguoi_dung"]))
		{
			$ds_bai_lam = "";
			$id_nguoi_dung = $_SESSION["nguoi_dung"];
			if(isset($_POST["Submit"]))
			{
				$diem_chuan = "";
				if(isset($_POST["diem_chuan"]))
				{
					$diem_chuan = $_POST["diem_chuan"];
				}
				if(isset($_POST["cau_truc"]))
				{
					$cau_truc = $_POST["cau_truc"];
				}
				$ds_ma_cau_hoi = $_POST["cauhoi"];
				/*echo "<pre>",print_r($ds_ma_cau_hoi),"</pre>";*/
				if(!isset($_POST["dapan"]))
				{
					$hople = false;
					echo "<script>alert('Bạn không hoàn thành bài thi! Hãy chọn bài thi khác !')</script>";
					echo "<script>window.location='index.php'</script>";
				}
				if($hople)
				{
					//$xoa_dang_nhap = $m_bang_tam->Xoa_bang_tam_theo_nguoi_dung($id_nguoi_dung);
					$ds_ma_cau_tra_loi = $_POST["dapan"];
					foreach($ds_ma_cau_hoi as $key => $ma_cau_hoi)
					{
						foreach($ds_ma_cau_tra_loi as $keya=>$ma_cau_tra_loi)
						{
							$ds_key_a[] = $keya;
							if(in_array($key,$ds_key_a))
							{
								if($key == $keya)
								{
									$them = $m_bang_tam->ThemBangTam($ma_cau_hoi,$ma_cau_tra_loi,$id_nguoi_dung,$time,$diem_chuan,$cau_truc);
								}
							}
						}
						if(!in_array($key,$ds_key_a))
						{
							$them = $m_bang_tam->ThemBangTam($ma_cau_hoi,0,$id_nguoi_dung,$time,$diem_chuan,$cau_truc);
						}
					}
					echo "<script>alert('Nộp bài thành công')</script>";
				}
			}
			$ds_bai_lam = $m_bang_tam->Doc_bang_tam_theo_ma_nguoi_dung($id_nguoi_dung);
			if($ds_bai_lam != null)
			{
				$s_bai_lam = $m_bang_tam->Doc_bang_tam_theo_ma_nguoi_dung_row($id_nguoi_dung);
				$s_cau_truc = $s_bai_lam["ma_cau_truc"];
				if($s_bai_lam["ma_diem_chuan"] == 0)
				{
					$s_diem_chuan = "";
				}
				else
				{
					$s_diem_chuan = $s_bai_lam["ma_diem_chuan"];
				}				
				$ds_phan_thi = $m_phan_thi->Doc_phan_thi_theo_ma_cau_truc($s_cau_truc,$s_diem_chuan);
				$ds_loai_noi_dung = $m_loai_noi_dung->Doc_loai_noi_dung();
				$ds_chu_de_ket_qua = $m_chu_de->Doc_chu_de_ket_qua();
				$ds_diem_bonus = $m_bang_diem->Danh_sach_diem_bonus_theo_ma_phan_thi();
				foreach ($ds_phan_thi as $key => $value)
				{
					$a[$value['ma_phan_thi']]=0;
				}
				foreach($ds_bai_lam as $bai_lam)
				{
					$ma_bai_lam[] = $bai_lam["ma_cau_tra_loi"];
					$ket_qua = $m_cau_tra_loi->Doc_cau_tra_loi_theo_ma_cau_tra_loi($bai_lam["ma_cau_tra_loi"]);
					{
						$c = $ket_qua["ma_phan_thi"];
						if($ket_qua["ket_qua"]==1)
						{
							$dung++;
							$a[$ket_qua["ma_phan_thi"]]++;
						}
					}
					$ds_cau_hoi[] = $m_cau_hoi->Doc_cau_hoi_theo_ma_cau_hoi($bai_lam["ma_cau_hoi"]);
					$ds_cau_tra_loi[] = $m_cau_tra_loi->Doc_cau_tra_loi_theo_ma_cau_hoi($bai_lam["ma_cau_hoi"]);
				}
				if(isset($ds_cau_hoi))
				{
					foreach($ds_cau_hoi as $c_cau_hoi)
					{
						$a_chu_de = $m_chu_de->Doc_chu_de_theo_ma_cau_hoi($c_cau_hoi["ma_cau_hoi"]);
						if(!in_array($a_chu_de,$arr_chu_de))
						{
							$arr_chu_de[] = $m_chu_de->Doc_chu_de_theo_ma_cau_hoi($c_cau_hoi["ma_cau_hoi"]);
						}
					}
					//echo "<pre>",print_r($arr_chu_de),"</pre>";
				}
				foreach($a as $key_id => $value_id)
				{
					$ds_diem[] = $m_bang_diem->Doc_bang_diem_theo_ma_phan_thi($key_id);
					$doc_phan_thi[] = $m_phan_thi->Doc_phan_thi_theo_ma_phan_thi($key_id);
					$check_diem[] = $m_bang_diem->Check_diem_theo_ma_phan_thi($key_id);			
				}
				if(isset($check_diem))
				{
					foreach($check_diem as $check)
					{
						$test_diem[] = $check["ma_phan_thi"];
					}
				}
			}
		}
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$viewmenu = "views/v_menu_trai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/v_ket_qua.php";
		include("include/layout.php");
	}

	public function Bai_Lam()
	{
		$m_bang_tam = new M_bang_tam();
		$id_nguoi_dung = $_SESSION["nguoi_dung"];
		$ds_thoi_gian = $m_bang_tam->Doc_bai_lam($id_nguoi_dung);
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$m_bang_chuan = new M_bang_chuan();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$viewmenu = "views/v_menu_trai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/v_bai_lam.php";
		include("include/layout.php");
	}

	public function Hien_thi_bai_lam()
	{
		$m_bang_tam = new M_bang_tam();
		$m_bang_chuan = new M_bang_chuan();
		$m_phan_thi = new M_phan_thi();
		$m_loai_noi_dung = new m_loai_noi_dung();
		$m_chu_de = new M_chu_de();
		$m_bang_diem = new M_bang_diem();
		$m_cau_hoi = new M_cau_hoi();
		$m_cau_tra_loi = new M_cau_tra_loi();
		$m_bang_tam = new M_bang_tam();
		$arr_chu_de = array();
		$dung = 0;
		$a = array();
		$id_nguoi_dung = $_SESSION["nguoi_dung"];
		if(isset($_POST["xem"]))
		{
			$thoi_gian_lam_bai = $_POST["thoi_gian_lam_bai"];
			$ds_bai_lam = $m_bang_tam->Doc_bai_lam_theo_thoi_gian($id_nguoi_dung,$thoi_gian_lam_bai);
			$s_bai_lam = $m_bang_tam->Doc_bai_lam_theo_thoi_gian_row($id_nguoi_dung,$thoi_gian_lam_bai);
			$s_cau_truc = $s_bai_lam["ma_cau_truc"];
			if($s_bai_lam["ma_diem_chuan"] == 0)
			{
				$s_diem_chuan = "";
			}
			else
			{
				$s_diem_chuan = $s_bai_lam["ma_diem_chuan"];
			}				
			$ds_phan_thi = $m_phan_thi->Doc_phan_thi_theo_ma_cau_truc($s_cau_truc,$s_diem_chuan);
			$ds_loai_noi_dung = $m_loai_noi_dung->Doc_loai_noi_dung();
			$ds_chu_de_ket_qua = $m_chu_de->Doc_chu_de_ket_qua();
			$ds_diem_bonus = $m_bang_diem->Danh_sach_diem_bonus_theo_ma_phan_thi();
			foreach ($ds_phan_thi as $key => $value)
			{
				$a[$value['ma_phan_thi']]=0;
			}
			foreach($ds_bai_lam as $bai_lam)
			{
				$ma_bai_lam[] = $bai_lam["ma_cau_tra_loi"];
				$ket_qua = $m_cau_tra_loi->Doc_cau_tra_loi_theo_ma_cau_tra_loi($bai_lam["ma_cau_tra_loi"]);
				{
					$c = $ket_qua["ma_phan_thi"];
					if($ket_qua["ket_qua"]==1)
					{
						$dung++;
						$a[$ket_qua["ma_phan_thi"]]++;
					}
				}
				$ds_cau_hoi[] = $m_cau_hoi->Doc_cau_hoi_theo_ma_cau_hoi($bai_lam["ma_cau_hoi"]);
				$ds_cau_tra_loi[] = $m_cau_tra_loi->Doc_cau_tra_loi_theo_ma_cau_hoi($bai_lam["ma_cau_hoi"]);
			}
			if(isset($ds_cau_hoi))
			{
				foreach($ds_cau_hoi as $c_cau_hoi)
				{
					$a_chu_de = $m_chu_de->Doc_chu_de_theo_ma_cau_hoi($c_cau_hoi["ma_cau_hoi"]);
					if(!in_array($a_chu_de,$arr_chu_de))
					{
						$arr_chu_de[] = $m_chu_de->Doc_chu_de_theo_ma_cau_hoi($c_cau_hoi["ma_cau_hoi"]);
					}
				}
				//echo "<pre>",print_r($arr_chu_de),"</pre>";
			}
			foreach($a as $key_id => $value_id)
			{
				$ds_diem[] = $m_bang_diem->Doc_bang_diem_theo_ma_phan_thi($key_id);
				$doc_phan_thi[] = $m_phan_thi->Doc_phan_thi_theo_ma_phan_thi($key_id);
				$check_diem[] = $m_bang_diem->Check_diem_theo_ma_phan_thi($key_id);			
			}
			if(isset($check_diem))
			{
				foreach($check_diem as $check)
				{
					$test_diem[] = $check["ma_phan_thi"];
				}
			}
		}
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$m_bang_chuan = new M_bang_chuan();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$viewmenu = "views/v_menu_trai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/v_hien_thi_bai.php";
		include("include/layout.php");
	}
}
?>