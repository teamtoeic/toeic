<?php 
if(isset($_SESSION["nguoi_dung"]))
{
?>
<div class="col-md-offset-1 col-md-9">
	<form action="de_thi.php" method="post">
		<input type="text" hidden="hidden" name="diem_chuan" value="<?php echo $ma_diem_chuan ?>">
		<input type="text" hidden="hidden" name="cau_truc" value="<?php echo $ma_cau_truc ?>">
		<?php if($doc_cau_truc["thoi_gian_co_dinh"] == NULL){ ?>
		<div class="text-center col-md-12"><h3>Bạn Hãy Lựa Chọn Thời Gian</h3></div>
		<div class="col-md-12">
			<div class="col-md-6 text-center"><input type="radio" name="thoi_gian" value="0" class="thoi_gian" checked="checked"><span>Không Tính Thời Gian</span></div>
			<div class="col-md-6 text-center">
				<div class="col-md-12"><input type="radio" name="thoi_gian" value="1" class="thoi_gian"><span>Tính Thời Gian</span></div>
				<div class="col-md-12" id="du_lieu_thoi_gian"></div>
			</div>
		</div>
		<?php } ?>
		<div class="col-md-offset-5 col-md-3"><button class="btn btn-primary" name="bat_dau" id="bat_dau">Bắt Đầu</button></div>
	</form>
</div>
<script>
	$(document).ready(function()
	{
		$(".thoi_gian").change(function()
		{
			var thoi_gian = $(this).val();
			//alert(thoi_gian);
			if(thoi_gian == 1)
			{
				$.get("views/de_thi/v_nhap_du_lieu.php",function(data)
				{
					$("#du_lieu_thoi_gian").html('');
					$("#du_lieu_thoi_gian").append(data);
				})
				$("#bat_dau").attr("disabled","disabled");
			}
			else
			{
				$("#bat_dau").attr("disabled",false);
			}
			$("#du_lieu_thoi_gian").html('');
		})
	})
</script>
<?php } 
else
{
?>
	<div class="alert alert-danger">Bạn hãy đăng nhập để làm bài</div>
<?php 
}
?>
