<?php
	if($thong_baos!=NULL){
?>	
	<div>
		<h3 style="text-align: center;"><?php echo $thong_bao['tieu_de']; ?></h3>
		<p style="float: right">Ngày đăng: <?php echo $thong_bao['ngay_dang'] ?></p>
	</div>
	<div class="clear"></div>
	<div>
		<p><?php echo $thong_bao['noi_dung_thong_bao']; ?></p>
	</div>
	<?php
	}
	else{
	?>
	<div class="alert alert-warning"><?php echo $tb; ?></div>
	<?php
	}
?>