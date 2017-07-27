<?php 
include_once("database.php");
class M_nguoi_dung extends DB{
	public function Doc_nguoi_dung_theo_user_pass($user,$pass)
	{
		$sql = "SELECT * FROM nguoi_dung WHERE username = :user and password = :pass";
		$arr = array(":user"=>$user,":pass"=>$pass);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}

	public function Kiem_tra_nguoi_dung($user)
	{
		$sql = "SELECT * FROM nguoi_dung WHERE username = :user";
		$arr = array(":user"=>$user);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}

	public function Doc_nguoi_dung_theo_ma_nguoi_dung($ma_nguoi_dung)
	{
		$arr = array(":ma_nguoi_dung"=>$ma_nguoi_dung);
		$sql = "SELECT * FROM nguoi_dung WHERE ma_nguoi_dung = :ma_nguoi_dung";
		$data = $this->selectrow($sql,$arr);
		return $data;
	}

	public function Them_nguoi_dung($ma_nguoi_dung,$ten_nguoi_dung,$dia_chi,$email,$sdt,$user,$pass,$quyen_han,$kich_hoat)
	{
		$sql = "INSERT INTO nguoi_dung VALUES(:ma_nguoi_dung, :ten_nguoi_dung, :dia_chi, :email, :sdt, :user, :pass, :quyen_han, :kich_hoat)";
		$arr = array(":ma_nguoi_dung"=>$ma_nguoi_dung,":ten_nguoi_dung"=>$ten_nguoi_dung,":dia_chi"=>$dia_chi,":email"=>$email,":sdt"=>$sdt,":user"=>$user,":pass"=>$pass,":quyen_han"=>$quyen_han, ":kich_hoat"=>$kich_hoat);
		$data = $this->selectquery($sql,$arr);
		return $data;
	}

	public function Doi_mat_khau($password,$ma_nguoi_dung)
	{
		$arr=array(':ma_nguoi_dung'=>$ma_nguoi_dung,':password'=>$password);
		$sql="UPDATE nguoi_dung SET password=:password WHERE ma_nguoi_dung=:ma_nguoi_dung";
		$data=$this->selectrow($sql,$arr);
		return $data;
	}
	public function Edit_Profile($ten_nguoi_dung,$dia_chi,$email,$sdt,$ma_nguoi_dung)
	{
		$arr=array(':ten_nguoi_dung'=>$ten_nguoi_dung,':dia_chi'=>$dia_chi,':email'=>$email,':sdt'=>$sdt,':ma_nguoi_dung'=>$ma_nguoi_dung);
		$sql="UPDATE nguoi_dung set ten_nguoi_dung = :ten_nguoi_dung, dia_chi = :dia_chi, email = :email, sdt = :sdt where ma_nguoi_dung = :ma_nguoi_dung";
		$data=$this->selectquery($sql,$arr);
		return $data;
	}

	public function Doc_nguoi_dung_dang_ky_cuoi()
	{
		$sql = "SELECT * FROM nguoi_dung order by ma_nguoi_dung DESC limit 1";
		$data = $this->selectrow($sql);
		return $data;
	}

	public function Kich_hoat($id)
	{
		$arr=array(':ma_nguoi_dung'=>$id);
		$sql="UPDATE nguoi_dung set kich_hoat = 1 where ma_nguoi_dung = :ma_nguoi_dung";
		$data=$this->selectquery($sql,$arr);
		return $data;
	}

	public function Doc_danh_sach_nguoi_dung_chua_kich_hoat()
	{
		$sql = "SELECT * FROM nguoi_dung WHERE kich_hoat = 0";
		$data = $this->selectquery($sql);
		return $data;
	}

	public function Doc_nguoi_dung_theo_user_email($user,$email)
	{
		$sql = "SELECT * FROM nguoi_dung WHERE username = :user and email = :email";
		$arr = array(":user"=>$user,":email"=>$email);
		$data = $this->selectrow($sql,$arr);
		return $data;
	}

	public function Doc_danh_sach_nguoi_dung()
	{
		$sql = "SELECT * FROM nguoi_dung";
		$data = $this->selectquery($sql);
		return $data;
	}
}
?>