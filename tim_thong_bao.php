<?php
include("controllers/c_thong_bao.php");
$c_thong_bao=new C_thong_bao();
$thong_baos=$c_thong_bao->Tim_kiem_thong_bao();
//echo "<pre>",print_r($thong_baos),"</pre>";
if($thong_baos != null)
{
	foreach($thong_baos as $tb)
	{
	?>
		<li class="col-md-12 text-primary"><a href="javascript:void(0)" onclick="Doc_thong_bao(<?php echo $tb['ma_thong_bao']; ?>)"><?php echo $tb['tieu_de']; ?></a></li>
	<?php
	}
}
else
{
	?>
		<div class="col-md-12 alert alert-warning">Không có thông báo</div>
	<?php
}
?>