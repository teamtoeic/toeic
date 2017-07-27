<?php 
class C_lien_he{
	function Lien_he(){
		include_once("captcha.php");
		if(!isset($_POST["th_gui"]))
		{
			taocaptcha();
		}
		if(isset($_POST['th_gui']))
		{
			if($_POST["th_email"] == "")
			{
				echo "<script>alert('Không được để mail rỗng')</script>";
			}
			else{
			  require_once("smtpgmail/class.phpmailer.php");
			  $mail=new PHPMailer();
			  $mail->IsSMTP(); // Chứng thực SMTP
			  $mail->SMTPAuth=TRUE;
			  $mail->Host="smtp.gmail.com";
			  $mail->Port=465;
			  $mail->SMTPSecure="ssl";
			  /* Server google*/
			  $mail->Username="tienminh31995@gmail.com"; 
			  $mail->Password="tienminh1901";
			  /* Server google*/
			  $mail->CharSet="utf-8";
			  $noidung="Họ tên: " .$_POST["th_hoten"];
			  $noidung .=" Email:" .$_POST["th_email"];
			  $noidung .="<hr><br>Chủ đề:" .$_POST["th_chude"];
			  $noidung .="<br>Nội dung:" .$_POST["th_noidung"];
			  $mail->SetFrom($_POST["th_email"],$_POST["th_hoten"]);
			  $mail->Subject=$_POST["th_chude"];
			  $mail->MsgHTML($noidung);
			  
			  $mail->AddAddress($_POST["th_email"],"Khach hang"); 
			  
			  $mail->AddBCC("tienminh31995@gmail.com","Admin");
			  if($_POST["security_code"]==$_SESSION["code"])
			  {
				  if(!$mail->Send())
				  {
					  echo "<script>alert('Mail lỗi')</script>";
				  }
				  else
				  {
					  echo "<script>alert('Gửi mail thành công')</script>";
				  }
			  }
			  else
			  {
				  echo "<script>alert('Nhập mã bảo vệ')</script>";	
			  }
			}
		}
		$tittle="Liên hệ | Thi trắc nghiệm TOEIC";
		$form_dang_ky ="views/giao_dien/v_form_dang_ky.php";
		$form_dang_nhap = "views/giao_dien/v_form_dang_nhap.php";
		$form_reset_pass="views/giao_dien/v_form_reset_pass.php";
		$view="views/giao_dien/v_lien_he.php";
		include("include/layout.php");
	}
}
?>