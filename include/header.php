<?php 
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="public/images/icon.ico" rel="shortcut icon" type="image/x-icon" />  
	<title><?php echo $tittle ?></title>

	<link rel="stylesheet" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/font-awesome.css">
	<link rel="stylesheet" href="public/css/style.css">
	<script src="public/js/jquery-3.1.1.min.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="public/js/simpla.jquery.configuration.js"></script>
	<script type="text/javascript" src="public/js/kiem_tra_lien_he.js"></script>
</head>

<body>
	<header class="container-fluid">
			<nav class="row navbar navbar-default">
				<div class="row col-md-2"><a href="trang-chu"><img src="public/images/logo.gif" alt="logo"></a></div>
				<div class="col-md-5">
					<?php include("menubar.php") ?>
				</div>
				<div class="col-md-2" style="margin-top: 30px;>
					<form action="" method="post" class="navbar-form navbar-left">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search..." id="tim_kiem_tb">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-3">
					<ul class="nav navbar-nav navbar-left" style="margin-top: 20px; font-weight: bold;">
						<li><a href="#" data-toggle="modal" data-target="#DangKy">Đăng Ký</a></li>
						<?php if(!isset($_SESSION["nguoi_dung"])){ ?><li><a href="#" data-toggle="modal" data-target="#DangNhap">Đăng Nhập</a></li><?php } ?>
						<?php if(isset($_SESSION["ten_nguoi_dung"])){ ?><li>
						<div class="dropdown col-md-2">
	    <button class="btn btn-default dropdown-toggle glyphicon glyphicon-user" type="button" data-toggle="dropdown"><span style="font-weight: bold; padding-left: 5px; font-size: 18px;"><?php echo $_SESSION["ten_nguoi_dung"]; ?></span>
	    <span class="caret"></span></button>
						<ul class="dropdown-menu">
	     					<li><a href="profile.php">Tài Khoản Của Tôi</a></li>
	      					<li><a href="#" data-toggle="modal" data-target="#DoiMatKhau">Đổi Mật Khẩu</a></li>
	      					<li><a href="bai_lam.php">Bài Làm</a></li>
	      					<li class="divider"></li>
	      					<li><a href="dang_xuat.php">Thoát</a></li>
	    				</ul>
	   					 <?php } 
	   					 include("modal_reset_pass.php");
	   					 ?>
	   					 </li>
					</ul>
				</div>
			</nav>
			<?php include("modal_dangky.php") ?>
			<?php include("modal_dangnhap.php") ?>
	</header>
	<script>
	$(document).ready(function()
	{
		$("#tim_kiem_tb").keyup(function()
		{
			var tim_kiem_tb = $(this).val();
			//alert(tim_kiem_tb);
			$.get("tim_thong_bao.php?keyword="+tim_kiem_tb,function(data){
				$("#hienthi").html('');
				$("#hienthi").append(data);
			})
		})
	})
	</script>