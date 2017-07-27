<?php 
//echo "<pre>",print_r($ds_phan_thi),"</pre>";
//echo "<pre>",print_r($ds_loai_noi_dung),"</pre>";
//echo "<pre>",print_r($arr_cau_hoi),"</pre>";
//echo "<pre>",print_r($ds_chu_de),"</pre>";
//echo "<pre>",print_r($ds_cau_hoi),"</pre>";
//echo "<pre>",print_r($arr_chu_de),"</pre>";
//echo "<pre>",print_r($doc_chi_tiet),"</pre>";
//echo "<pre>",print_r($tong),"</pre>";
//echo "<pre>",print_r($dem_tong),"</pre>";
//echo "<pre>",print_r($doc_cau_truc),"</pre>";
if(isset($_SESSION["nguoi_dung"]))
{
	if($ds_phan_thi != null)
	{
		
?>

<div class="col-md-12 alert alert-warning" style="display: none" id="error"> </div>
<div class="col-md-10" style="display: block;" id="bai_thi">
<div class="col-md-offset-1 col-md-9" style="border:1px solid black;width:90%;height:800px;overflow:scroll;" id="loading">
<form action="ket_qua.php" method="post">
<input type="text" hidden="hidden" name="diem_chuan" value="<?php echo $ma_diem_chuan ?>">
<input type="text" hidden="hidden" name="cau_truc" value="<?php echo $ma_cau_truc ?>">
<input type="text" hidden="hidden" name="check_time" id="check_time" value="<?php if(isset($tinh_thoi_gian)){ echo $tinh_thoi_gian; } ?>" >
<?php 
	foreach($ds_phan_thi as $phan_thi)
	{
		?>
			<h2><?php echo $phan_thi["ten_phan_thi"]; ?></h2>
		<?php
		foreach($ds_loai_noi_dung as $loai_noi_dung)
		{
			if($loai_noi_dung["ma_phan_thi"] == $phan_thi["ma_phan_thi"])
			{
				?>
					<h3><?php echo $loai_noi_dung["ten_loai_noi_dung"] ?></h3>
				<?php
				foreach($ds_chu_de as $chu_de)
				{
					if($chu_de["ma_loai_noi_dung"]==$loai_noi_dung["ma_loai_noi_dung"])
					{
						foreach($arr_chu_de as $kiem_tra_chu_de)
						{			
							if(is_array($kiem_tra_chu_de))
							{
								if(in_array($chu_de["ma_chu_de"],$kiem_tra_chu_de))
								{
									//echo "<pre>",print_r($kiem_tra_chu_de),"</pre>";
							?>
							<div id="<?php echo 'a'.$chu_de["ma_chu_de"] ?>" style="display:none">
							<input type="text" hidden="hidden" class="check_chu_de" value="<?php echo $chu_de["ma_chu_de"] ?>">
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
							</div>
							<?php
									break;
								}
							}
						}
						foreach($ds_cau_hoi as $cau_hois)
						{
							foreach($cau_hois as $cau_hoi)
							{
								foreach($doc_chi_tiet_cau_truc as $doc_chi_tiet)
								{
									foreach($doc_chi_tiet as $chi_tiet)
									{
										if($chi_tiet["ma_do_kho"]==$cau_hoi["ma_do_kho"] && $chi_tiet["ma_loai_noi_dung"] == $cau_hoi["ma_loai_noi_dung"])
										{
											if(isset($tong[$chi_tiet["ma_loai_noi_dung"].$chi_tiet["ma_do_kho"]]))
											{
												if($dem_tong[$chi_tiet["ma_loai_noi_dung"].$chi_tiet["ma_do_kho"]] < $tong[$chi_tiet["ma_loai_noi_dung"].$chi_tiet["ma_do_kho"]])
												{
													if($chu_de["ma_chu_de"] == $cau_hoi["ma_chu_de"])
													{
														if(!in_array($cau_hoi["ma_chu_de"],$check_chu_de))
														{
															$check_chu_de[] = $cau_hoi["ma_chu_de"];
														}
											?>
												<div><?php echo $dem_thu_tu_cau.".".$cau_hoi["noi_dung_cau_hoi"] ?>------Độ Khó : <?php echo $cau_hoi["ma_do_kho"]; ?>--- Mã Câu Hỏi <?php echo $cau_hoi["ma_cau_hoi"] ?>
													<input type="hidden" name="cauhoi[]" value="<?php echo $cau_hoi["ma_cau_hoi"]; ?>">
												</div>
												<?php 
														foreach($ds_cau_tra_loi as $cau_tra_loi)
														{ 
															if($cau_tra_loi["ma_cau_hoi"] == $cau_hoi["ma_cau_hoi"])
															{
												?>
													<div>
														<input type="radio" name="dapan[<?php echo $socau ?>]" value="<?php echo $cau_tra_loi["ma_cau_tra_loi"] ?>"><span style="margin-left:5px;" > <?php echo $cau_tra_loi["dap_an_tra_loi"] ?> ----- <?php echo $cau_tra_loi["ket_qua"]; ?> </span>
													</div>
												<?php 
															} 
														}
														$dem_tong[$chi_tiet["ma_loai_noi_dung"].$chi_tiet["ma_do_kho"]]++;
														$dem_thu_tu_cau++;
														$socau++;
													}
													break;
													   
												}
											}	
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
if(isset($check_chu_de))
{
	$test_chu_de = $check_chu_de;
}
if(!isset($test_chu_de))
{
	?>
		<div class="col-md-12 alert alert-warning"> Đề Thi chưa được xây dựng ! Vui lòng quay lại sau ! </div>
	<?php 
}
?>
<button class="btn btn-success" name="Submit" id="nopbai">Nộp Bài</button>
</form>
</div>
</div>
<?php if($tinh_thoi_gian != ""){ ?>
<div class="col-md-2">
	<div class="text-danger text-center" style="border: black solid 1px; font-size: 30px; position: fixed; border-radius: 20px; background-color : #F1EE00; width:10%" id="count_time"></div>
</div>
<?php 
}
}
}
else
{
?>
	<div class="col-md-12 alert alert-danger">Bạn hãy đăng nhập để làm bài</div>
<?php 
}
?>
<script>
	<?php 
	if(isset($test_chu_de))
	{
		foreach($test_chu_de as $hien_chu_de)
		{
			?>
			document.getElementById("a<?php echo $hien_chu_de?>").style.display = "block";
		<?php
		}
	}
	?>
</script>
<script>
$(document).ready(function()
{
	<?php
	if(isset($test_chu_de))
	{ 
		if($dem_thu_tu_cau - 1 != $doc_cau_truc["so_luong_cau_de_thi"] )
		{
			?>
			document.getElementById("bai_thi").style.display = "none";
			document.getElementById("error").style.display = "block";
			document.getElementById("error").innerHTML = "Đề Thi chưa được xây dựng ! Vui lòng quay lại sau !";
			<?php
		}
		else if(isset($tinh_thoi_gian) && $tinh_thoi_gian!= ""){?>
		$(window).bind("load",function(){
		var load_time = $("#check_time").val();
		//alert(load_time);
		if(load_time != "")
		{
			var loadTime = window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart;
			var time = load_time * 1000 * 60 + parseInt(loadTime);
			var do_alert = function(){
	    		$("#nopbai").trigger('click');
	    		alert("Hết giờ");
			};
			setTimeout(do_alert,time);

			var countDownDate = new Date("<?php echo $thoi_gian ?>").getTime()+time;
		
			var x = setInterval(function () {
			    var now = new Date().getTime();

			    var distance = countDownDate - now;
			    //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			    document.getElementById("count_time").innerHTML = hours + ":" + minutes + ":" + seconds; 
			    if (distance < 0) {
			        clearInterval(x);
			        document.getElementById("count_time").innerHTML = "Hết Giờ";
			    }
			    
			}, 1000);
		}
		})
	<?php } ?>
	$("#nopbai").click(function()
	{
		document.getElementById("loading").style.opacity = '0.5';
		$(".bg_load").show("slow");
		$(".wrapper").show("slow");
	})
	<?php } ?>
})
</script>


