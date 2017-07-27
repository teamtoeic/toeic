<?php
@session_start();
include_once("models/m_nguoi_dung.php");
include_once("models/m_bang_chuan.php");
include_once("models/m_cau_truc_de_thi.php");
include_once("models/m_phan_thi.php");
include_once("models/m_loai_noi_dung.php");
include_once("models/m_chu_de.php");
include_once("models/m_bang_diem.php");
include_once("models/m_bang_tam.php");
class C_nguoi_dung
{
	public function Dang_Nhap()
	{
		$m_nguoi_dung = new M_nguoi_dung();
		$m_bang_tam = new M_bang_tam();
		if(isset($_POST["dang_nhap"]))
		{
			$user_login = $_POST["user_login"];
			$pass_login = md5($_POST["pass_login"]);
			$kiem_tra_login = $m_nguoi_dung->Doc_nguoi_dung_theo_user_pass($user_login,$pass_login);
			if($kiem_tra_login == null || $kiem_tra_login["kich_hoat"]==0)
			{
				echo "<script>alert('Không tồn tại tài khoản này')</script>";
				echo "<script>window.history.back()</script>";
			}
			if($kiem_tra_login != null && $kiem_tra_login["kich_hoat"]==1)
			{
				$_SESSION["nguoi_dung"]= $kiem_tra_login["ma_nguoi_dung"];
				$id_nguoi_dung = $_SESSION["nguoi_dung"];
				$_SESSION["ten_nguoi_dung"] = $kiem_tra_login["ten_nguoi_dung"];
				echo "<script>alert('Đăng nhập thành công')</script>";
				echo "<script>window.history.back()</script>";
			}
		}
	}
	public function Dang_Ky()
	{
		$m_nguoi_dung = new M_nguoi_dung();
		$hople = true;
		$tb = "";
		if(isset($_POST["dang_ky"]))
		{
			$ten_nguoi_dung = $_POST["ten_nguoi_dung"];
			$dia_chi = $_POST["dia_chi"];
			$email = $_POST["email"];
			$sdt = $_POST["sodt"];
			$user = $_POST["user"];
			$pass = md5($_POST["pass"]);
			$xac_nhan_pass = md5($_POST["xac_nhan_pass"]);
			$ktra_nguoi_dung = $m_nguoi_dung->Kiem_tra_nguoi_dung($user);
			if($ktra_nguoi_dung != null)
			{
				$tb .= "Tên tài khoản bị trùng.".'\n';
				$hople = false;
			}
			if($ten_nguoi_dung=="" || $dia_chi=="" || $email=="" || empty($sdt) || $user=="" || $pass=="" || $xac_nhan_pass=="")
			{
				$tb .= "Không được để rỗng bất kì thông tin nào.".'\n';
				$hople = false;
			}
			if(!is_numeric($sdt))
			{
				$tb .= "Số điện thoại chỉ được nhập số. ".'\n';
				$hople = false;
			}
			if($pass != $xac_nhan_pass)
			{
				$tb .= "Mật khẩu nhập lại không trùng khớp.";
				$hople = false;
			}
			if(!$hople)
			{
				echo "<script>alert('$tb')</script>";
				echo "<script>window.location='index.php'</script>";
			}
			if($hople)
			{
				$them_nguoi_dung = $m_nguoi_dung->Them_nguoi_dung(NULL,$ten_nguoi_dung,$dia_chi,$email,$sdt,$user,$pass,0,0); //
				echo "<script>alert('Đăng ký thành công')</script>";
				if(isset($them_nguoi_dung))
				{
					$nguoi_dung_cuoi = $m_nguoi_dung->Doc_nguoi_dung_dang_ky_cuoi();
					$noi_dung = "http://localhost/TracNghiem18-7/kich_hoat.php?abc=".md5($nguoi_dung_cuoi["ma_nguoi_dung"])."&def=".md5($nguoi_dung_cuoi["username"]);
					require_once("smtpgmail/class.phpmailer.php");
					$mail=new PHPMailer();
					$mail->IsSMTP(); 
					$mail->SMTPAuth=TRUE;
					$mail->Host="smtp.gmail.com";
					$mail->Port=465;
					$mail->SMTPSecure="ssl";
					$mail->Username="steven.duy95@gmail.com"; 
					$mail->Password="neverwalkalone18";
					$mail->CharSet="utf-8";
					$noidung="Họ tên: " .$ten_nguoi_dung;
					$noidung .=" Email:" .$email;
					$noidung .="<hr><br>Hãy nhấn vào link dưới để kích hoạt Email";
					$noidung .="<br>" .$noi_dung;
					$mail->SetFrom($email,$ten_nguoi_dung);
					$mail->Subject="Xác Nhận Mail";
					$mail->MsgHTML($noidung);
					  
					$mail->AddAddress($email,"Khach hang"); 
					  
					$mail->AddBCC("steven.duy95@gmail.com","Admin");
					if(!$mail->Send())
					{
						echo "<script>alert('Mail lỗi'.$mail->ErrorInfo)</script>";
					}
					else
					{
						echo "<script>alert('Mã kích hoạt đã được gửi đến Email')</script>";
					}
				}
				echo "<script>window.history.back()</script>";
			}
		}
	}

