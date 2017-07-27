<?php
$ma_thong_bao=$_POST["ma_thong_bao"];
include("models/m_thong_bao.php");
$m_thong_bao=new M_thong_bao();
$thong_bao=$m_thong_bao->Doc_thong_bao_theo_ma($ma_thong_bao);
?>
	<div>
		<h3 style="text-align: center;"><?php echo $thong_bao['tieu_de']; ?></h3>
		<p style="float: right">Ngày đăng: <?php echo $thong_bao['ngay_dang'] ?></p>
	</div>
	<div class="clear"></div>
	<div>
		<p><?php echo $thong_bao['noi_dung_thong_bao']; ?></p>
	</div>
