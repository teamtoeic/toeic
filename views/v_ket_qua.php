<?php
//echo "<pre>",print_r($ds_ket_qua_dung),"</pre>";
//echo "<pre>",print_r($ds_phan_thi),"</pre>";
//echo "<pre>",print_r($a),"</pre>";
//echo "<pre>",print_r($ds_diem),"</pre>";
//echo "<pre>",print_r($test_diem),"</pre>";
//echo "<pre>",print_r($doc_phan_thi),"</pre>";
//echo "<pre>",print_r($arr_chu_de),"</pre>";
if(isset($_SESSION["nguoi_dung"]))
{
$socau = 1;
$dem = 0; 
$tong = 0;
?>
<div class="col-md-offset-1 col-m-9">
<?php
	foreach($a as $key_kq => $kq)
	{
		$i = 5;
		foreach($ds_diem as $diems)
		{
			if($diems != null && in_array($key_kq,$test_diem))
			{
				foreach($diems as $diem)
				{
					if($diem["ma_phan_thi"] == $key_kq)
					{
						if($diem["min"] <= $kq && $diem["max"] >= $kq && $diem["tinh_trang"]==0)
						{
							$i = 5;
						}
						if($diem["min"] <= $kq && $diem["max"] >= $kq && $diem["tinh_trang"]==1)
						{
							for($so_cau = $diem["min"]; $so_cau <= $kq; $so_cau++)
							{
								$i += 5;
								foreach($ds_diem_bonus as $diem_bonus)
								{
									if($diem_bonus["ma_phan_thi"]==$key_kq)
									{
										if($diem_bonus["so_cau"]==$so_cau)
										{
											$i += 5;
										}
									}
								}
							}
						}
						if($diem["min"] <= $kq && $diem["max"] >= $kq && $diem["tinh_trang"]==2)
						{
							foreach($doc_phan_thi as $chi_tiet_phan_thi)
							{
								if($chi_tiet_phan_thi["ma_phan_thi"] == $key_kq)
								{
									$i = $chi_tiet_phan_thi["tong_diem"];
								}
							}
						}
					}
				}
			}
			if($diems == null && !in_array($key_kq,$test_diem))
			{
				for($so_cau = 2; $so_cau <= $kq; $so_cau++)
				{
					$i += 5;
					if($so_cau == $kq)
					{
						foreach($doc_phan_thi as $chi_tiet_phan_thi)
						{
							if($chi_tiet_phan_thi["ma_phan_thi"] == $key_kq && $kq == $chi_tiet_phan_thi["tong_diem"])
							{
								$i = $chi_tiet_phan_thi["tong_diem"];
							}
						}
					}
				}
			}
		}
		$tong += $i;
		?>
		<div>Số Điểm : <?php echo $i ?></div>
		<div>Số Câu Đúng Phần <?php echo $key_kq ?> : <?php echo $kq ?></div>
	<?php
	 } 
	?>
	<div>Tổng Số Câu Đúng : <?php echo $dung; ?></div>
	<div class="text-danger">Tổng Điểm Của Bạn Là : <?php echo $tong ?></div>
</div>
<?php if($ds_bai_lam != null){ ?>
<div class="col-md-9" style="border:1px solid black;width:90%;height:800px;overflow:scroll;">
<?php 
	foreach($ds_phan_thi as $phan_thi)
	{
?>
		<h2><?php echo $phan_thi["ten_phan_thi"]; ?></h2>
		<?php foreach($ds_loai_noi_dung as $loai_noi_dung)
		{
			if($loai_noi_dung["ma_phan_thi"] == $phan_thi["ma_phan_thi"])
			{
		?>
				<h3><?php echo $loai_noi_dung["ten_loai_noi_dung"] ?></h3>
		<?php
		foreach($arr_chu_de as $kiem_tra_chu_de)
		{
			if($kiem_tra_chu_de["ma_loai_noi_dung"]==$loai_noi_dung["ma_loai_noi_dung"])
			{			
				foreach($ds_chu_de_ket_qua as $chu_de)
				{
						if(in_array($chu_de["ma_chu_de"],$kiem_tra_chu_de) && $kiem_tra_chu_de["ma_chu_de"] == $chu_de["ma_chu_de"])
						{
							echo "Mã chủ đề :". $chu_de["ma_chu_de"];
						?>
							<?php if($chu_de["link"] != NULL){ ?>
								<div>
									<audio controls>
						              <source src="admin/public/media/<?php echo $chu_de["link"] ?>">
						               Your browser does not support the audio element.
						            </audio>
								</div>
							<?php } ?>
							<?php if($chu_de["hinh_anh"] != NULL){ ?>
								<div><img src="admin/public/upload_hinh/<?php echo $chu_de["hinh_anh"] ?>"></div>
							<?php } ?>
							<?php if($chu_de["noi_dung_chu_de"]!=NULL){ ?>
								<div style="border: 1px solid black"><?php echo $chu_de["noi_dung_chu_de"] ?></div>
							<?php } ?>
						<?php
								break;
							}
						}
						 foreach($ds_cau_hoi as $key=>$cau_hoi){ 
						 	if($kiem_tra_chu_de["ma_chu_de"] == $cau_hoi["ma_chu_de"])
								{
						 	?>
						<div><?php echo $socau.".&nbsp;".$cau_hoi["noi_dung_cau_hoi"]; ?><?php echo $cau_hoi["ma_cau_hoi"] ?>------Độ Khó : <?php echo $cau_hoi["ma_do_kho"]; ?></div>
						<div>
							<?php
							foreach($ds_cau_tra_loi as $keya=>$cau_tra_lois){ 
									foreach($ma_bai_lam as $keyb=>$tra_loi){
										if($key == $keya && $keya == $keyb){
											foreach($cau_tra_lois as $cau_tra_loi){
							?>
							<p><input type="radio" name="dapan[<?php echo $dem ?>]" <?php if($cau_tra_loi["ma_cau_tra_loi"]==$tra_loi){ echo 'checked="checked"'; } ?> ><span <?php if($cau_tra_loi["ket_qua"]==1){ ?> style="color:red"; <?php } ?>><?php echo $cau_tra_loi["dap_an_tra_loi"] ?></span></p>
									<?php  }
									}
								}
							} ?>
						</div>
						<?php 
							$socau++; 
							$dem++; 
							}
						} 
					}
				}
			} 
		}
	}
	?>

	<button type="button" class="btn btn-danger" onclick="if(confirm('Bạn thực sự muôn thoát')==true){window.location='index.php'}">Thoát</button> 
</div>
<?php } 
	else
	{ ?>
 		<div class="alert alert-danger">Bạn hãy thực hiện bài làm mới</div>
<?php
	}
}
else
{
	?>
	<div class="alert alert-danger">Bạn hãy đăng nhập để xem kết quả</div>
<?php 
}
?>