	public function Kich_Hoat()
	{
		$m_nguoi_dung = new M_nguoi_dung();
		if(isset($_GET["abc"]) && isset($_GET["def"]))
		{
			$abc = $_GET["abc"];
			$loc_danh_sach = $m_nguoi_dung->Doc_danh_sach_nguoi_dung_chua_kich_hoat();
			foreach($loc_danh_sach as $loc)
			{
				if(md5($loc["ma_nguoi_dung"]==$abc))
				{
					$update = $m_nguoi_dung->Kich_hoat($loc["ma_nguoi_dung"]);
					echo "<script>alert('Kích hoạt thành công')</script>";
					echo "<script>window.location='index.php'</script>";
				}
			}
		}
	}

	public function Dang_Xuat()
	{
		$m_bang_tam = new M_bang_tam();
		$id_nguoi_dung = $_SESSION["nguoi_dung"];
		//$xoa_dang_nhap = $m_bang_tam->Xoa_bang_tam_theo_nguoi_dung($id_nguoi_dung);
		session_unset($_SESSION["nguoi_dung"]);
		unset($_SESSION["ten_nguoi_dung"]);
		echo "<script>alert('Đăng xuất tài khoản thành công')</script>";
		echo "<script>window.location='index.php'</script>";
	}

	public function Forgot_Pass()
	{
		$m_nguoi_dung=new M_nguoi_dung();
		if(isset($_POST["gui"]))
		{
			$user_forgot = $_POST["username"];
			$email_forgot = $_POST["email"];
			if($user_forgot != "" && $email_forgot != "")
			{
				$doc_user = $m_nguoi_dung->Doc_nguoi_dung_theo_user_email($user_forgot,$email_forgot);
				if($doc_user == null)
				{
					echo "<script>alert('Không tồn tại thông tin tài khoản này')</script>";
				}
				if($doc_user != null)
				{
					$noi_dung = "http://localhost/TracNghiem18-7/change_pass.php?aaa=".md5($doc_user["ma_nguoi_dung"])."&bbb=".md5($doc_user["username"]);
					require_once("smtpgmail/class.phpmailer.php");
					$mail=new PHPMailer();
					$mail->IsSMTP(); 
					$mail->SMTPAuth=TRUE;
					$mail->Host="smtp.gmail.com";
					$mail->Port=465;
					$mail->SMTPSecure="ssl";
					$mail->Username="steven.duy95@gmail.com"; 
					$mail->Password="neverwalkalone18";
					$mail->CharSet="utf-8";
					$noidung="Họ tên: " .$doc_user["ten_nguoi_dung"];
					$noidung .="<hr><br>Hãy nhấn vào link dưới để reset mật khẩu";
					$noidung .="<br>" .$noi_dung;
					$mail->SetFrom($email_forgot,$doc_user["ten_nguoi_dung"]);
					$mail->Subject="Xác Nhận Mail";
					$mail->MsgHTML($noidung);
					  
					$mail->AddAddress($email_forgot,"Khach hang"); 
					  
					$mail->AddBCC("steven.duy95@gmail.com","Admin");
					if(!$mail->Send())
					{
						echo "<script>alert('Mail lỗi'.$mail->ErrorInfo)</script>";
					}
					else
					{
						echo "<script>alert('Mã reset đã được gửi đến Email')</script>";
						echo "<script>window.location='index.php'</script>";
					}
				}
			}
		}
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$m_bang_chuan = new M_bang_chuan();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$ds_de_chuan = $m_cau_truc_de_thi->Danh_sach_cau_truc_de_chuan();
		$viewmenu = "views/v_menu_trai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/giao_dien/v_forgot_pass.php";
		include("include/layout.php");
	}

	public function Change_Pass()
	{
		$m_nguoi_dung=new M_nguoi_dung();
		if(isset($_GET["aaa"]) && isset($_GET["bbb"]))
		{
			$aaa = $_GET["aaa"];
			$danh_sach = $m_nguoi_dung->Doc_danh_sach_nguoi_dung();
			foreach($danh_sach as $ds)
			{
				if(md5($ds["ma_nguoi_dung"]==$aaa))
				{
					$user_change = $ds["ma_nguoi_dung"];
				}
			}
			if(isset($_POST["capnhat"]) && isset($user_change))
			{
				$password = md5($_POST["password"]);
				if($password == "")
				{
					echo "<script>alert('Không được để trống mật khẩu')</script>";
					echo "<script>window.history.back()</script>";
				}
				else
				{
					$update = $m_nguoi_dung->Doi_mat_khau($password,$user_change);
					echo "<script>alert('Cập nhật thành công')</script>";
					echo "<script>window.location='index.php'</script>";
				}
			}
		}
		
		$view = "views/giao_dien/v_change_pass.php";
		$tittle = "Toeic Online";
		include("include/layout.php");
	}

	public function Reset_password()
	{
		if($_SESSION["nguoi_dung"]!=NULL)
		{
			$id_nguoi_dung=$_SESSION["nguoi_dung"];
			$m_nguoi_dung=new M_nguoi_dung();
			$nguoi_dung=$m_nguoi_dung->Doc_nguoi_dung_theo_ma_nguoi_dung($id_nguoi_dung);
		}
		if(isset($_POST["submit"]))
		{
			$pass=$_POST["pass_login"];
			$new_pass=$_POST["reset_pass"];
			$new_pass1=$_POST["reset_pass1"];
			$hople=true;
			$tb="";
			if($pass=="" || $new_pass=="" || $new_pass1=="" )
			{
				$tb.="Phải nhập thông tin đầy đủ";
				$hople=false;
			}
			if(strcmp(md5($pass),$nguoi_dung["password"]))
			{
				$tb .="Nhập mật khẩu sai";
				$hople=false;
			}
			if(strcmp($new_pass, $new_pass1))
			{
				$tb .="Nhập mật khẩu mới không trùng khớp";
				$hople=false;
			}
			if($hople)
			{
				$kq=$m_nguoi_dung->Doi_mat_khau(md5($new_pass),$id_nguoi_dung);
				echo "<script>alert('Cập nhật thông tin tài khoản thành công')</script>";
				echo "<script>alert('Hãy đăng nhập lại')</script>";
				session_unset($_SESSION["nguoi_dung"]);
				unset($_SESSION["ten_nguoi_dung"]);
				echo "<script>window.location='index.php'</script>";
			}
			if(!$hople){
				echo "<script>alert('Cập nhật thông tin tài khoản không thành công')</script>";
				echo "<script>window.history.back()</script>";
			}
		}
	}
	public function Profile()
	{
		$m_nguoi_dung=new M_nguoi_dung();
		$id_nguoi_dung=$_SESSION["nguoi_dung"];
		//echo "<pre>",print_r($id_nguoi_dung),"</pre>";
		$nguoi_dung=$m_nguoi_dung->Doc_nguoi_dung_theo_ma_nguoi_dung($id_nguoi_dung);
		//echo "<pre>",print_r($nguoi_dung),"</pre>";
		if(isset($_POST["submit"]))
		{
			$ten_nguoi_dung=$_POST["ten_nguoi_dung"];
			$dia_chi=$_POST["dia_chi"];
			$email=$_POST["email"];
			$sdt = $_POST["sdt"];
			$hople=true;
			$tb="";
			if($ten_nguoi_dung=="" || $dia_chi=="" || $email=="" || $sdt == "")
			{
				$tb.="Phải nhập thông tin đầy đủ";
				$hople=false;
			}
			if(!is_numeric($sdt))
			{
				$tb .="Số điện thoại chỉ được nhập số";
				$hople=false;
			}
			if($hople)
			{
				$kq=$m_nguoi_dung->Edit_Profile($ten_nguoi_dung,$dia_chi,$email,$sdt,$id_nguoi_dung);
				echo "<script>alert('Cập nhật thông tin tài khoản thành công')</script>";
				echo "<script>window.location='index.php'</script>";
			}
			if(!$hople){
				echo "<script>alert('Cập nhật thông tin tài khoản không thành công')</script>";
				echo "<script>window.history.back()</script>";
			}
		}
		$m_cau_truc_de_thi=new M_cau_truc_de_thi();
		$m_bang_chuan = new M_bang_chuan();
		$ds_luyen_tap=$m_cau_truc_de_thi->Danh_sach_cau_truc_luyen_tap();
		$ds_cau_truc=$m_cau_truc_de_thi->Danh_sach_cau_truc_de_thi();
		$ds_bang_chuan = $m_bang_chuan->GetBangChuan();
		$viewmenu = "views/v_menu_trai.php";
		$tittle = "Toeic Online";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view = "views/giao_dien/v_form_profile.php";
		include("include/layout.php");
	}
}
?>